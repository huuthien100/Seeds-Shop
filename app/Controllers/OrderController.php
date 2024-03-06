<?php

namespace App\Controllers;

use App\Models\OrderModel;

class OrderController
{
    protected $orderModel;

    public function __construct(OrderModel $orderModel)
    {
        $this->orderModel = $orderModel;
    }
    // viewAllOrders
    public function viewAllOrders()
    {
        $orders = $this->orderModel->getAllOrders();
        return $orders;
    }
    // confirmOrder
    public function confirmOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
            $orderId = $_POST['order_id'];
            $success = $this->orderModel->confirmOrder($orderId);

            if ($success) {
                echo "<script>alert('Đã xác nhận đơn hàng thành công.');</script>";
                echo "<script>window.location.href = 'index.php?page=mOrders';</script>";
            } else {
                echo "<script>alert('Đã xảy ra lỗi khi xác nhận đơn hàng.');</script>";
            }
        }
    }
    // viewOrderDetails
    public function viewOrderDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
            $orderId = $_POST['order_id'];
            $orderDetails = $this->orderModel->getOrderDetails($orderId);
            return $orderDetails;
        }
    }
    // deleteOrder
    public function deleteOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
            $orderId = $_POST['order_id'];

            $success = $this->orderModel->deleteOrder($orderId);

            if ($success) {
                echo "<script>alert('Xóa đơn hàng thành công.');</script>";
                echo "<script>window.location.href = 'index.php?page=mOrders';</script>";
            } else {
                echo "<script>alert('Đã xảy ra lỗi khi xóa đơn hàng.');</script>";
            }
        }
    }
}
