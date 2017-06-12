<div class="container-fluid">
    <div class="row">        
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong>Planes Medicina Prepagada</strong>
                        <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('PlanMedicinaPrepagada/ObtenerModal') ?>', {operacion: 'crear'}, '#modal')">Crear</a>
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3 form-group form-group-sm">
                            <select class="form-control" id="inCampoFiltroPlanesMedicinaPrepagada" name="inCampoFiltroPlanesMedicinaPrepagada">
                                <option value="">SELECCIONAR</option>
                                <option value="1">ID PLAN MEDICINA PREPAGADA</option>
                                <option value="2">NOMBRE PLAN MEDICINA PREPAGADA</option>
                            </select>
                        </div>
                        <div class="col-lg-3 form-group form-group-sm">
                            <input class="form-control" id="inValorFiltroPlanesMedicinaPrepagada" name="inValorFiltroPlanesMedicinaPrepagada">
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="filtrar('<?php echo base_url('PlanMedicinaPrepagada') ?>', '#paginaPlanesMedicinaPrepagada', 'PlanesMedicinaPrepagada')">Filtrar</a>
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="borrarFiltro('<?php echo base_url('PlanMedicinaPrepagada') ?>', '#paginaPlanesMedicinaPrepagada', 'PlanesMedicinaPrepagada')">Borrar</a>
                        </div>
                    </div>
                    <div id="paginaPlanesMedicinaPrepagada">
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).load(function () {
        procesarPagina('<?php echo base_url('PlanMedicinaPrepagada') ?>', 0, '#paginaPlanesMedicinaPrepagada', 'Propietarios');
    });
</script>