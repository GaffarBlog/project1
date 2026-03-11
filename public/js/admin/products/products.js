$(document).ready(function () {
    $(".product_category").on("change", function () {
        const category_id = $(this).val();
        get_subcategories(category_id);
    });
    if (category_id) {
        get_subcategories(category_id, subcategory_id);
    }

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
    // Select both checkboxes by their IDs
    $("#isFreeShipping, #is_multiple_by_quantity").on("change", function () {
        console.log($(this).attr("name"));

        if ($(this).is(":checked")) {
            // Uncheck the other checkbox if this one is checked
            $("#isFreeShipping, #is_multiple_by_quantity").not(this).prop("checked", false);
            if ($(this).attr("name") === "is_free_shipping") {
                $("#shippingCost").val(0);
            }
        }
    });
});
