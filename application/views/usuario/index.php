<div class="container-fluid">
    <div class="row">        
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong>Usuarios</strong>
                        <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Usuario/ObtenerModal') ?>', {operacion: 'crear'}, '#modal')">Crear</a>
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3 form-group form-group-sm">
                            <select class="form-control" id="inCampoFiltroUsuarios" name="inCampoFiltroUsuarios">
                                <option value="">SELECCIONAR</option>
                                <option value="1">ID USUARIO</option>
                                <option value="2">NOMBRE(S) USUARIO</option>
                                <option value="3">APELLIDO(S) USUARIO</option>
                            </select>
                        </div>
                        <div class="col-lg-3 form-group form-group-sm">
                            <input class="form-control" id="inValorFiltroUsuarios" name="inValorFiltroUsuarios">
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="filtrar('<?php echo base_url(uri_string()) ?>', '#paginaUsuarios', 'Usuarios')">Filtrar</a>
                        </div>
                        <div class="col-lg-1 form-group form-group-sm">
                            <a class="btn btn-block btn-<?php echo COLOR ?> button-personalizado" onclick="borrarFiltro('<?php echo base_url(uri_string()) ?>', '#paginaUsuarios', 'Usuarios')">Borrar</a>
                        </div>
                    </div>
                    <div id="paginaUsuarios">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).load(function () {
        procesarPagina('<?php echo base_url(uri_string()) ?>', 0, '#paginaUsuarios', 'Clientes');
    });
</script>