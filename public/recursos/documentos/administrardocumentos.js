"use strict";

$(function () {
    $("#frmInsertDocumento").formValidation(
        objectValidate({
            txtNombre: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                },
            },
            fileDocumento: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                    file: {
                        extension: "pdf",
                        maxSize: 26214400,
                        message: "El archivo seleccionado no es valido",
                    },
                },
            },
        })
    );
});

function sendFrmInsertDocumento() {
    var isValid = null;

    $("#frmInsertDocumento").data("formValidation").resetForm();
    $("#frmInsertDocumento").data("formValidation").validate();

    isValid = $("#frmInsertDocumento").data("formValidation").isValid();

    if (!isValid) {
        incorrectNote();

        return;
    }

    confirmDialogSend("frmInsertDocumento");
}
