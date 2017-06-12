<div class="container-fluid">
    <div class="row">        
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong>Propietarios</strong>
                        <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Propietario/ObtenerModal') ?>', {operacion: 'crear'}, '#modal')">Crear</a>
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3 form-group form-group-sm">
                            <select class="form-control" id="inCampoFiltroPropietarios" name="inCampoFiltroPropietarios">
                                <option value="">SELECCIONAR</option>
                                <option value="1">ID PROPIETARIO</option>
                                <option value="2">NOMBRE(S) PROPIETARIO</option>
                                <option value="3">APELLIDO(S) PROPIETARIO</option>
                                <option value="4">IDENTIFICACIÓN PROPIETARIO</option>
                            </select>
                        </div>
                        <div class="col-lg-3 form-group form-group-sm">
                            <input class="form-control" id="inValorFiltroPropietarios" name="inValorFiltroPropietarios">
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="filtrar('<?php echo base_url('Propietario') ?>', '#paginaPropietarios', 'Propietarios')">Filtrar</a>
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="borrarFiltro('<?php echo base_url('Propietario') ?>', '#paginaPropietarios', 'Propietarios')">Borrar</a>
                        </div>
                    </div>
                    <div id="paginaPropietarios">
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).load(function () {
        procesarPagina('<?php echo base_url('Propietario') ?>', 0, '#paginaPropietarios', 'Propietarios');
    });
</script>