<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Eliminar Propietario</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmPropietarioEliminar" name="frmPropietarioEliminar">
                    <input id="inIdPropietario" name="inIdPropietario" type="hidden" value="<?php echo $propietario[ID_PROPIETARIO] ?>">
                    ¿Esta seguro que desea eliminar el propietario <?php echo $propietario[NOMBRES_PROPIETARIO] . ' ' . $propietario[APELLIDOS_PROPIETARIO] ?>?
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Propietario/Eliminar') ?>', 'frmPropietarioEliminar', 'El propietario ha sido eliminado.', 'Error en la eliminación del propietario, por favor comuníquese con el administrador del sistema.', '<?php echo base_url('Cliente') ?>', false, '#modal')">Si</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">No</button>
</div>