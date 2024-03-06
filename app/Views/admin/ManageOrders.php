<div class="container mt-5 mb-5">
    <h1 class="text-center">Danh sách đơn hàng</h1>
    <div class="mb-5"></div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Mã người dùng</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($orders && count($orders) > 0) {
                foreach ($orders as $order) {
                    echo '<tr>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($order['order_id']) . '</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($order['user_id']) . '</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($order['order_date']) . '</td>';
                    $statusClass = $order['status'] === 'Đã Xác Nhận' ? 'text-success' : 'text-danger';
                    echo '<td class="text-center align-middle ' . $statusClass . '"><strong>' . htmlspecialchars($order['status']) . '</strong></td>';
                    echo '<td>';
                    echo '<div class="d-flex">';
                    echo '<form method="POST" action="index.php?page=mOrders&act=confirmOrder">';
                    echo '<input type="hidden" name="order_id" value="' . htmlspecialchars($order['order_id']) . '">';
                    echo '<button class="btn btn-primary" type="submit"><i class="fas fa-check"></i></button>';
                    echo '</form>';
                    echo '<form method="POST" action="index.php?page=mOrders&act=viewDetailOrder">';
                    echo '<input type="hidden" name="order_id" value="' . htmlspecialchars($order['order_id']) . '">';
                    echo '<button class="btn btn-info view-order-details" type="submit" data-bs-toggle="modal" data-bs-target="#viewOrderDetailsModal" data-order-id="' . htmlspecialchars($order['order_id']) . '"><i class="fas fa-eye"></i></button>';
                    echo '</form>';
                    echo '<button class="btn btn-danger delete-order" type="button" data-bs-toggle="modal" data-bs-target="#deleteOrderModal" data-order-id="' . htmlspecialchars($order['order_id']) . '"><i class="fas fa-trash-alt"></i></button>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">Không có đơn hàng nào.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Delete Order Modal -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteOrderModalLabel">Xóa đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn xóa đơn hàng này?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="index.php?page=mOrders&act=deleteOrder">
                    <input type="hidden" id="delete-order-id-input" name="order_id" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>