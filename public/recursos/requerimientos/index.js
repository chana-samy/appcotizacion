"use strict";
"use strict";

$("#divSearch").formValidation(
    objectValidate({
        txtSearch: {
            validators: {
                regexp: {
                    message:
                        '<b style="color: red;">Sólo se permite texto y números.</b>',
                    regexp: /^[a-zA-Z0-9ñÑàèìòùÀÈÌÒÙáéíóúÁÉÍÓÚ\s@\.\-_]*$/,
                },
            },
        },
    })
);

function searchRequerimientos(url, event, enter) {
    var evt = event || window.event;

    var code = evt.charCode || evt.keyCode || evt.which;

    if (code == 13 || enter) {
        var isValid = null;

        $("#divSearch").data("formValidation").resetForm();
        $("#divSearch").data("formValidation").validate();

        isValid = $("#divSearch").data("formValidation").isValid();

        if (!isValid) {
            incorrectNote();

            return;
        }

        $("#modalLoading").modal("show");

        $("#txtSearch").attr("disabled", "disabled");

        window.location.href = url + `?search=${$("#txtSearch").val()}`;
    }
}
