<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Eliminar Paciente</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmPacienteEliminar" name="frmPacienteEliminar">
                    <input id="inIdPaciente" name="inIdPaciente" type="hidden" value="<?php echo $paciente[ID_PACIENTE] ?>">
                    ¿Esta seguro que desea eliminar el paciente <?php echo $paciente[NOMBRE_PACIENTE] ?>?
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Paciente/Eliminar') ?>', 'frmPacienteEliminar', 'El paciente ha sido eliminado.', 'Error en la eliminación del paciente, por favor comuníquese con el administrador del sistema.', '<?php echo base_url('Cliente') ?>', false, '#modal')">Si</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">No</button>
</div>