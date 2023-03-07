"use strict";

$(function () {
    $("#frmEditarRequerimiento").formValidation(
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

function sendFrmEditarRequerimiento() {
    var isValid = null;
    console.log($("#txtFechaCierre").val());

    $("#frmEditarRequerimiento").data("formValidation").resetForm();
    $("#frmEditarRequerimiento").data("formValidation").validate();

    isValid = $("#frmEditarRequerimiento").data("formValidation").isValid();

    if (!isValid) {
        incorrectNote();

        return;
    }

    confirmDialogSend("frmEditarRequerimiento");
}
