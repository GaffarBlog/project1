$(document).ready(function () {
    $(".edit_btn").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: route("admin.user-role.edit", { id: id }),
            method: "GET",
            success: ({ role, status }) => {
                if (status) {
                    $("#editId").val(role.id);
                    $("#editUserRole").val(role.name);
                    $("#editUserDescription").val(role.description);
                    $("#editModal").modal("show");
                }
            },
        });
    });

    $(".create-btn").on("click", function () {
        $("#createModal").modal("show");
    });
});
