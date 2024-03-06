<?php

namespace App\Models;

require '../config/connect.php';

class UserModel
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    // getAccess
    public function getAccess($user_identifier)
    {
        try {
            $query = "SELECT access FROM users WHERE user_id = :user_id OR username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['user_id' => $user_identifier, 'username' => $user_identifier]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                $access = $result['access'];
                if (is_numeric($access)) {
                    $access = (int)$access;
                    return $access;
                } else {
                    return 0;
                }
            }
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return null;
        }
    }
    // isUserExists
    public function isUserExists($username, $email)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return false;
        }
    }
    // register
    public function register($username, $email, $password, $fullName, $address, $phone)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, full_name, address, phone, access) VALUES (?, ?, ?, ?, ?, ?, 2)");
            $stmt->execute([$username, $email, $password, $fullName, $address, $phone]);
            return true;
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return false;
        }
    }
    // login
    public function login($username, $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                return 'Tên người dùng không tồn tại.';
            }

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                return 'success';
            } else {
                return 'Mật khẩu không đúng.';
            }
        } catch (\PDOException $e) {
            $error_message = "PDOException: " . $e->getMessage();
            error_log($error_message, 3, 'logs/error.log');
            return 'Có lỗi xảy ra, vui lòng thử lại sau.';
        }
    }
    // logout
    public function logout()
    {
        session_unset();
        session_destroy();
    }
    // getAllUsers
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    // getUserById
    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    // addUser
    public function addUser($username, $email, $password, $full_name, $address, $phone, $access)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, full_name, address, phone, access) VALUES (:username, :email, :password, :full_name, :address, :phone, :access)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, \PDO::PARAM_STR);
        $stmt->bindParam(':full_name', $full_name, \PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, \PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, \PDO::PARAM_STR);
        $stmt->bindParam(':access', $access, \PDO::PARAM_STR);
        return $stmt->execute();
    }
    // updateUser
    public function updateUser($userId, $username, $email, $password, $full_name, $address, $phone, $access)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET username = :username, email = :email, password = :password, full_name = :full_name, address = :address, phone = :phone, access = :access WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, \PDO::PARAM_STR);
        $stmt->bindParam(':full_name', $full_name, \PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, \PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, \PDO::PARAM_STR);
        $stmt->bindParam(':access', $access, \PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    // deleteUser
    public function deleteUser($userId)
    {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
