$(document).ready(function () {
    $(".edit_btn").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: route("admin.users.edit", { id: id }),
            method: "GET",
            success: ({ user, status }) => {
                if (status) {
                    $("#editId").val(user.id);
                    $("#editUserName").val(user.name);
                    $("#editUserEmail").val(user.email);
                    $("#editUserAddress").val(user.address);
                    $("#editModal").modal("show");
                }
            },
        });
    });

    $(".delete_btn").on("click", function () {
        const id = $(this).data("id");
        $("#deleteId").val(id);
        $("#deleteModal").modal("show");
    });

    $(".create-btn").on("click", function () {
        $("#createModal").modal("show");
    });
});
