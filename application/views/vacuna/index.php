<div class="container-fluid">
    <div class="row">        
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong data-toggle="collapse" data-target="#panelVacunas">Información Vacunas</strong>
                        <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Vacuna/ObtenerModal') ?>', {operacion: 'crear', inIdPaciente: '<?php echo $paciente[ID_PACIENTE] ?>'}, '#modal')">Crear</a>
                        <span class="glyphicon glyphicon-chevron-down float-right" data-toggle="collapse" data-target="#panelVacunas"></span>
                    </h1>
                </div>
                <div class=" panel-body coll" id="panelVacunas">
                    <div class="row">
                        <div class="col-lg-3 form-group form-group-sm">
                            <select class="form-control" id="inCampoFiltroVacunas" name="inCampoFiltroVacunas">
                                <option value="">SELECCIONAR</option>
                                <option value="1">FECHA VACUNA</option>
                            </select>
                        </div>
                        <div class="col-lg-3 form-group form-group-sm">
                            <input class="form-control" id="inValorFiltroVacunas" name="inValorFiltroVacunas">
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="filtrar('<?php echo base_url('Vacuna/' . $paciente[ID_PACIENTE]) ?>', 0, 'Vacunas', '#paginaVacunas')">Filtrar</a>
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="borrarFiltro('<?php echo base_url('Vacuna/' . $paciente[ID_PACIENTE]) ?>', 0, 'Vacunas', '#paginaVacunas')">Borrar</a>
                        </div>
                    </div>
                    <div id="paginaVacunas">
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).load(function () {
        procesarPagina('<?php echo base_url('Vacuna/' . $paciente[ID_PACIENTE]) ?>', 0, '#paginaVacunas', 'Vacunas');
    });
</script>