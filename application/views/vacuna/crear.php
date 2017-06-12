<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Crear Vacuna</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <form id="frmVacunaCrear" name="frmVacunaCrear">
                <input id="inIdPaciente" name="inIdPaciente" type="hidden" value="<?php echo $paciente[ID_PACIENTE] ?>">
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inTipoVacuna">Tipo</label>
                        <label class="badge label-<?php echo COLOR ?> error" id="inTipoVacunaError"></label>
                        <select class="form-control" id="inTipoVacuna" name="inTipoVacuna" type="text">
                            <option value="">SELECCIONAR</option>
                            <option value="DESPARACITACIÓN">DESPARACITACIÓN</option>
                            <option value="VACUNA">VACUNA</option>
                            <option value="PARVOVIROSIS">PARVOVIROSIS</option>
                            <option value="PARVOVIROSIS + CORONAVIRUS">PARVOVIROSIS + CORONAVIRUS</option>
                            <option value="TRIPLE CANINA">TRIPLE CANINA</option>
                            <option value="QUINTUPLE">QUINTUPLE</option>
                            <option value="QUINTUPLE + CORONAVIRUS">QUINTUPLE + CORONAVIRUS</option>
                            <option value="SEXTUPLE">SEXTUPLE</option>
                            <option value="RABIA">RABIA</option>
                            <option value="TRIPLE FELINA">TRIPLE FELINA</option>
                            <option value="TRIPLE FELINA + RABIA">TRIPLE FELINA + RABIA</option>
                            <option value="TRIPLE FELINA + LEUCEMIA">TRIPLE FELINA + LEUCEMIA</option>
                            <option value="LEUCEMIA">LEUCEMIA</option>
                            <option value="TOS DE LAS PERRERAS (K/C)">TOS DE LAS PERRERAS (K/C)</option>
                            <option value="SEXTUPLE + RABIA">SEXTUPLE + RABIA</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inMedicamentoVacuna">Medicamento</label>
                        <label class="badge label-<?php echo COLOR ?> error" id="inMedicamentoVacunaError"></label>
                        <textarea class="form-control" id="inMedicamentoVacuna" name="inMedicamentoVacuna" rows="10"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group form-group-sm">
                        <label for="inFechaVacuna">Fecha vacuna</label>
                        <label class="badge label-<?php echo COLOR ?> error" id="inFechaVacunaError"></label>
                        <div class="input-group">
                            <input class="form-control fecha" id="inFechaVacuna" name="inFechaVacuna" onclick="event.stopPropagation(); return false;" readonly type="text" value="<?php echo date('Y-m-d') ?>" onchange="calcularFechaProximaVacuna('<?php echo base_url('Vacuna/CalcularProximaFechaVacuna') ?>', 'frmVacunaCrear')">
                            <span class="input-group-btn form-group-sm">
                                <button class="btn btn-default button-personalizado" type="button" onclick="abrirPickadate('inFechaVacuna')"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group form-group-sm">
                        <label for="inFechaProximaVacuna">Fecha proxima vacuna</label>
                        <label class="badge label-<?php echo COLOR ?> error" id="inFechaProximaVacunaError"></label>
                        <div class="input-group">
                            <input class="form-control fecha" id="inFechaProximaVacuna" name="inFechaProximaVacuna" onclick="event.stopPropagation(); return false;" readonly type="text" value="">
                            <span class="input-group-btn form-group-sm">
                                <button class="btn btn-default button-personalizado" type="button" onclick="abrirPickadate('inFechaProximaVacuna')"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 form-group form-group-sm">
                        <label for="tiempo">Tiempo</label>
                        <label class="badge label-<?php echo COLOR ?> error" id="tiempoError"></label>
                        <select class="form-control" id="tiempo" name="tiempo" type="text" onchange="calcularFechaProximaVacuna('<?php echo base_url('Vacuna/CalcularProximaFechaVacuna') ?>', 'frmVacunaCrear')">
                            <option value="">SELECCIONAR</option>
                            <option value="day">DÍAS</option>
                            <option value="week">SEMANAS</option>
                            <option value="month">MESES</option>
                            <option value="year">AÑOS</option>
                        </select>
                    </div>
                    <div class="col-lg-6 form-group form-group-sm">
                        <label for="cantidad">Cantidad</label>
                        <label class="badge label-<?php echo COLOR ?> error" id="cantidadError"></label>
                        <select class="form-control" id="cantidad" name="cantidad" type="text" onchange="calcularFechaProximaVacuna('<?php echo base_url('Vacuna/CalcularProximaFechaVacuna') ?>', 'frmVacunaCrear')">
                            <option value="">SELECCIONAR</option>
                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                <option value="+<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Vacuna/Crear') ?>', 'frmVacunaCrear', 'La vacuna ha sido creada.', 'Error en la creación de la vacuna, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>