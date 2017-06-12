<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Modificar Plan Medicina Prepagada</span>
</div>
<div class="modal-body">
    <div class="container-fluid">    
        <div class="row">
            <div class="col-lg-12">
                <form id="frmPlanMedicinaPrepagadaModificar" name="frmPlanMedicinaPrepagadaModificar">
                    <input id="inIdPlanMedicinaPrepagada" name="inIdPlanMedicinaPrepagada" type="hidden" value="<?php echo $planMedicinaPrepagada[ID_PLAN_MEDICINA_PREPAGADA] ?>">
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inNombrePlanMedicinaPrepagada">Nombre</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inNombrePlanMedicinaPrepagadaError"></label>
                            <input class="form-control" id="inNombrePlanMedicinaPrepagada" name="inNombrePlanMedicinaPrepagada" type="text" value="<?php echo $planMedicinaPrepagada[NOMBRE_PLAN_MEDICINA_PREPAGADA] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inDescripcionPlanMedicinaPrepagada">Descripción</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inDescripcionPlanMedicinaPrepagadaError"></label>
                            <textarea class="form-control" id="inDescripcionPlanMedicinaPrepagada" name="inDescripcionPlanMedicinaPrepagada" rows="5"><?php echo $planMedicinaPrepagada[DESCRIPCION_PLAN_MEDICINA_PREPAGADA] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inDuracionPlanMedicinaPrepagada">Duración</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inDuracionPlanMedicinaPrepagadaError"></label>
                            <select class="form-control" id="inDuracionPlanMedicinaPrepagada" name="inDuracionPlanMedicinaPrepagada" type="text">
                                <option value="">SELECCIONAR</option>
                                <?php for ($i = 1; $i <= LIMITE_SELECT; $i++) { ?>
                                    <option value="<?php echo $i ?>" <?php echo $planMedicinaPrepagada[DURACION_PLAN_MEDICINA_PREPAGADA] == $i ? 'selected' : '' ?>><?php echo $i . ' MESES' ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div id="beneficios">
                        <div class="panel panel-<?php echo COLOR ?>" id="beneficios_template">
                            <div class="panel-heading">
                                <h1 class="panel-title panel-title-personalizado">
                                    <strong>Beneficio</strong>
                                    <button class="close" id="beneficios_remove_current" type="button">&times;</button>                                        
                                </h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 form-group form-group-sm">
                                        <label for="inNombreBeneficio#index#Error">Nombre</label>
                                        <label class="badge label-<?php echo COLOR ?> error" id="inNombreBeneficio#index#Error"></label>
                                        <input class="form-control" id="inNombreBeneficio#index#" name="inBeneficio[#index#][nombre]" type="text">
                                    </div>
                                    <div class="col-lg-6 form-group form-group-sm">
                                        <label for="inCantidadBeneficio#index#Error">Cantidad</label>
                                        <label class="badge label-<?php echo COLOR ?> error" id="inCantidadBeneficio#index#Error"></label>
                                        <select class="form-control" id="inCantidadBeneficio#index#" name="inBeneficio[#index#][cantidad]" type="text">
                                            <option value="">SELECCIONAR</option>
                                            <option value="-1">SIN LÍMITE</option>
                                            <?php for ($i = 1; $i <= LIMITE_SELECT; $i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-<?php echo COLOR ?>" id="beneficios_noforms_template">
                            <div class="panel-body padding-left-0 padding-right-0">
                                <div class="col-lg-12">El plan de medicina prepagada no tiene beneficios</div>
                            </div>
                        </div>
                        <div class="col-lg-12 padding-left-0 padding-right-0 padding-bottom-15" id="beneficios_controls">
                            <a class="btn btn-block btn-<?php echo COLOR ?>" id="beneficios_add">Agregar Beneficio</a>
                            <a class="btn btn-block btn-<?php echo COLOR ?> hidden" id="beneficios_remove_last">Quitar Beneficio</a>
                            <a class="btn btn-block btn-<?php echo COLOR ?>" id="beneficios_remove_all">Quitar Todos los Beneficios</a>
                            <input class="hidden" id="beneficios_add_n_input" type="text">
                            <a class="btn btn-block btn-<?php echo COLOR ?> hidden" id="beneficios_add_n_button">Agregar Beneficios</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">    
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('PlanMedicinaPrepagada/Modificar') ?>', 'frmPlanMedicinaPrepagadaModificar', 'El plan medicina prepagada ha sido modificado.', 'Error en la modificación del plan medicina prepagada, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>
<script>
    $(document).ready(function () {
        $('#beneficios').sheepIt({
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
            continuousIndex: true,
            data: [
<?php
if (!empty($planMedicinaPrepagadaBeneficios)) {
    foreach ($planMedicinaPrepagadaBeneficios as $beneficio) {
        echo '{\'inNombreBeneficio#index#\':\'' . $beneficio[NOMBRE_BENEFICIO] . '\', \'inCantidadBeneficio#index#\':\'' . $beneficio[CANTIDAD_BENEFICIO] . '\'},';
    }
}
?>
            ]
        });
    });
</script>