"use strict";

$(function () {
    $("#frmInsertDocumento").formValidation(
        objectValidate({
            txtDescripcion: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                },
            },
            txtFechaApertura: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                    regexp: {
                        regexp: /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/,
                        message: "Formato incorrecto",
                    },
                },
            },
            txtFechaCierre: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                    regexp: {
                        regexp: /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/,
                        message: "Formato incorrecto",
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
