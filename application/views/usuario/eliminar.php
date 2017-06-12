<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Eliminar Usuario</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmUsuarioEliminar" name="frmUsuarioEliminar">
                    <input id="inIdUsuario" name="inIdUsuario" type="hidden" value="<?php echo $usuario[ID_USUARIO] ?>">
                    ¿Esta seguro que desea eliminar el usuario <?php echo $usuario[NOMBRES_USUARIO] . ' ' . $usuario[APELLIDOS_USUARIO] ?>?
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Usuario/Eliminar') ?>', 'frmUsuarioEliminar', 'El usuario ha sido eliminado.', 'Error en la eliminación del usuario, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Si</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">No</button>
</div>