<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Adjunto</span>
</div>
<div class="modal-body">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe frameborder="0" src="<?php echo base_url('uploads/consultas/responsive_filemanager/filemanager/dialog.php?type=0&fldr=consulta' . $consulta[ID_CONSULTA]) ?>"></iframe>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>