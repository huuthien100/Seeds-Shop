<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Danh sách người dùng</h1>
        </div>
        <div class="col text-end pb-1">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus"></i> Thêm
            </button>
        </div>
    </div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Quyền truy cập</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($users && count($users) > 0) {
                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($user['username']) . '</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($user['email']) . '</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($user['full_name']) . '</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($user['address']) . '</td>';
                    echo '<td class="text-center align-middle">' . htmlspecialchars($user['phone']) . '</td>';
                    echo '<td class="text-center align-middle">';
                    if ($user['access'] == 1) {
                        echo '<strong><span class="text-danger">admin</span></strong>';
                    } elseif ($user['access'] == 2) {
                        echo '<strong><span class="text-success">user</span></strong>';
                    }
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="text-center">';
                    echo '<button class="btn btn-primary edit-user" type="button" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-user-id="' . htmlspecialchars($user['user_id']) . '"><i class="fas fa-edit"></i></button>';
                    echo '<button class="btn btn-danger delete-user" type="button" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="' . htmlspecialchars($user['user_id']) . '"><i class="fas fa-trash-alt"></i></button>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">Không có người dùng nào.</td></tr>';
            }
            ?>

        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Thêm người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="index.php?page=mUsers&act=addUser">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="access" class="form-label">Quyền truy cập</label>
                        <select class="form-select" id="access" name="access">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Lưu người dùng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Sửa người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="index.php?page=mUsers&act=updateUser">
                <div class="modal-body">
                    <input type="hidden" id="edit-user-id-input" name="user_id" value="">
                    <div class="mb-3">
                        <label for="username_edit" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username_edit" name="username" value="">
                    </div>
                    <div class="mb-3">
                        <label for="email_edit" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_edit" name="email" value="">
                    </div>
                    <div class="mb-3">
                        <label for="password_edit" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password_edit" name="password" value="">
                    </div>
                    <div class="mb-3">
                        <label for="full_name_edit" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="full_name_edit" name="full_name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="address_edit" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address_edit" name="address" value="">
                    </div>
                    <div class="mb-3">
                        <label for="phone_edit" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone_edit" name="phone" value="">
                    </div>
                    <div class="mb-3">
                        <label for="access_edit" class="form-label">Quyền truy cập</label>
                        <select class="form-select" id="access_edit" name="access">
                            <option id='access_admin_edit' value="admin">Admin</option>
                            <option id='access_user_edit' value="user">User</option>
                        </select>
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

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Xóa người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn xóa người dùng này?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="index.php?page=mUsers&act=deleteUser">
                    <input type="hidden" id="delete-user-id-input" name="user_id" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>