$(document).ready(function () {
    $(".product_category").on("change", function () {
        const category_id = $(this).val();
        get_subcategories(category_id);
    });
    get_subcategories(category_id, subcategory_id);
    function get_subcategories(category_id, subcategory_id = null) {
        $.ajax({
            url: route("admin.products.subcategories", {
                category_id: category_id,
            }),
            method: "GET",
            success: function ({ subcategories }) {
                if (subcategories) {
                    let html = "<option disabled selected>Select Subcategory</option>";
                    subcategories.forEach((category) => {
                        html += `<option ${subcategory_id && subcategory_id == category.id ? "selected" : ""} value="${category.id}">${category.name}</option>`;
                    });
                    $(".product_subcategories").html(html);
                }
            },
        });
    }
    // Genereate SKU
    $(".generate-sku").on("click", function () {});
});
