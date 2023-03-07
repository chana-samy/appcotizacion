'use strict';

$(function () {
    $('#frmEditarUsuario').formValidation(
        objectValidate({
            txtNombre: {
                validators: {
                    notEmpty: {
                        message: 'Este campo es requerido',
                    },
                },
            },
            txtApellido: {
                validators: {
                    notEmpty: {
                        message: 'Este campo es requerido',
                    },
                },
            },
            txtCorreo: {
                validators: {
                    notEmpty: {
                        message: 'Este campo es requerido',
                    },
                    emailAddress: {
                        message: 'El correo electrónico no es válido',
                    },
                },
            },
            txtDni: {
                validators: {
                    notEmpty: {
                        message: 'Este campo es requerido',
                    },
                },
            },
            password: {
                validators: {
                    stringLength: {
                        min: 8,
                        message: 'La contraseña debe tener al menos 8 caracteres',
                    },
                },
            },
            password_confirmation: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Las contraseñas no coinciden',
                    },
                },
            },
        })
    );
});

function sendFrmEditarUsuario() {
    var isValid = null;

    $('#frmEditarUsuario').data('formValidation').resetForm();
    $('#frmEditarUsuario').data('formValidation').validate();

    isValid = $('#frmEditarUsuario').data('formValidation').isValid();

    if (!isValid) {
        incorrectNote();

        return;
    }

    confirmDialogSend('frmEditarUsuario');
}