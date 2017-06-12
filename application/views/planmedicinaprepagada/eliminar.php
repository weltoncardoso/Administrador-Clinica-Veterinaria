<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Eliminar Plan Medicina Prepagada</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmPlanMedicinaPrepagadaEliminar" name="frmPlanMedicinaPrepagadaEliminar">
                    <input id="inIdPlanMedicinaPrepagada" name="inIdPlanMedicinaPrepagada" type="hidden" value="<?php echo $planMedicinaPrepagada[ID_PLAN_MEDICINA_PREPAGADA] ?>">
                    ¿Esta seguro que desea eliminar el plan medicina prepagada <?php echo $planMedicinaPrepagada[NOMBRE_PLAN_MEDICINA_PREPAGADA] ?>?
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('PlanMedicinaPrepagada/Eliminar') ?>', 'frmPlanMedicinaPrepagadaEliminar', 'El plan medicina prepagada ha sido eliminado.', 'Error en la eliminación del plan medicina prepagada, por favor comuníquese con el administrador del sistema.', '<?php echo base_url('PlanMedicinaPrepagada') ?>', false, '#modal')">Si</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">No</button>
</div>