<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController
{
    protected $productModel;
    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
    }
    // getAllProducts
    public function getAllProducts()
    {
        $products = $this->productModel->getAllProducts();
        return $products;
    }
    // uploadProductImage
    function uploadProductImage($imgUrl, $productName)
    {
        if ($imgUrl["error"] === UPLOAD_ERR_OK) {
            $tmp_name = $imgUrl["tmp_name"];
            $originalFileName = $imgUrl["name"];

            $safeProductName = str_replace([' ', '/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $productName);

            $productImageDirectory = "img/productImage/";
            $newFileName = $safeProductName . '.png';
            $imgUrl = $productImageDirectory . $newFileName;

            if (!is_dir($productImageDirectory)) {
                mkdir($productImageDirectory, 0777, true);
            }

            $product_img = $productImageDirectory . '/' . $newFileName;

            if (move_uploaded_file($tmp_name, $product_img)) {
                return $imgUrl;
            } else {
                return "Lỗi khi tải lên hình ảnh sản phẩm.";
            }
        } else {
            return "Lỗi khi tải lên hình ảnh sản phẩm.";
        }
    }
    // addProduct
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productName = $_POST['product_name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stockQuantity = $_POST['stock_quantity'];

            if (empty($productName) || empty($description) || empty($price) || empty($stockQuantity)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin sản phẩm.');</script>";
                return false;
            }

            $imgUrl = $this->uploadProductImage($_FILES['img_url'], $productName);

            if ($this->productModel->addProduct($imgUrl, $productName, $description, $price, $stockQuantity)) {
                echo "<script>alert('Thêm sản phẩm thành công.');</script>";
                echo "<script>window.location.href = 'index.php?page=mProducts';</script>";
                return true;
            } else {
                echo "<script>alert('Thêm sản phẩm thất bại.');</script>";
                return false;
            }
        }
    }
    // updateProduct
    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $productName = $_POST['product_name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stockQuantity = $_POST['stock_quantity'];
            $oldImgUrl = $this->productModel->getOldImageUrl($productId);

            if (empty($productName) || empty($description) || empty($price) || empty($stockQuantity)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin sản phẩm.');</script>";
                return false;
            }

            if (isset($_FILES['img_url']) && $_FILES['img_url']['error'] === UPLOAD_ERR_OK) {
                $imgUrl = $this->uploadProductImage($_FILES['img_url'], $productName);
            } else {
                $imgUrl = $oldImgUrl;
            }

            if ($this->productModel->updateProduct($productId, $imgUrl, $productName, $description, $price, $stockQuantity)) {
                echo "<script>alert('Cập nhật sản phẩm thành công.');</script>";
                echo "<script>document.getElementById('product-image').src = '" . $imgUrl . "';</script>";
                echo "<script>window.location.href = 'index.php?page=mProducts';</script>";
                return true;
            } else {
                echo "<script>alert('Cập nhật sản phẩm thất bại.');</script>";
                return false;
            }
        }
    }
    // deleteProduct
    public function deleteProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['product_id'])) {
                $productId = $_POST['product_id'];
                $success = $this->productModel->deleteProduct($productId);
                if ($success) {
                    echo "<script>alert('Xóa sản phẩm thành công.');</script>";
                    echo "<script>window.location.href = 'index.php?page=mProducts';</script>";
                } else {
                    echo "<script>alert('Xóa sản phẩm thất bại.');</script>";
                }
            }
        }
    }
}
