<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Agregar Plan Medicina Prepagada</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmAfiliacionCrear" name="frmAfiliacionCrear">
                    <input id="inIdPaciente" name="inIdPaciente" type="hidden" value="<?php echo $paciente[ID_PACIENTE] ?>">
                    Por favor seleccione el plan medicina prepagada que desea agregarle al paciente <?php echo $paciente[NOMBRE_PACIENTE] ?>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inIdPlanMedicinaPrepagada">Plan medicina prepagada</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inIdPlanMedicinaPrepagadaError"></label>
                            <select class="form-control" id="inIdPlanMedicinaPrepagada" name="inIdPlanMedicinaPrepagada" type="text">
                                <option value="">SELECCIONAR</option>
                                <?php
                                if (!empty($planesMedicinaPrepagada)) {
                                    foreach ($planesMedicinaPrepagada as $planMedicinaPrepagada) {
                                        ?>
                                        <option value="<?php echo $planMedicinaPrepagada[ID_PLAN_MEDICINA_PREPAGADA]; ?>"><?php echo $planMedicinaPrepagada[NOMBRE_PLAN_MEDICINA_PREPAGADA]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Afiliacion/Crear') ?>', 'frmAfiliacionCrear', 'El plan medicina prepagada ha sido agregado.', 'Error en la aregacion del plan medicina prepagada, por favor comuníquese con el administrador del sistema.', '<?php echo base_url('HistoriaClinica/' . $historiaClinica[ID_HISTORIA_CLINICA]) ?>', false, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cancelar</button>
</div>