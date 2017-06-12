<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Detalle Propietario</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inNombresPropietario">Nombre(s)</label>
                        <input class="form-control" disabled id="inNombresPropietario" name="inNombresPropietario" type="text" value="<?php echo $propietario[NOMBRES_PROPIETARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inApellidosPropietario">Apellido(s)</label>
                        <input class="form-control" disabled id="inApellidosPropietario" name="inApellidosPropietario" type="text" value="<?php echo $propietario[APELLIDOS_PROPIETARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inIdentificacionPropietario">Identificación</label>
                        <input class="form-control" disabled id="inIdentificacionPropietario" name="inIdentificacionPropietario" type="text" value="<?php echo $propietario[IDENTIFICACION_PROPIETARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inDireccionPropietario">Dirección</label>
                        <input class="form-control" disabled id="inDireccionPropietario" name="inDireccionPropietario" type="text" value="<?php echo $propietario[DIRECCION_PROPIETARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inCorreoElectronicoPropietario">Correo Electrónico</label>
                        <input class="form-control" disabled id="inCorreoElectronicoPropietario" name="inCorreoElectronicoPropietario" type="text" value="<?php echo $propietario[CORREO_ELECTRONICO_PROPIETARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div id="numeros_contacto_propietario">
                        <div class="col-lg-12 form-group form-group-sm" id="numeros_contacto_propietario_template">
                            <label for="inNumeroContactoPropietario#index#">Número de Contacto </label>
                            <button class="close" id="numeros_contacto_propietario_remove_current" type="button">&times;</button>
                            <input class="form-control" disabled id="inNumeroContactoPropietario#index#" name="inPropietario[#index#][numerocontacto]" type="text">
                        </div>
                        <div class="panel panel-<?php echo COLOR ?>" id="numeros_contacto_propietario_noforms_template">
                            <div class="panel-body">
                                <div class="col-lg-12">El propietario no tiene números de contacto</div>
                            </div>
                        </div>
                        <div class="col-lg-12" id="numeros_contacto_propietario_controls">
                            <a class="btn btn-block btn-<?php echo COLOR ?>" id="numeros_contacto_propietario_add">Agregar Número de Contacto</a>
                            <a class="btn btn-block btn-<?php echo COLOR ?> hidden" id="numeros_contacto_propietario_remove_last">Quitar Número de Contacto</a>
                            <a class="btn btn-block btn-<?php echo COLOR ?> hidden" id="numeros_contacto_propietario_remove_all">Quitar Todos los Números de Contacto</a>
                            <input class="hidden" id="numeros_contacto_propietario_add_n_input" type="text">
                            <a class="btn btn-block btn-<?php echo COLOR ?> hidden" id="numeros_contacto_propietario_add_n_button">Agregar Números de Contacto</a>
                        </div>
                    </div>
                </div>
            </div>                                  
            </form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>
<script>
    $(document).ready(function () {
        $('#numeros_contacto_propietario').sheepIt({
            separator: '',
            allowRemoveLast: false,
            allowRemoveCurrent: false,
            allowRemoveAll: false,
            allowAdd: false,
            allowAddN: false,
            removeAllConfirmation: false,
            maxFormsCount: 0,
            minFormsCount: 1,
            iniFormsCount: 1,
            continuousIndex: true,
            data: [
<?php
if (!empty($propietarioNumerosContactoConcatenado)) {
    $numerosContacto = explode(' - ', $propietarioNumerosContactoConcatenado[NUMERO_CONTACTO_PROPIETARIO]);
    foreach ($numerosContacto as $numeroContacto) {
        echo '{\'inNumeroContactoPropietario#index#\':\'' . $numeroContacto . '\'},';
    }
}
?>
            ]
        });
    });
</script>