<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong data-toggle="collapse" data-target="#panelHistoriaClinica">Información Historia Clínica</strong>
                        <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('HistoriaClinica/ObtenerModal') ?>', {operacion: 'modificar', inIdHistoriaClinica: '<?php echo $historiaClinica[ID_HISTORIA_CLINICA] ?>'}, '#modal')">Modificar</a>
                        <span class="glyphicon glyphicon-chevron-down float-right" data-toggle="collapse" data-target="#panelHistoriaClinica"></span>
                    </h1>
                </div>
                <div class=" panel-body" id="panelHistoriaClinica">
                    <?php if (empty($historiaClinica)) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                Historia Clínica no registrada.
                            </div>                                       
                        </div>                            
                    <?php } else { ?>
                        <input type="hidden" id="inIdHistoriaClinica" name="inIdHistoriaClinica" value="<?php echo $historiaClinica[ID_HISTORIA_CLINICA]; ?>">
                        <div class="row">
                            <div class="col-xs-6">
                                <label>Fecha de Registro</label>
                                <?php echo $historiaClinica[FECHA_HISTORIA_CLINICA] ?>
                            </div>
                            <div class="col-xs-6 text-right">
                                <label>Id</label>
                                <?php echo $historiaClinica[ID_HISTORIA_CLINICA]; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>