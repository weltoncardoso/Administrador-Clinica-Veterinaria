<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Modificar Usuario</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmUsuarioModificar" name="frmUsuarioModificar">
                    <input id="inIdUsuario" name="inIdUsuario" type="hidden" value="<?php echo $usuario[ID_USUARIO] ?>">
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inNombresUsuario">Nombre(s)</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inNombresUsuarioError"></label>
                            <input class="form-control" id="inNombresUsuario" name="inNombresUsuario" type="text" value="<?php echo $usuario[NOMBRES_USUARIO] ?>">                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inApellidosUsuario">Apellido(s)</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inApellidosUsuarioError"></label>
                            <input class="form-control" id="inApellidosUsuario" name="inApellidosUsuario" type="text" value="<?php echo $usuario[APELLIDOS_USUARIO] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inCorreoElectronicoUsuario">Correo Electrónico</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inCorreoElectronicoUsuarioError"></label>
                            <input class="form-control" id="inCorreoElectronicoUsuario" name="inCorreoElectronicoUsuario" type="text" value="<?php echo $usuario[CORREO_ELECTRONICO_USUARIO] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inCargoUsuario">Cargo</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inCargoUsuarioError"></label>
                            <input class="form-control" id="inCargoUsuario" name="inCargoUsuario" type="text" value="<?php echo $usuario[CARGO_USUARIO] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inNumeroContactoUsuario">Número de Contacto</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inNumeroContactoUsuarioError"></label>
                            <input class="form-control" id="inNumeroContactoUsuario" name="inNumeroContactoUsuario" type="text" value="<?php echo $usuario[NUMERO_CONTACTO_USUARIO] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inUsuarioUsuario">Usuario</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inUsuarioUsuarioError"></label>
                            <input class="form-control" id="inUsuarioUsuario" name="inUsuarioUsuario" type="text" value="<?php echo $usuario[USUARIO_USUARIO] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inContrasenaUsuario">Contraseña</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inContrasenaUsuarioError"></label>
                            <input class="form-control" id="inContrasenaUsuario" name="inContrasenaUsuario" type="password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('Usuario/Modificar') ?>', 'frmUsuarioModificar', 'El usuario ha sido modificado.', 'Error en la modificación del usuario, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>