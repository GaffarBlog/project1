$(document).ready(function () {
    $("#permission_all").on("change", function () {
        const isChecked = $(this).is(":checked");
        $(".permissions").each(function () {
            $(this).prop("checked", isChecked);
        });
        $(".parent_permissions").each(function () {
            $(this).prop("checked", isChecked);
        });
    });
});
