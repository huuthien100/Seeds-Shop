<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }
    public function isLogged()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }
    // getAccess
    public function getAccess($user_identifier)
    {
        return $this->userModel->getAccess($user_identifier);
    }
    // register
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullName = $_POST['fullName'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            if ($this->userModel->isUserExists($username, $email)) {
                echo '<script>';
                echo 'alert("Người dùng đã tồn tại.");';
                echo '</script>';
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $Registered = $this->userModel->register($username, $email, $hashedPassword, $fullName, $address, $phone);

            echo '<script>';
            if ($Registered) {
                echo 'alert("Đăng ký thành công.");';
                echo 'setTimeout(function(){ window.location.href = "index.php?page=login"; }, 0);';
            } else {
                echo 'alert("Đăng ký thất bại.");';
            }
            echo '</script>';
        }
    }
    // login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $loginResult = $this->userModel->login($username, $password);

            if ($loginResult === 'success') {
                $access = $this->getAccess($username);

                if ($access === 1) {
                    echo '<script>alert("Xin chào admin.");</script>';
                    echo '<script>window.setTimeout(function() {
                        window.location.href = "index.php?page=admin";
                    }, 1);</script>';
                    exit;
                } else {
                    echo '<script>alert("Đăng nhập thành công.");</script>';
                    echo '<script>window.setTimeout(function() {
                        window.location.href = "index.php?page=home";
                    }, 1);</script>';
                    exit;
                }
            } else {
                echo '<script>alert("' . $loginResult . '");</script>';
            }
        }
    }
    // logout
    public function logout()
    {
        $this->userModel->logout();
        echo '<script>alert("Đã đăng xuất thành công.");</script>';
        echo '<script>setTimeout(function(){ window.location.href = "index.php?page=home"; }, 0);</script>';
    }
    // getAllUsers
    public function getAllUsers()
    {
        return $this->userModel->getAllUsers();
    }
    // addUser
    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $full_name = $_POST['full_name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $access = $_POST['access'];

            if (empty($username) || empty($email) || empty($password) || empty($full_name) || empty($address) || empty($phone)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin người dùng.');</script>";
                return false;
            }

            if ($this->userModel->addUser($username, $email, $password, $full_name, $address, $phone, $access)) {
                echo "<script>alert('Thêm người dùng thành công.');</script>";
                echo "<script>window.location.href = 'index.php?page=mUsers';</script>";
                return true;
            } else {
                echo "<script>alert('Thêm người dùng thất bại.');</script>";
                return false;
            }
        }
    }
    // updateUser
    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $full_name = $_POST['full_name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $access = $_POST['access'];

            if (empty($username) || empty($email) || empty($password) || empty($full_name) || empty($address) || empty($phone) || empty($access)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin người dùng.');</script>";
                return false;
            }

            if ($this->userModel->updateUser($userId, $username, $email, $password, $full_name, $address, $phone, $access)) {
                echo "<script>alert('Cập nhật người dùng thành công.');</script>";
                echo "<script>window.location.href = 'index.php?page=mUsers';</script>";
                return true;
            } else {
                echo "<script>alert('Cập nhật người dùng thất bại.');</script>";
                return false;
            }
        }
    }
    // deleteUser
    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];

            if ($this->userModel->deleteUser($userId)) {
                echo "<script>alert('Xóa người dùng thành công.');</script>";
                echo "<script>window.location.href = 'index.php?page=mUsers';</script>";
                return true;
            } else {
                echo "<script>alert('Xóa người dùng thất bại.');</script>";
                return false;
            }
        }
    }
}
