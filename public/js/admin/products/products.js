$(document).ready(function () {
    $(".product_category").on("change", function () {
        const category_id = $(this).val();
        $.ajax({
            url: route("admin.products.subcategories", {
                category_id: category_id,
            }),
            method: "GET",
            success: function ({ subcategories }) {
                if (subcategories) {
                    let html = "<option disabled selected>Select Subcategory</option>";
                    subcategories.forEach((category) => {
                        html += `<option value="${category.id}">${category.name}</option>`;
                    });
                    $(".product_subcategories").html(html);
                }
            },
        });
    });
});
