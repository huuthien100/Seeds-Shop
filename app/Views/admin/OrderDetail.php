<div class="container mt-5">
    <h1>Chi Tiết Đơn Hàng</h1>
    <?php if (!empty($orderDetails)) : ?>
        <table class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails as $detail) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        <td><?php echo number_format($detail['price'], 0, ',', '.') . ' VNĐ'; ?></td>
                        <td><?php echo number_format($detail['total_price'], 0, ',', '.') . ' VNĐ'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Không có chi tiết đơn hàng.</p>
    <?php endif; ?>
</div>
