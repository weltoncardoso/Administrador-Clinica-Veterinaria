<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Crear Consulta</span>
</div>
<div class="modal-body">
    <div class="container-fluid">    
        <div class="row">
            <div class="col-lg-12">
                <form id="frmConsultaCrear" name="frmConsultaCrear">
                    <input id="inIdHistoriaClinica" name="inIdHistoriaClinica" type="hidden" value="<?php echo $historiaClinica[ID_HISTORIA_CLINICA]; ?>">
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inFechaConsulta">Fecha</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inFechaConsultaError"></label>
                            <div class="input-group">
                                <input class="form-control fecha" id="inFechaConsulta" name="inFechaConsulta" onclick="event.stopPropagation(); return false;" readonly type="text" value="<?php echo date('Y-m-d') ?>">
                                <span class="input-group-btn form-group-sm">
                                    <button class="btn btn-default button-personalizado" type="button" onclick="abrirPickadate('inFechaConsulta')"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inAnamnesisConsulta">Anamnesis</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inAnamnesisConsultaError"></label>
                            <textarea class="form-control" id="inAnamnesisConsulta" name="inAnamnesisConsulta" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inUsuarioConsulta">Usuario</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inUsuarioConsultaError"></label>
                            <select class="form-control" id="inUsuarioConsulta" name="inUsuarioConsulta" type="text">
                                <option value="">SELECCIONAR</option>
                                <?php
                                if (!empty($usuarios)) {
                                    foreach ($usuarios as $usuario) {
                                        ?>
                                        <option value="<?php echo $usuario[ID_USUARIO]; ?>"><?php echo $usuario[NOMBRES_USUARIO] . ' ' . $usuario[APELLIDOS_USUARIO]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inPConsulta">Peso</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inPConsultaError"></label>
                            <input class="form-control" id="inPConsulta" name="inPConsulta" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inTConsulta">Temperatura</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inTConsultaError"></label>
                            <input class="form-control" id="inTConsulta" name="inTConsulta" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inFCConsulta">Frec. Cardiaca</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inFCConsultaError"></label>
                            <input class="form-control" id="inFCConsulta" name="inFCConsulta" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inFRConsulta">Frec. Respiratoria</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inFRConsultaError"></label>
                            <input class="form-control" id="inFRConsulta" name="inFRConsulta" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inExamenClinicoConsulta">Exámen Clinico</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inExamenClinicoConsultaError"></label>
                            <textarea class="form-control" id="inExamenClinicoConsulta" name="inExamenClinicoConsulta" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inRecetaMedicaConsulta">Receta Médica</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inRecetaMedicaConsultaError"></label>
                            <textarea class="form-control" id="inRecetaMedicaConsulta" name="inRecetaMedicaConsulta" rows="5"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Consulta/Crear') ?>', 'frmConsultaCrear', 'La consulta ha sido creado.', 'Error en la creación de la consulta, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>