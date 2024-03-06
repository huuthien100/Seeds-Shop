<?php

namespace App\Models;

require '../config/connect.php';

class OrderModel
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    // getAllOrders
    public function getAllOrders()
    {
        $query = "SELECT * FROM orders";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }
    // confirmOrder
    public function confirmOrder($orderId)
    {
        $query = "UPDATE orders SET status = 'Đã Xác Nhận' WHERE order_id = :order_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':order_id', $orderId, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    // getOrderDetails
    public function getOrderDetails($orderId)
    {
        // Câu truy vấn SQL
        $query = "SELECT
            p.product_name,
            oi.quantity,
            p.price,
            (oi.quantity * p.price) AS total_price,
            o.order_date,
            o.status
        FROM
            orderitems oi
        INNER JOIN
            products p ON oi.product_id = p.product_id
        INNER JOIN
            orders o ON oi.order_id = o.order_id
        WHERE
            oi.order_id = :order_id";

        // Sử dụng PDO để thực hiện truy vấn
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':order_id', $orderId, \PDO::PARAM_INT);
        $stmt->execute();

        // Trả về kết quả dưới dạng mảng
        return $stmt->fetchAll();
    }
    // deleteOrder
    public function deleteOrder($orderId)
    {
        $this->pdo->beginTransaction();
        try {
            $deleteOrderItemsQuery = "DELETE FROM orderitems WHERE order_id = :order_id";
            $stmt = $this->pdo->prepare($deleteOrderItemsQuery);
            $stmt->bindParam(':order_id', $orderId, \PDO::PARAM_INT);
            $stmt->execute();

            $deleteOrderQuery = "DELETE FROM orders WHERE order_id = :order_id";
            $stmt = $this->pdo->prepare($deleteOrderQuery);
            $stmt->bindParam(':order_id', $orderId, \PDO::PARAM_INT);
            $stmt->execute();

            $this->pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return false;
        }
    }
}
