<div class="container-fluid">
    <div class="row vertical-center">        
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <img src="<?php echo base_url('assets/img/icon.png') ?>" class="img-circle img-responsive center-block max-width-100px">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong>Ingresar</strong>
                    </h1>
                </div>
                <div class="panel-body">
                    <form id="frmUsuarioIngresar" name="frmUsuarioIngresar">
                        <div class="form-group form-group-sm">
                            <label for="inUsuarioUsuario">Usuario</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inUsuarioUsuarioError"></label>
                            <input class="form-control" id="inUsuarioUsuario" name="inUsuarioUsuario" type="text">
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="inContrasenaUsuario">Contraseña</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inContrasenaUsuarioError"></label>
                            <input class="form-control" id="inContrasenaUsuario" name="inContrasenaUsuario" type="password">
                        </div>
                    </form>
                    <a class="btn btn-block btn-<?php echo COLOR ?>" onclick="procesarUsuarioIngresar()">Aceptar</a>
                </div>
            </div>            
        </div>
    </div>
</div>
<script>
    function procesarUsuarioIngresar() {
        procesarFormulario('<?php echo base_url('usuario/Ingresar') ?>', 'frmUsuarioIngresar', null, 'El usuario y/o contraseña son incorrectos, por favor inténtelo de nuevo.', '<?php echo base_url('Cliente') ?>', true);
    }
</script>