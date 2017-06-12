function procesarFormulario(url, idFormulario, mensajeExito, mensajeError, urlRedireccion, limpiar) {
    if (!$('.offline-ui-down').is(":visible")) {
        $.ajax({
            url: url,
            method: 'post',
            data: $('#' + idFormulario).serialize(),
            dataType: "json",
            success: function (respuesta) {
                if (respuesta === true) {
                    if (limpiar)
                        limpiarFormulario(idFormulario);
                    if (mensajeExito != null)
                        mostrarMensaje('Información', mensajeExito);
                    if (urlRedireccion != null)
                        window.location = urlRedireccion;
                } else if (respuesta === false) {
                    if (mensajeError != null)
                        mostrarMensaje('Error', mensajeError);
                } else {
                    mostrarErrores(respuesta);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                mostrarMensaje('Error', 'Se ha producido un error desconocido, por favor comuníquese con el administrador de sistema.');
            },
            beforeSend: function () {
                mostrarCargando();
                habilitarBotones(false);
            },
            complete: function () {
                habilitarBotones(true);
                ocultarCargando();
            }
        });
    }
}

function procesarFormularioCambioCantidad(url, idFormulario, cambio, idAfiliacionBeneficio, nombreBeneficio) {
    var cantidadMaxima = $('#cantidadMaxima' + idAfiliacionBeneficio).text();
    var cantidadUsada = $('#cantidadUsada' + idAfiliacionBeneficio).text();
    if (cambio == '+' && cantidadMaxima == cantidadUsada) {
        mostrarMensaje('Información', 'Ya se uso la cantidad disponible del beneficio ' + nombreBeneficio);
        return;
    }
    if (cambio == '-' && cantidadUsada == 0) {
        mostrarMensaje('Información', 'No puede disminuir el benefio  ' + nombreBeneficio + ' a menos de 0');
        return;
    }
    if (!$('.offline-ui-down').is(":visible")) {
        $.ajax({
            url: url,
            method: 'post',
            data: $('#' + idFormulario).serialize(),
            dataType: "json",
            success: function (respuesta) {
                if (respuesta === true) {
                    if (cambio == '+')
                        $('#cantidadUsada' + idAfiliacionBeneficio).empty().text((cantidadUsada * 1.0) + 1);
                    else if (cambio == '-')
                        $('#cantidadUsada' + idAfiliacionBeneficio).empty().text((cantidadUsada * 1.0) - 1);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                mostrarMensaje('Error', 'Se ha producido un error desconocido, por favor comuníquese con el administrador de sistema.');
            },
            beforeSend: function () {
                mostrarCargando();
                habilitarBotones(false);
            },
            complete: function () {
                habilitarBotones(true);
                ocultarCargando();
            }
        });
    }
}

function procesarFormularioModal(url, idFormulario, mensajeExito, mensajeError, urlRedireccion, limpiar, modal) {
    if (!$('.offline-ui-down').is(":visible")) {
        $.ajax({
            url: url,
            method: 'post',
            data: $('#' + idFormulario).serialize(),
            dataType: "json",
            success: function (respuesta) {
                if (respuesta === true) {
                    $(modal).modal('hide');
                    if (limpiar)
                        limpiarFormulario(idFormulario);
                    if (mensajeExito != null)
                        mostrarMensajeModal('Información', mensajeExito, null, urlRedireccion);
                } else if (respuesta === false) {
                    $(modal).modal('hide');
                    if (mensajeError != null)
                        mostrarMensajeModal('Error', mensajeError, modal, null);
                } else {
                    mostrarErrores(respuesta);
                }
                ejecutarFuncionAdicional(idFormulario);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $(modal).modal('hide');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                mostrarMensajeModal('Error', 'Se ha producido un error desconocido, por favor comuníquese con el administrador de sistema.', modal, null);
            },
            beforeSend: function () {
                mostrarCargando();
                habilitarBotones(false);
            },
            complete: function () {
                habilitarBotones(true);
                ocultarCargando();
            }
        });
    }
}

function calcularFechaProximaVacuna(url, idFormulario) {
    var estado = true;
    if ($('#inFechaVacuna').val() == '') {
        estado = false;
        $('#inFechaVacunaError').hide().empty();
        $('#inFechaVacunaError').text('Debe ingresar la fecha de la vacuna').fadeIn();
    }
    if ($('#tiempo').val() == '') {
        estado = false;
        $('#tiempoError').hide().empty();
        $('#tiempoError').text('Debe ingresar el tiempo').fadeIn();
    }
    if ($('#cantidad').val() == '') {
        estado = false;
        $('#cantidadError').hide().empty();
        $('#cantidadError').text('Debe ingresar la cantidad').fadeIn();
    }
    if (estado) {
        procesarCalcularFechaProximaVacuna(url, idFormulario);
    }
}

function procesarCalcularFechaProximaVacuna(url, idFormulario) {
    if (!$('.offline-ui-down').is(":visible")) {
        $.ajax({
            url: url,
            method: 'post',
            data: $('#' + idFormulario).serialize(),
            dataType: "json",
            success: function (respuesta) {
                $('#inFechaProximaVacuna').val(respuesta);
            }
        });
    }
}

function habilitarBotones(estado) {
    if (estado) {
        $('a').removeClass('disabled');
    } else {
        $('a').addClass('disabled');
    }
}

function limpiarFormulario(idFormulario) {
    $('#' + idFormulario).each(function () {
        this.reset();
    });
}

function mostrarErrores(errores) {
    $('.error').hide().empty();
    for (var i in errores) {
        $('#' + errores[i]['campo'] + 'Error').text(errores[i]['mensaje']).fadeIn();
    }
}

function ocultarError(idCampo) {
    $('#' + idCampo + 'Error').fadeOut();
}

function mostrarMensaje(titulo, contenido) {
    $('#modalMensajeTitulo').empty().text(titulo);
    $('#modalMensajeContenido').empty().text(contenido);
    $('#modalMensaje').modal('show');
}

function mostrarMensajeModal(titulo, contenido, modal, urlRedireccion) {
    $('#modalMensajeModalTitulo').empty().text(titulo);
    $('#modalMensajeModalContenido').empty().text(contenido);
    $('#modalMensajeModal').modal('show');
    if (modal != null)
        $("#modalMensajeModalBoton").attr("onclick", '$(\'' + modal + '\').modal(\'hide\')');
    else {
        if (urlRedireccion != null)
            $("#modalMensajeModalBoton").attr("onclick", 'window.location = "' + urlRedireccion + '"');
        else
            $("#modalMensajeModalBoton").attr("onclick", 'location.reload()');
    }
}

function mostrarFileManager() {
    $('#modalFileManager').modal('show');
}

function descargarAutorizacion(url) {
    if ($('#inProcedimiento').val() == '' || $('#inCedulaAutorizacion').val() == '') {
        $('.error').hide().empty();
        if ($('#inProcedimiento').val() == '')
            $('#inProcedimientoError').text("El campo procedimiento es requerido.").fadeIn();
        if ($('#inCedulaAutorizacion').val() == '')
            $('#inCedulaAutorizacionError').text("El campo cédula es requerido.").fadeIn();
    } else {
        window.location.href = url + encodeURI($('#inCedulaAutorizacion').val()) + "/" + encodeURI($('#inProcedimiento').val());
        $('#inProcedimiento').val('');
        $('#inCedulaAutorizacion').val('');
    }
}

function descargarHospitalizacion(url) {
    if ($('#inCedulaHospitalizacion').val() == '') {
        $('.error').hide().empty();
        if ($('#inCedulaHospitalizacion').val() == '')
            $('#inCedulaHospitalizacionError').text("El campo cédula es requerido.").fadeIn();
    } else {
        window.location.href = url + encodeURI($('#inCedulaHospitalizacion').val());
        $('#inCedulaHospitalizacion').val('');
    }
}

function descargarCertificacion(url) {
    if (/*$('#inPasaporte').val() == '' || */$('#inCedulaCertificacion').val() == '' || $('#inContenido').val() == '') {
        $('.error').hide().empty();
        /*if ($('#inPasaporte').val() == '')
         $('#inPasaporteError').text("El campo pasaporte es requerido.").fadeIn();*/
        if ($('#inCedulaCertificacion').val() == '')
            $('#inCedulaCertificacionError').text("El campo cédula es requerido.").fadeIn();
        if ($('#inContenido').val() == '')
            $('#inContenidoError').text("El campo contenido es requerido.").fadeIn();
    } else {
        var pasaporte = $('#inPasaporte').val();
        if (pasaporte == '') {
            pasaporte = 'No Tiene';
        }
        window.location.href = url + encodeURI($('#inCedulaCertificacion').val()) + "/" + encodeURI($('#inContenido').val()) + "/" + encodeURI(pasaporte);
        $('#inPasaporte').val('');
        $('#inCedulaCertificacion').val('');
        $('#inContenido').val('');
    }
}

function mostrarAutorizacion() {
    $('#modalAutorizacion').modal('show');
}

function mostrarCertificacion() {
    $('#modalCertificacion').modal('show');
}

function mostrarModificarPropietario() {
    $('#modalModificarPropietario').modal('show');
}

function mostrarEliminarPropietario() {
    $('#modalEliminarPropietario').modal('show');
}

function mostrarModificarPaciente() {
    $('#modalModificarPaciente').modal('show');
}

function mostrarEliminarPaciente() {
    $('#modalEliminarPaciente').modal('show');
}

function mostrarModificarConsulta() {
    $('#modalModificarConsulta').modal('show');
}

function mostrarEliminarConsulta() {
    $('#modalEliminarConsulta').modal('show');
}

function mostrarModal(modal) {
    $(modal).modal('show');
}

function mostrarCargando() {
    $('#modalCargando').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function ocultarCargando() {
    $('#modalCargando').modal('hide');
}

function reloj() {
    var tiempo = new Date();
    var horas = tiempo.getHours();
    var minutos = tiempo.getMinutes();
    var segundos = tiempo.getSeconds();
    minutos = (minutos < 10 ? "0" : "") + minutos;
    segundos = (segundos < 10 ? "0" : "") + segundos;
    var meridiano = (horas < 12) ? "AM" : "PM";
    horas = (horas > 12) ? horas - 12 : horas;
    horas = (horas == 0) ? 12 : horas;
    var tiempoString = horas + ":" + minutos + ":" + segundos + " " + meridiano;
    $("#reloj").html(tiempoString);
}

function procesarHistoriaClinica(idPropietario, idPaciente, idHistoriaClinica) {
    $('#inIdPropietario').attr('value', idPropietario);
    $('#inIdPaciente').attr('value', idPaciente);
    $('#inIdHistoriaClinica').attr('value', idHistoriaClinica);
    $('#frmHistoriaClinica').submit();
}

function procesarConsulta(idConsulta) {
    $('#inIdConsulta').attr('value', idConsulta);
    $('#frmConsulta').submit();
}

$(document).ready(function () {
//setInterval(reloj, 1000);
    $('input').live('focusout', function () {
        ocultarError($(this).attr('id'));
    });
    $('select').live('focusout', function () {
        ocultarError($(this).attr('id'));
    });
    $('textarea').live('focusout', function () {
        ocultarError($(this).attr('id'));
    });
    $('.fecha').off('focus click');
});
$(window).load(function () {

});
function procesarPagina(url, pagina, contenedor, filtro) {
    if (!$('.offline-ui-down').is(":visible")) {
        $.ajax({
            url: url,
            method: 'post',
            data: {
                inPagina: pagina,
                inCampoFiltro: $('#inCampoFiltro' + filtro).val(),
                inValorFiltro: $('#inValorFiltro' + filtro).val(),
                inContenedor: contenedor,
                inFiltro: filtro
            },
            dataType: "json",
            success: function (respuesta) {
                $(contenedor).empty();
                $(contenedor).html(respuesta.tabla);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                mostrarMensaje('Error', 'Se ha producido un error desconocido, por favor comuníquese con el administrador de sistema.');
            },
            beforeSend: function () {
                mostrarCargando();
                habilitarBotones(false);
            },
            complete: function () {
                habilitarBotones(true);
                ocultarCargando();
            }
        });
    }
}

function abrirPickadate(id) {
    var input = $('#' + id).pickadate({
        container: '#date-picker',
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        showMonthsShort: true,
        showWeekdaysShort: true,
        today: 'Hoy',
        clear: 'Vaciar',
        close: 'Cerrar',
        format: 'yyyy-mm-dd',
        selectYears: true,
        selectMonths: true
    });
    var picker = input.pickadate('picker');
    picker.on({
        close: function () {
            picker.stop();
            $('#' + id).prop('readonly', true);
        }
    });
    if (picker.get('open')) {
        picker.close();
    } else {
        picker.open();
    }
    event.stopPropagation();
}

function filtrar(url, contenedor, filtro) {
    if ($('#inCampoFiltro' + filtro).val() != '' && $('#inValorFiltro' + filtro).val() != '') {
        procesarPagina(url, 0, contenedor, filtro);
    } else {
        mostrarMensaje('Información', 'Debe seleccionar el campo e ingresar el valor por el cual desea realizar el filtro.');
    }
}

function borrarFiltro(url, contenedor, filtro) {
    $('#inCampoFiltro' + filtro).val('');
    $('#inValorFiltro' + filtro).val('');
    procesarPagina(url, 0, contenedor, filtro);
}

function formularioCrearVacuna(fecha) {
    $('#inIdVacuna').val();
    $('#inTipoVacuna').val('');
    $('#inMedicamentoVacuna').val('');
    $('#inFechaVacuna').val(fecha);
    $('#inFechaProximaVacuna').val('');
    $('#inFechaProximaVacuna').val('');
    $('#tiempo').val('');
    $('#cantidad').val('');
    $('#btnCrear').show();
    $('#btnModificar').hide();
    mostrarModal('#modalCrearVacuna');
}

function formularioModificarVacuna(id, tipo, medicamento, fecha, fechaProxima) {
    $('#inIdVacuna').val(id);
    $('#inTipoVacuna').val(tipo);
    $('#inMedicamentoVacuna').val(medicamento);
    $('#inFechaVacuna').val(fecha);
    $('#inFechaProximaVacuna').val(fechaProxima);
    $('#tiempo').val('');
    $('#cantidad').val('');
    $('#btnCrear').hide();
    $('#btnModificar').show();
    mostrarModal('#modalCrearVacuna');
}

function formularioEliminarVacuna(id) {
    $('.inIdVacunaEliminar').val(id);
    mostrarModal('#modalEliminarVacuna');
}

function obtenerModal(url, data) {
    $('#modal-content').empty();
    if (!$('.offline-ui-down').is(":visible")) {
        $.ajax({
            url: url,
            method: 'post',
            data: data,
            dataType: "html",
            success: function (respuesta) {
                $('#modal-content').html(respuesta);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                mostrarMensaje('Error', 'Se ha producido un error desconocido, por favor comuníquese con el administrador de sistema.');
            },
            beforeSend: function () {
                mostrarCargando();
                habilitarBotones(false);
            },
            complete: function () {
                habilitarBotones(true);
                ocultarCargando();
            }
        });
    }
}

function crearModal(url, data, modal) {
    if (!$('.offline-ui-down').is(":visible")) {
        obtenerModal(url, data);
        mostrarModal(modal);
    }
}

function ejecutarFuncionAdicional(idFormulario) {
    switch (idFormulario) {
        case 'frmClienteCrear':
            abrirHistoriasClinicasCreadas();
            break;
        case 'frmPacienteCrear':
            abrirHistoriasClinicasCreadas();
            break;
    }
}

function abrirHistoriasClinicasCreadas() {
    $.ajax({
        url: 'http://www.dogmedicat.com/acv/HistoriaClinica/nuevas',
        method: 'post',
        dataType: "json",
        success: function (respuesta) {
            if (respuesta != null) {
                var historiaClinica;
                for (historiaClinica in respuesta) {
                    window.open('http://www.dogmedicat.com/acv/HistoriaClinica/' + respuesta[historiaClinica], '_blank');
                }
            }
        }
    });
}