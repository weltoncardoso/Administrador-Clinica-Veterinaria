<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Eliminar Afiliación</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmAfiliacionEliminar" name="frmAfiliacionEliminar">
                    <input id="inIdAfiliacion" name="inIdAfiliacion" type="hidden" value="<?php echo $afiliacion[ID_AFILIACION] ?>">
                    ¿Esta seguro que desea eliminar la afiliación <?php echo $planMedicinaPrepagada[NOMBRE_PLAN_MEDICINA_PREPAGADA] ?> de <?php echo $paciente[NOMBRE_PACIENTE] ?> con codigo <?php echo $afiliacion[ID_AFILIACION] ?>?
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Afiliacion/Eliminar') ?>', 'frmAfiliacionEliminar', 'La afiliación ha sido eliminada.', 'Error en la eliminación de la afiliación, por favor comuníquese con el administrador del sistema.', '<?php echo base_url('HistoriaClinica/' . $historiaClinica[ID_HISTORIA_CLINICA]) ?>', false, '#modal')">Si</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">No</button>
</div>