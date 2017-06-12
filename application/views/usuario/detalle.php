<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Detalle Usuario</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inNombresUsuario">Nombre(s)</label>
                        <input class="form-control" disabled id="inNombresUsuario" name="inNombresUsuario" type="text" value="<?php echo $usuario[NOMBRES_USUARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inApellidosUsuario">Apellido(s)</label>
                        <input class="form-control" disabled id="inApellidosUsuario" name="inApellidosUsuario" type="text" value="<?php echo $usuario[APELLIDOS_USUARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inCorreoElectronicoUsuario">Correo Electrónico</label>
                        <input class="form-control" disabled id="inCorreoElectronicoUsuario" name="inCorreoElectronicoUsuario" type="text" value="<?php echo $usuario[CORREO_ELECTRONICO_USUARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inCargoUsuario">Cargo</label>
                        <input class="form-control" disabled id="inCargoUsuario" name="inCargoUsuario" type="text" value="<?php echo $usuario[CARGO_USUARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inNumeroContactoUsuario">Número de Contacto</label>
                        <input class="form-control" disabled id="inNumeroContactoUsuario" name="inNumeroContactoUsuario" type="text" value="<?php echo $usuario[NUMERO_CONTACTO_USUARIO] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group form-group-sm">
                        <label for="inUsuarioUsuario">Usuario</label>
                        <input class="form-control" disabled="" id="inUsuarioUsuario" name="inUsuarioUsuario" type="text" value="<?php echo $usuario[USUARIO_USUARIO] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>