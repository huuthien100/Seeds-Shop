<?php

namespace App\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../config/connect.php';

class CartModel
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    // addToCart
    public function addToCart($user_id, $product_id, $product_name, $price, $quantity = 1)
    {
        $existingCartItem = $this->getCartItem($user_id, $product_id);

        if ($existingCartItem) {
            $newQuantity = $existingCartItem['quantity'] + $quantity;
            $newTotalPrice = $newQuantity * $price;
            $this->updateCartItem($existingCartItem['cart_id'], $newQuantity, $newTotalPrice);
            return true;
        } else {
            $product = $this->getProductById($product_id);

            if (!$product || $product['stock_quantity'] < $quantity) {
                return '' .$product_name . ' hiện đã hết hàng.';
            }

            $totalPrice = $price * $quantity;
            $this->addNewCartItem($user_id, $product_id, $product_name, $price, $quantity, $totalPrice);
            return true;
        }
    }
    // getProductById
    private function getProductById($product_id)
    {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $product_id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    // getCartItem
    private function getCartItem($user_id, $product_id)
    {
        $sql = "SELECT * FROM carts WHERE user_id = ? AND product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $user_id, \PDO::PARAM_INT);
        $stmt->bindParam(2, $product_id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    // updateCartItem
    private function updateCartItem($cart_id, $quantity, $total_price)
    {
        $sql = "UPDATE carts SET quantity = ?, total_price = ? WHERE cart_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $quantity, \PDO::PARAM_INT);
        $stmt->bindParam(2, $total_price, \PDO::PARAM_STR);
        $stmt->bindParam(3, $cart_id, \PDO::PARAM_INT);
        $stmt->execute();
    }
    // addNewCartItem
    private function addNewCartItem($user_id, $product_id, $product_name, $price, $quantity, $total_price)
    {
        $sql = "INSERT INTO carts (user_id, product_id, product_name, price, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $user_id, \PDO::PARAM_INT);
        $stmt->bindParam(2, $product_id, \PDO::PARAM_INT);
        $stmt->bindParam(3, $product_name, \PDO::PARAM_STR);
        $stmt->bindParam(4, $price, \PDO::PARAM_STR);
        $stmt->bindParam(5, $quantity, \PDO::PARAM_INT);
        $stmt->bindParam(6, $total_price, \PDO::PARAM_STR);
        $stmt->execute();
    }
    // getCartItemsByUserId
    public function getCartItemsByUserId($user_id)
    {
        $sql = "SELECT * FROM carts WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $user_id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // updateCartItemQuantity
    public function updateCartItemQuantity($cartId, $quantity)
    {
        try {
            $cartItem = $this->getCartItemByCartId($cartId);
            if ($cartItem !== null) {
                $newQuantity = $quantity;
                $newTotalPrice = $newQuantity * $cartItem['price'];

                $query = "UPDATE carts SET quantity = :quantity, total_price = :total_price WHERE cart_id = :cartId";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':quantity', $newQuantity);
                $stmt->bindParam(':total_price', $newTotalPrice);
                $stmt->bindParam(':cartId', $cartId);
                $stmt->execute();
                return true;
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }
    // getCartItemByCartId
    private function getCartItemByCartId($cartId)
    {
        $sql = "SELECT * FROM carts WHERE cart_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $cartId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    // getCurrentQuantity
    public function getCurrentQuantity($cartId)
    {
        $sql = "SELECT quantity FROM carts WHERE cart_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $cartId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    // increaseCartItemQuantity
    public function increaseCartItemQuantity($cartId)
    {
        $currentQuantity = $this->getCurrentQuantity($cartId);
        if ($currentQuantity !== null) {
            $newQuantity = $currentQuantity + 1;
            return $this->updateCartItemQuantity($cartId, $newQuantity);
        }
        return false;
    }
    // decreaseCartItemQuantity
    public function decreaseCartItemQuantity($cartId)
    {
        $currentQuantity = $this->getCurrentQuantity($cartId);
        if ($currentQuantity !== null && $currentQuantity > 1) {
            $newQuantity = $currentQuantity - 1;
            return $this->updateCartItemQuantity($cartId, $newQuantity);
        }
        return false;
    }
    // removeCartItem
    public function removeCartItem($cartId)
    {
        try {
            $query = "DELETE FROM carts WHERE cart_id = :cartId";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cartId', $cartId);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    // checkout
    public function checkout($user_id)
    {
        try {
            $cartItems = $this->getCartItemsByUserId($user_id);

            if (empty($cartItems)) {
                return false;
            }

            $this->pdo->beginTransaction();

            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $totalPrice += $item['total_price'];
            }

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $orderDate = date('Y-m-d H:i:s');

            $orderStatus = 'Đang Chờ';
            $orderQuery = "INSERT INTO orders (user_id, order_date, status) VALUES (?, ?, ?)";
            $orderStmt = $this->pdo->prepare($orderQuery);
            $orderStmt->bindParam(1, $user_id, \PDO::PARAM_INT);
            $orderStmt->bindParam(2, $orderDate);
            $orderStmt->bindParam(3, $orderStatus);
            $orderStmt->execute();

            $order_id = $this->pdo->lastInsertId();

            $orderItemQuery = "INSERT INTO orderitems (order_id, product_id, quantity) VALUES (?, ?, ?)";
            $orderItemStmt = $this->pdo->prepare($orderItemQuery);

            foreach ($cartItems as $item) {
                $orderItemStmt->bindParam(1, $order_id, \PDO::PARAM_INT);
                $orderItemStmt->bindParam(2, $item['product_id'], \PDO::PARAM_INT);
                $orderItemStmt->bindParam(3, $item['quantity'], \PDO::PARAM_INT);
                $orderItemStmt->execute();

                $productStockUpdateQuery = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?";
                $productStockUpdateStmt = $this->pdo->prepare($productStockUpdateQuery);
                $productStockUpdateStmt->bindParam(1, $item['quantity'], \PDO::PARAM_INT);
                $productStockUpdateStmt->bindParam(2, $item['product_id'], \PDO::PARAM_INT);
                $productStockUpdateStmt->execute();
            }

            $this->pdo->commit();
            $this->clearCart($user_id);

            return true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();

            return false;
        }
    }
    public function clearCart($user_id)
    {
        try {
            $sql = "DELETE FROM carts WHERE user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $user_id, \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
