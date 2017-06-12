<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Eliminar Consulta</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmConsultaEliminar" name="frmConsultaEliminar">
                    <input id="inIdConsulta" name="inIdConsulta" type="hidden" value="<?php echo $consulta[ID_CONSULTA] ?>">
                    ¿Esta seguro que desea eliminar la consulta?
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Consulta/Eliminar') ?>', 'frmConsultaEliminar', 'La consulta ha sido eliminado.', 'Error en la eliminación de la consulta, por favor comuníquese con el administrador del sistema.', null, false, '#modal')">Si</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">No</button>
</div>