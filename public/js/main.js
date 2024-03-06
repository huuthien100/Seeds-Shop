
$(document).ready(function () {
    // product
    $(".edit-product").click(function () {
        const productId = $(this).data("product-id");
        const productRow = $(this).closest("tr");
        const productInfo = productRow.find("td");
        const priceText = productInfo.eq(1).text();
        const price = parseFloat(priceText.replace(/\./g, '').replace('VNĐ', '').trim());
        $("#product_name_edit").val(productInfo.eq(0).text());
        $("#price_edit").val(price);
        $("#description_edit").text(productInfo.eq(2).text());
        $("#stock_quantity_edit").val(productInfo.eq(4).text());
        $("#edit-product-id-input").val(productId);
        const imageUrl = productInfo.eq(3).find("img").attr("src");
        $("#product_image_edit").attr("src", imageUrl);
    });
    $(".delete-product").click(function () {
        const productId = $(this).data("product-id");
        $("#delete-product-id-input").val(productId);
    });
    // user
    $(".edit-user").click(function () {
        const userId = $(this).data("user-id");
        const userRow = $(this).closest("tr");
        const userInfo = userRow.find("td");

        $("#username_edit").val(userInfo.eq(0).text());
        $("#email_edit").val(userInfo.eq(1).text());
        $("#address_edit").val(userInfo.eq(2).text());
        $("#edit-user-id-input").val(userId);
        $("#full_name_edit").val(userInfo.eq(3).text());
        $("#phone_edit").val(userInfo.eq(4).text());
        $("#access_edit").val(userInfo.eq(5).text());
        if (userAccess === "Admin") {
            $("#access_edit").val("1");
        } else if (userAccess === "User") {
            $("#access_edit").val("2");
        }
    });

    $(".delete-user").click(function () {
        const userId = $(this).data("user-id");
        $("#delete-user-id-input").val(userId);
    });
    // order
    $(".delete-order").click(function () {
        const userId = $(this).data("order-id");
        $("#delete-order-id-input").val(userId);
    });
});

