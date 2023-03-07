"use strict";
let docLength = 8;
$(document).ready(function () {
    $("#selectTipoPersona").change(function () {
        if ($(this).val() == "natural") {
            $("#namePerson").text("Nombre completo*");
            $("#documentPerson").text("DNI*");
            docLength = 8;
        } else {
            $("#namePerson").text("Razon social*");
            $("#documentPerson").text("RUC*");
            docLength = 11;
        }
    });
});
$(function () {
    $("#frmCotizacion").validate({
        rules: {
            selectTipoPersona: {
                required: true,
            },
            txtNombre: {
                required: true,
            },
            txtDocumento: {
                required: true,
                minlength: function () {
                    return docLength;
                },
                maxlength: function () {
                    return docLength;
                },
            },
            txtTelefono: {
                required: true,
                minlength: 9,
                maxlength: 9,
            },
            txtCorreo: {
                required: true,
                email: true,
            },
            txtAsunto: {
                required: true,
            },
            fileCotizacion: {
                required: true,
                extension: "pdf",
                maxsize: 25000000,
            },
        },
        messages: {
            selectTipoPersona: {
                required: "Este campo es obligatorio",
            },
            txtNombre: {
                required: "Este campo es obligatorio",
            },
            txtDocumento: {
                required: "Este campo es obligatorio",
                minlength: "Ingrese un documento valido",
                maxlength: "Ingrese un documento valido",
            },
            txtTelefono: {
                required: "Este campo es obligatorio",
                minlength: "Ingrese un telefono valido",
                maxlength: "Ingrese un telefono valido",
            },
            txtCorreo: {
                required: "Este campo es obligatorio",
                email: "Ingrese un correo valido",
            },
            txtAsunto: {
                required: "Este campo es obligatorio",
            },
            fileCotizacion: {
                required: "Este campo es obligatorio",
                extension: "Solo se permite archivos pdf",
                maxsize: "El tamaño maximo es de 25MB",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
            $(element).addClass("is-valid");
        },
        success: function (label) {
            label.addClass("is-valid");
        },
        submitHandler: function (form) {
            Swal.fire({
                title: "Confirmar operación",
                text: "¿Realmente desea proceder?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, proceder!",
                cancelButtonText: "No, cancelar!",
            }).then((proceed) => {
                if (proceed.isConfirmed) {
                    $("#frmCotizacion")[0].submit();
                }
            });
        },
    });
});
