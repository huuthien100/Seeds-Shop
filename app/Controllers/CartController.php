<?php

namespace App\Controllers;

use App\Models\CartModel;

class CartController
{
    protected $cartModel;
    public function __construct(CartModel $CartModel)
    {
        $this->cartModel = $CartModel;
    }
    // addToCart
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['product_id'], $_POST['product_name'], $_POST['price'])) {
                $product_id = $_POST['product_id'];
                $product_name = $_POST['product_name'];
                $price = $_POST['price'];
                $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];

                    $result = $this->cartModel->addToCart($user_id, $product_id, $product_name, $price, $quantity);

                    if ($result === true) {
                        echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng.');</script>";
                        echo "<script>window.location.href = 'index.php?page=home';</script>";
                    } else {
                        echo "<script>alert('$result');</script>";
                        echo "<script>window.location.href = 'index.php?page=home';</script>";
                    }
                } else {
                    echo "<script>alert('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.');</script>";
                    echo "<script>window.location.href = 'index.php?page=login';</script>";
                }
            }
        }
    }
    // showCartItems
    public function showCartItems()
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $cartItems = $this->cartModel->getCartItemsByUserId($user_id);
            return $cartItems;
        } else {
            echo "Bạn chưa đăng nhập. Vui lòng đăng nhập để xem giỏ hàng của bạn.";
        }
    }
    // updateCart
    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['checkout'])) {
                $user_id = $_SESSION['user_id'];
                $success = $this->cartModel->checkout($user_id);

                if ($success) {
                    echo '<script>alert("Thanh toán thành công.");</script>';
                } else {
                    echo '<script>alert("Thanh toán thất bại.");</script>';
                }
                echo '<script>window.location.href = "index.php?page=cart";</script>';
            } elseif (isset($_POST['increase'])) {
                $cartId = $_POST['increase'];
                $success = $this->cartModel->increaseCartItemQuantity($cartId);

                if ($success) {
                    echo '<script>window.location.href = "index.php?page=cart";</script>';
                }
            } elseif (isset($_POST['decrease'])) {
                $cartId = $_POST['decrease'];
                $success = $this->cartModel->decreaseCartItemQuantity($cartId);

                if ($success) {
                    echo '<script>window.location.href = "index.php?page=cart";</script>';
                }
            } elseif (isset($_POST['remove'])) {
                $cartId = $_POST['remove'];
                $success = $this->cartModel->removeCartItem($cartId);

                if ($success) {
                    echo '<script>alert("Đã xóa sản phẩm khỏi giỏ hàng.");</script>';
                }
                echo '<script>window.location.href = "index.php?page=cart";</script>';
            }
        }
    }
}
