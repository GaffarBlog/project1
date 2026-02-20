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
