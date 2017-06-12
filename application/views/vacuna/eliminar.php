<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Eliminar Vacuna</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <form id="frmVacunaEliminar" name="frmVacunaEliminar">
                <input id="inIdVacuna" name="inIdVacuna" type="hidden" value="<?php $vacuna[ID_VACUNA] ?>">
                ¿Esta seguro que desea eliminar la vacuna?
            </form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Vacuna/Eliminar') ?>', 'frmVacunaEliminar', 'La vacuna ha sido eliminada.', 'Error en la eliminación de la vacuna, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Si</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">No</button>
</div>