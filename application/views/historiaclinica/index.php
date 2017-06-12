<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong data-toggle="collapse" data-target="#panelConsultas">Información Consultas</strong>
                        <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Consulta/ObtenerModal') ?>', {operacion: 'crear', inIdHistoriaClinica: '<?php echo $historiaClinica[ID_HISTORIA_CLINICA] ?>'}, '#modal')">Crear</a>
                        <span class="glyphicon glyphicon-chevron-down float-right" data-toggle="collapse" data-target="#panelConsultas"></span>
                    </h1>
                </div>
                <div class=" panel-body" id="panelConsultas">
                    <div class="row">
                        <div class="col-lg-3 form-group form-group-sm">
                            <select class="form-control" id="inCampoFiltroHistoriasClinicas" name="inCampoFiltroHistoriasClinicas">
                                <option value="">SELECCIONAR</option>
                                <option value="1">FECHA REGISTRO CONSULTA</option>
                            </select>
                        </div>
                        <div class="col-lg-3 form-group form-group-sm">
                            <input class="form-control" id="inValorFiltroHistoriasClinicas" name="inValorFiltroHistoriasClinicas">
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" <?php if (!empty($historiaClinica)) { ?> onclick="filtrar('<?php echo base_url(uri_string()) ?>', '#paginaHistoriasClinicas', 'HistoriasClinicas')" <?php } ?>>Filtrar</a>
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" <?php if (!empty($historiaClinica)) { ?> onclick="borrarFiltro('<?php echo base_url(uri_string()) ?>', '#paginaHistoriasClinicas', 'HistoriasClinicas')" <?php } ?>>Borrar</a>
                        </div>
                    </div>
                    <div id="paginaHistoriasClinicas">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).load(function () {
        procesarPagina('<?php echo base_url(uri_string()) ?>', 0, '#paginaHistoriasClinicas', 'HistoriasClinicas');
    });
</script>