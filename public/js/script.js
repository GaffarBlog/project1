$(document).ready(function () {
    $("input.imageInput").on("change", function () {
        const file = this.files[0];
        const targetId = $(this).data("target");
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#" + targetId)
                    .attr("src", e.target.result)
                    .show();
            };

            reader.readAsDataURL(file);
        }
    });

    // hide alert after 5 seconds
    setTimeout(function () {
        $(".alert-box").fadeOut("slow");
    }, 6000);

    // Open delete modal and set user id
    $(".delete_btn").on("click", function () {
        const id = $(this).data("id");
        $("#deleteId").val(id);
        $("#deleteModal").modal("show");
    });
});
