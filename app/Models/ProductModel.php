<?php

namespace App\Models;

require '../config/connect.php';

class ProductModel
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    // getAllProducts
    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        try {
            $stmt = $this->pdo->query($sql);
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $products;
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return [];
        }
    }
    // getOldImageUrl
    public function getOldImageUrl($productId)
    {
        $sql = "SELECT img_url FROM products WHERE product_id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $productId, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                return $result['img_url'];
            } else {
                return null;
            }
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return null;
        }
    }
    // addProduct
    public function addProduct($imgUrl, $productName, $description, $price, $stockQuantity)
    {
        $sql = "INSERT INTO products (img_url, product_name, description, price, stock_quantity) VALUES (?, ?, ?, ?, ?)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $imgUrl, \PDO::PARAM_STR);
            $stmt->bindParam(2, $productName, \PDO::PARAM_STR);
            $stmt->bindParam(3, $description, \PDO::PARAM_STR);
            $stmt->bindParam(4, $price, \PDO::PARAM_STR);
            $stmt->bindParam(5, $stockQuantity, \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return false;
        }
    }
    // updateProduct
    public function updateProduct($productId, $imgUrl, $productName, $description, $price, $stockQuantity)
    {
        $sql = "UPDATE products SET img_url = ?, product_name = ?, description = ?, price = ?, stock_quantity = ? WHERE product_id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $imgUrl, \PDO::PARAM_STR);
            $stmt->bindParam(2, $productName, \PDO::PARAM_STR);
            $stmt->bindParam(3, $description, \PDO::PARAM_STR);
            $stmt->bindParam(4, $price, \PDO::PARAM_STR);
            $stmt->bindParam(5, $stockQuantity, \PDO::PARAM_INT);
            $stmt->bindParam(6, $productId, \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return false;
        }
    }
    // deleteProduct
    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM products WHERE product_id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $productId, \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return false;
        }
    }
}
