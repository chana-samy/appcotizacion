"use strict";

$(function () {
    $("#frmInsertRequerimiento").formValidation(
        objectValidate({
            txtDescripcion: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
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

function sendFrmInsertRequerimiento() {
    var isValid = null;

    $("#frmInsertRequerimiento").data("formValidation").resetForm();
    $("#frmInsertRequerimiento").data("formValidation").validate();

    isValid = $("#frmInsertRequerimiento").data("formValidation").isValid();

    if (!isValid) {
        incorrectNote();

        return;
    }

    confirmDialogSend("frmInsertRequerimiento");
}
