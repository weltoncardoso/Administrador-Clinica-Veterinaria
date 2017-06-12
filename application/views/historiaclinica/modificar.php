<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Modificar Historia Clinica</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form id="frmHistoriaClinicaModificar" name="frmHistoriaClinicaModificar">
                    <input id="inIdHistoriaClinica" name="inIdHistoriaClinica" type="hidden" value="<?php echo $historiaClinica[ID_HISTORIA_CLINICA] ?>">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 form-group form-group-sm">
                                <label for="inFechaHistoriaClinica">Fecha</label>
                                <label class="badge label-<?php echo COLOR ?> error" id="inFechaHistoriaClinicaError"></label>
                                <div class="input-group">
                                    <input class="form-control fecha" id="inFechaHistoriaClinica" name="inFechaHistoriaClinica" onclick="event.stopPropagation(); return false;" readonly type="text" value="<?php echo $historiaClinica[FECHA_HISTORIA_CLINICA] ?>">
                                    <span class="input-group-btn form-group-sm">
                                        <button class="btn btn-default button-personalizado" type="button" onclick="abrirPickadate('inFechaHistoriaClinica')"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
                                    </span>
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
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('HistoriaClinica/Modificar') ?>', 'frmHistoriaClinicaModificar', 'La historia clinica ha sido modificada.', 'Error en la modificación de la historia clinica, por favor comuníquese con el administrador del sistema.', null, false, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>