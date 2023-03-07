"use strict";

$(function () {
    $("#frmEditarPerfil").formValidation(
        objectValidate({
            txtNombre: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                },
            },
            txtApellido: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                },
            },
            txtCorreo: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                    emailAddress: {
                        message: "El correo electrónico no es válido",
                    },
                },
            },
            txtDni: {
                validators: {
                    notEmpty: {
                        message: "Este campo es requerido",
                    },
                },
            },
            password: {
                validators: {
                    stringLength: {
                        min: 8,
                        message:
                            "La contraseña debe tener al menos 8 caracteres",
                    },
                },
            },
            password_confirmation: {
                validators: {
                    identical: {
                        field: "password",
                        message: "Las contraseñas no coinciden",
                    },
                },
            },
            fileFoto: {
                validators: {
                    file: {
                        extension: "jpeg,jpg,png",
                        type: "image/jpeg,image/png",
                        maxSize: 2097152, // 2048 * 1024
                        message: "El archivo seleccionado no es válido",
                    },
                },
            },
        })
    );
});

function sendFrmEditarPerfil() {
    var isValid = null;

    var isValid = null;

    $("#frmEditarPerfil").data("formValidation").resetForm();
    $("#frmEditarPerfil").data("formValidation").validate();

    isValid = $("#frmEditarPerfil").data("formValidation").isValid();

    if (!isValid) {
        incorrectNote();

        return;
    }

    confirmDialogSend("frmEditarPerfil");
}
