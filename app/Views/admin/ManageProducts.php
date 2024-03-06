<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Danh sách sản phẩm</h1>
        </div>
        <div class="col text-end pb-1">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fas fa-plus"></i> Thêm
            </button>
        </div>
    </div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Mô tả sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Số lượng tồn kho</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($products && count($products) > 0) {
                foreach ($products as $product) {
                    echo '<tr>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($product['product_name']) . '</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars(number_format($product['price'], 0, '.', '.')) . ' VNĐ</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($product['description']) . '</td>';
                    echo '<td class="text-center align-middle"><img id="product-image" src="' . htmlspecialchars($product['img_url']) . '" alt="' . htmlspecialchars($product['product_name']) . '" class="img-thumbnail" style="max-width: 150px;"></td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($product['stock_quantity']) . '</td>';
                    echo '<td>';
                    echo '<div class="text-center pt-4">';
                    echo '<button class="btn btn-primary edit-product" type="button" data-bs-toggle="modal" data-bs-target="#updateProductModal" data-product-id="' . htmlspecialchars($product['product_id']) . '"><i class="fas fa-edit"></i></button>';
                    echo '<button class="btn btn-danger delete-product" type="button" data-bs-toggle="modal" data-bs-target="#deleteProductModal" data-product-id="' . htmlspecialchars($product['product_id']) . '"><i class="fas fa-trash-alt"></i></button>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">Không có sản phẩm nào.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="index.php?page=mProducts&act=addProduct" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="img_url" class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="img_url" name="img_url">
                    </div>
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Số lượng tồn kho</label>
                        <input type="text" class="form-control" id="stock_quantity" name="stock_quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Product Modal -->
<div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProductModalLabel">Sửa sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="index.php?page=mProducts&act=updateProduct" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="edit-product-id-input" name="product_id" value="">
                    <div class="mb-3">
                        <label for="product_name_edit" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="product_name_edit" name="product_name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="price_edit" class="form-label">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="price_edit" name="price" value="">
                    </div>
                    <div class="mb-3">
                        <label for="description_edit" class="form-label">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="description_edit" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="img_url_edit" class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="img_url_edit" name="img_url">
                        <img src="" class="img-thumbnail" id="product_image_edit" name="old_img_url" style="max-width: 200px;">
                    </div>
                    <div class="mb-3">
                        <label for="stock_quantity_edit" class="form-label">Số lượng tồn kho</label>
                        <input type="text" class="form-control" id="stock_quantity_edit" name="stock_quantity" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Xóa sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn xóa sản phẩm này?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="index.php?page=mProducts&act=deleteProduct">
                    <input type="hidden" id="delete-product-id-input" name="product_id" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>