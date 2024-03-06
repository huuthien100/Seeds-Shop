$(document).ready(function () {
    $.validator.addMethod("phoneLength", function (value, element) {
        return this.optional(element) || /^[0-9]{10}$/.test(value);
    }, "Số điện thoại phải có đúng 10 ký tự");
    $("#form_register").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            repassword: {
                required: true,
                equalTo: "#password",
            },
            full_name: {
                required: true,
            },
            address: {
                required: true,
            },
            phone: {
                required: true,
                digits: true,
                phoneLength: true,
            },
        },
        messages: {
            username: {
                required: "Vui lòng nhập tên người dùng",
                minlength: "Tên người dùng phải có ít nhất 3 ký tự",
            },
            email: {
                required: "Vui lòng nhập địa chỉ email",
                email: "Địa chỉ email không hợp lệ",
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 6 ký tự",
            },
            repassword: {
                required: "Vui lòng nhập lại mật khẩu",
                equalTo: "Mật khẩu không trùng khớp",
            },
            full_name: {
                required: "Vui lòng nhập họ và tên",
            },
            address: {
                required: "Vui lòng nhập địa chỉ",
            },
            phone: {
                required: "Vui lòng nhập số điện thoại",
                digits: "Số điện thoại không hợp lệ",
                phoneLength: "Số điện thoại không hợp lệ",
            },
        },
    });
});

