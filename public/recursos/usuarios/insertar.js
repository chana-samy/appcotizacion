'use strict';

$(function () {
    $('#frmInstarUsuario').formValidation(
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
                    notEmpty: {
                        message: 'Este campo es requerido',
                    },
                    stringLength: {
                        min: 8,
                        message: 'La contraseña debe tener al menos 8 caracteres',
                    },
                },
            },
            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'Este campo es requerido',
                    },
                    identical: {
                        field: 'password',
                        message: 'Las contraseñas no coinciden',
                    },
                },
            },
        })
    );
});

function sendFrmInsertarUsuario() {
    var isValid = null;

    $('#frmInstarUsuario').data('formValidation').resetForm();
    $('#frmInstarUsuario').data('formValidation').validate();

    isValid = $('#frmInstarUsuario').data('formValidation').isValid();

    if (!isValid) {
        incorrectNote();

        return;
    }

    confirmDialogSend('frmInstarUsuario');
}