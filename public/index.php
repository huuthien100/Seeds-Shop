<?php

use \App\Controllers\UserController;
use \App\Models\UserModel;
use \App\Controllers\ProductController;
use \App\Models\ProductModel;
use \App\Controllers\OrderController;
use \App\Models\OrderModel;
use \App\Controllers\CartController;
use \App\Models\CartModel;

require '../vendor/autoload.php';
require '../config/connect.php';
require_once __DIR__ . '/../app/views/includes/header.php';

$productController = new ProductController(new ProductModel($pdo));
if (isset($_GET['page'])) {
    $productController = new ProductController(new ProductModel($pdo));
    $userController = new UserController(new UserModel($pdo));
    $orderController = new OrderController(new OrderModel($pdo));
    $cartController = new CartController(new CartModel($pdo));
    $page = $_GET['page'];
    switch ($page) {
        case 'home':
            if (isset($_GET['act'])) {
                $action = $_GET['act'];
                if ($action === 'buy') {
                    $cartController->addToCart();
                    break;
                }
            }
            $products = $productController->getAllProducts();
            require_once __DIR__ . '/../app/views/user/home.php';
            break;
        case 'about':
            require_once __DIR__ . '/../app/views/user/about.html';
            break;
        case 'cart':
            if ($userController->isLogged()) {
                $cartItem = $cartController->showCartItems();
                $cartController->updateCart();
                require_once __DIR__ . '/../app/views/user/cart.php';
            } else {
                header('Location: index.php?page=login');
                exit;
            }
            break;
        case 'register':
            $userController->register();
            require_once __DIR__ . '/../app/views/auth/register.html';
            break;
        case 'login':
            $userController->login();
            require_once __DIR__ . '/../app/views/auth/login.html';
            break;
        case 'logout':
            $userController->logout();
            require_once __DIR__ . '/../app/views/user/home.php';
            break;
        case 'admin':
            $products = $productController->getAllProducts();
            require_once __DIR__ . '/../app/views/admin/ManageProducts.php';
            break;
        case 'mProducts':
            if (isset($_GET['act'])) {
                $action = $_GET['act'];
                switch ($action) {
                    case 'addProduct':
                        $productController->addProduct();
                        break;
                    case 'updateProduct':
                        $productController->updateProduct();
                        break;
                    case 'deleteProduct':
                        $productController->deleteProduct();
                        break;
                    default:
                        $products = $productController->getAllProducts();
                        require_once __DIR__ . '/../app/views/admin/ManageProducts.php';
                        break;
                }
            }
            $products = $productController->getAllProducts();
            require_once __DIR__ . '/../app/views/admin/ManageProducts.php';
            break;
        case 'mUsers':
            if (isset($_GET['act'])) {
                $action = $_GET['act'];
                switch ($action) {
                    case 'addUser':
                        $userController->addUser();
                        break;
                    case 'updateUser':
                        $userController->updateUser();
                        break;
                    case 'deleteUser':
                        $userController->deleteUser();
                        break;
                    default:
                        require_once __DIR__ . '/../app/views/admin/ManageUsers.php';
                        break;
                }
            }
            $users = $userController->getAllUsers();
            require_once __DIR__ . '/../app/views/admin/ManageUsers.php';
            break;
        case 'mOrders':
            if (isset($_GET['act'])) {
                $action = $_GET['act'];
                switch ($action) {
                    case 'confirmOrder':
                        $orderController->confirmOrder();
                        break;
                    case 'viewDetailOrder':
                        $orderDetails = $orderController->viewOrderDetails();
                        require_once __DIR__ . '/../app/views/admin/OrderDetail.php';
                        break;
                    case 'deleteOrder':
                        $orderController->deleteOrder();
                        break;
                    default:
                        require_once __DIR__ . '/../app/views/admin/ManageOrders.php';
                        break;
                }
            }

            $orders = $orderController->viewAllOrders();
            require_once __DIR__ . '/../app/views/admin/ManageOrders.php';
            break;
        default:
            $products = $productController->getAllProducts();
            require_once __DIR__ . '/../app/views/user/home.php';
            break;
    }
} else {
    $products = $productController->getAllProducts();
    require_once __DIR__ . '/../app/views/user/home.php';
}

require_once __DIR__ . '/../app/views/includes/footer.php';