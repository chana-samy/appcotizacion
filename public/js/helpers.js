var evtTimeOutJsFind = "";

function ajaxDialog(
    idContainer,
    classWidthDialog,
    title,
    data,
    url,
    method,
    preFunction,
    postFunction,
    cache,
    async
) {
    $("#" + idContainer).html("");

    if (typeof preFunction == "function") {
        preFunction();
    }

    $("#modalLoading").show();

    $.ajax({
        url: url,
        type: method,
        data: data,
        cache: cache,
        async: async,
    })
        .done(function (page) {
            $("#modalLoading").hide();

            var htmlResponse =
                '<div class="modal fade" id="' +
                idContainer +
                'Modal" data-backdrop="static" data-keyboard="false">' +
                '<div class="modal-dialog ' +
                (classWidthDialog != null && classWidthDialog != undefined
                    ? classWidthDialog
                    : "") +
                '">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<h4 class="modal-title">' +
                title +
                "</h4>" +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button>' +
                "</div>" +
                '<div class="modal-body">' +
                page +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>";

            $("#" + idContainer).html(htmlResponse);

            $("#" + idContainer + "Modal").modal("show");

            if (typeof postFunction == "function") {
                postFunction();
            }
        })
        .fail(function () {
            $("#modalLoading").hide();
            $("#" + idContainer).html(
                '<div class="callout callout-danger">Ocurrió un error inesperado. Por favor reporte esto a la plataforma o al correo "bugreport@codideep.com". Pedimos disculpas y damos gracias por su comprensión.</div>'
            );
        });
}

function confirmDialog(callback) {
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
            callback();
        }
    });
}

function confirmDialogSend(idFrm) {
    Swal.fire({
        title: "Confirmar operación",
        text: "¿Realmente desea proceder?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
    }).then((proceed) => {
        if (proceed.isConfirmed) {
            ignoreRestrictedClose = true;

            $("#modalLoading").show();

            $("#" + idFrm)[0].submit();
        }
    });
}

function warningNote(title, message) {
    new PNotify({
        title: title,
        text: message,
        type: "warning",
    });
}

function errorNote(title, message) {
    new PNotify({
        title: title,
        text: message,
        type: "error",
    });
}

function incorrectNote() {
    new PNotify({
        title: "No se pudo proceder",
        text: "Por favor complete y corrija toda la información necesaria antes de continuar.",
        type: "error",
    });
}

function successNote(title, message) {
    new PNotify({
        title: title,
        text: message,
        type: "info",
    });
}

function correctNote() {
    new PNotify({
        title: "Operación correcta",
        text: "Operación realizada correctamente.",
        type: "info",
    });
}

function objectValidate(fieldsValidate) {
    return {
        framework: "bootstrap",
        excluded: [":disabled", '[class*="notValidate"]'],
        live: "enabled",
        message:
            '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields: fieldsValidate,
    };
}
