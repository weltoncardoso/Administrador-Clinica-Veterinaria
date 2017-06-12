<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Crear Propietarios y Mascotas</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form id="frmClienteCrear" name="frmClienteCrear">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-<?php echo COLOR ?>">
                                <div class="panel-heading">
                                    <h1 class="panel-title panel-title-personalizado">
                                        <strong>Información Propietario</strong>
                                    </h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 form-group form-group-sm">
                                            <label for="inNombresPropietario">Nombre(s)</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inNombresPropietarioError"></label>
                                            <input class="form-control" id="inNombresPropietario" name="inNombresPropietario" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group form-group-sm">
                                            <label for="inApellidosPropietario">Apellido(s)</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inApellidosPropietarioError"></label>
                                            <input class="form-control" id="inApellidosPropietario" name="inApellidosPropietario" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group form-group-sm">
                                            <label for="inIdentificacionPropietario">Identificación</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inIdentificacionPropietarioError"></label>
                                            <input class="form-control" id="inIdentificacionPropietario" name="inIdentificacionPropietario" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group form-group-sm">
                                            <label for="inDireccionPropietario">Dirección</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inDireccionPropietarioError"></label>
                                            <input class="form-control" id="inDireccionPropietario" name="inDireccionPropietario" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group form-group-sm">
                                            <label for="inCorreoElectronicoPropietario">Correo Electrónico</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inCorreoElectronicoPropietarioError"></label>
                                            <input class="form-control" id="inCorreoElectronicoPropietario" name="inCorreoElectronicoPropietario" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="numeros_contacto_propietario">
                                            <div class="col-lg-12 form-group form-group-sm" id="numeros_contacto_propietario_template">
                                                <label for="inNumeroContactoPropietario#index#">Número de Contacto </label>
                                                <label class="badge label-<?php echo COLOR ?> error" id="inNumeroContactoPropietario#index#Error"></label>
                                                <button class="close" id="numeros_contacto_propietario_remove_current" type="button">&times;</button>
                                                <input class="form-control" id="inNumeroContactoPropietario#index#" name="inPropietario[#index#][numerocontacto]" type="text">
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
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="pacientes">
                                <div class="panel panel-<?php echo COLOR ?>" id="pacientes_template">
                                    <div class="panel-heading">
                                        <h1 class="panel-title panel-title-personalizado">
                                            <strong>Información del Paciente</strong>
                                            <button class="close" id="pacientes_remove_current" type="button">&times;</button>                                        
                                        </h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6 form-group form-group-sm">
                                                <label for="inNombrePaciente#index#">Nombre</label>
                                                <label class="badge label-<?php echo COLOR ?> error" id="inNombrePaciente#index#Error"></label>
                                                <input class="form-control" id="inNombrePaciente#index#" name="inPaciente[#index#][nombre]" type="text">
                                            </div>
                                            <div class="col-lg-6 form-group form-group-sm">
                                                <label for="inEspeciePaciente#index#">Especie</label>
                                                <label class="badge label-<?php echo COLOR ?> error" id="inEspeciePaciente#index#Error"></label>
                                                <select class="form-control" id="inEspeciePaciente#index#" name="inPaciente[#index#][especie]">
                                                    <option value="">SELECCIONAR</option>
                                                    <option value="CANINO">CANINO</option>
                                                    <option value="FELINO">FELINO</option>                                                        
                                                    <option value="OTRO">OTRO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 form-group form-group-sm">
                                                <label for="inRazaPaciente#index#">Raza</label>
                                                <label class="badge label-<?php echo COLOR ?> error" id="inRazaPaciente#index#Error"></label>
                                                <input class="form-control" id="inRazaPaciente#index#" name="inPaciente[#index#][raza]" type="text">
                                            </div>
                                            <div class="col-lg-6 form-group form-group-sm">
                                                <label for="inSexoPaciente#index#">Sexo</label>
                                                <label class="badge label-<?php echo COLOR ?> error" id="inSexoPaciente#index#Error"></label>
                                                <select class="form-control" id="inSexoPaciente#index#" name="inPaciente[#index#][sexo]">
                                                    <option value="">SELECCIONAR</option>
                                                    <option value="HEMBRA">HEMBRA</option>
                                                    <option value="MACHO">MACHO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 form-group form-group-sm">
                                                <label for="inFechaNacimientoPaciente#index#">Fecha de Nacimiento</label>
                                                <label class="badge label-<?php echo COLOR ?> error" id="inFechaNacimientoPaciente#index#Error"></label>
                                                <div class="input-group">
                                                    <input class="form-control fecha" id="inFechaNacimientoPaciente#index#" name="inPaciente[#index#][fechanacimiento]" onclick="event.stopPropagation(); return false;" readonly type="text">
                                                    <span class="input-group-btn form-group-sm">
                                                        <button class="btn btn-default button-personalizado" type="button" onclick="abrirPickadate('inFechaNacimientoPaciente#index#')"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 form-group form-group-sm">
                                                <label for="inChipPaciente#index#">Chip</label>
                                                <input class="form-control" id="inChipPaciente#index#" name="inPaciente[#index#][chip]" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--<div class="col-lg-3 form-group form-group-sm">
                                                <label for="inFotoPaciente">Foto</label>
                                                <img class="img-responsive img-thumbnail center-block max-width-102px" id="inFotoPaciente" src="<?php echo base_url('assets/img/icon.png') ?>">
                                                <input id="inFotoPaciente#index#" name="inPaciente[#index#][foto]" type="hidden">
                                            </div>-->
                                            <div class="col-lg-12 form-group form-group-sm">
                                                <label for="inDescripcionPaciente#index#">Descripción</label>
                                                <label class="badge label-<?php echo COLOR ?> error" id="inDescripcionPaciente#index#Error"></label>
                                                <textarea class="form-control" id="inDescripcionPaciente#index#" name="inPaciente[#index#][descripcion]" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-<?php echo COLOR ?>" id="pacientes_noforms_template">
                                    <div class="panel-body padding-left-0 padding-right-0">
                                        <div class="col-lg-12">El propietario no tiene pacientes</div>
                                    </div>
                                </div>
                                <div class="col-lg-12 padding-left-0 padding-right-0 padding-bottom-15" id="pacientes_controls">
                                    <a class="btn btn-block btn-<?php echo COLOR ?>" id="pacientes_add">Agregar Paciente</a>
                                    <a class="btn btn-block btn-<?php echo COLOR ?> hidden" id="pacientes_remove_last">Quitar Paciente</a>
                                    <a class="btn btn-block btn-<?php echo COLOR ?>" id="pacientes_remove_all">Quitar Todos los Pacientes</a>
                                    <input class="hidden" id="pacientes_add_n_input" type="text">
                                    <a class="btn btn-block btn-<?php echo COLOR ?> hidden" id="pacientes_add_n_button">Agregar Pacientes</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Cliente/Crear') ?>', 'frmClienteCrear', 'El cliente ha sido creado.', 'Error en la creación del cliente, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>
<script>
    $(document).ready(function () {
        $('#numeros_contacto_propietario').sheepIt({
            separator: '',
            allowRemoveLast: false,
            allowRemoveCurrent: true,
            allowRemoveAll: false,
            allowAdd: true,
            allowAddN: false,
            removeAllConfirmation: false,
            maxFormsCount: 0,
            minFormsCount: 1,
            iniFormsCount: 1,
            continuousIndex: true
        });
        $('#pacientes').sheepIt({
            separator: '',
            allowRemoveLast: false,
            allowRemoveCurrent: true,
            allowRemoveAll: true,
            allowAdd: true,
            allowAddN: false,
            removeAllConfirmation: false,
            maxFormsCount: 0,
            minFormsCount: 1,
            iniFormsCount: 1,
            continuousIndex: true
        });
    });
</script>