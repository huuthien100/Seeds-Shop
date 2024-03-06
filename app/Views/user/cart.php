<div class="container mt-5 mb-5">
    <h1 class="text-center">Giỏ hàng</h1>
    <?php if (!empty($cartItem)) : ?>
        <form id="cart-form" action="index.php?page=cart&act=updateQuantity" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItem as $item) : ?>
                        <tr>
                            <td><?php echo $item['product_name']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-success decrement" type="submit" name="decrease" value="<?php echo $item['cart_id']; ?>">-</button>
                                <span class="quantity"><?php echo $item['quantity']; ?></span>
                                <button class="btn btn-sm btn-success increment" type="submit" name="increase" value="<?php echo $item['cart_id']; ?>">+</button>
                            </td>
                            <td><?php echo number_format($item['price'], 0, '.', ','); ?> VNĐ</td>
                            <td class="total"><?php echo number_format($item['total_price'], 0, '.', ','); ?> VNĐ</td>
                            <td>
                                <button class="btn btn-danger remove" name="remove" value="<?php echo $item['cart_id']; ?>">Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="text-end">
                <?php
                $totalPrice = 0;
                foreach ($cartItem as $item) {
                    $totalPrice += $item['total_price'];
                }
                ?>
                <p><strong>Thành tiền: <?php echo number_format($totalPrice, 0, '.', ','); ?> VNĐ</strong></p>
                <a class="btn btn-primary" href="index.php?page=home">Tiếp tục mua hàng</a>
                <button class="btn btn-success" type="submit" name="checkout">Thanh toán</button>
            </div>
        </form>
    <?php else : ?>
        <p class="text-center">Giỏ hàng trống.</p>
        <div class="text-center">
            <a class="btn btn-primary" href="index.php?page=home">Tiếp tục mua hàng</a>
        </div>
    <?php endif; ?>
</div>
