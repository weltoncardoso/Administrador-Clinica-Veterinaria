<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Crear Usuario</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">        
            <div class="col-lg-12">
                <form id="frmUsuarioCrear" name="frmUsuarioCrear">
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inNombresUsuario">Nombre(s)</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inNombresUsuarioError"></label>
                            <input class="form-control" id="inNombresUsuario" name="inNombresUsuario" type="text">                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inApellidosUsuario">Apellido(s)</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inApellidosUsuarioError"></label>
                            <input class="form-control" id="inApellidosUsuario" name="inApellidosUsuario" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inCorreoElectronicoUsuario">Correo Electrónico</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inCorreoElectronicoUsuarioError"></label>
                            <input class="form-control" id="inCorreoElectronicoUsuario" name="inCorreoElectronicoUsuario" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inCargoUsuario">Cargo</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inCargoUsuarioError"></label>
                            <input class="form-control" id="inCargoUsuario" name="inCargoUsuario" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inNumeroContactoUsuario">Número de Contacto</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inNumeroContactoUsuarioError"></label>
                            <input class="form-control" id="inNumeroContactoUsuario" name="inNumeroContactoUsuario" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inUsuarioUsuario">Usuario</label>
                            <label class="badge label-<?php echo COLOR ?> error" id="inUsuarioUsuarioError"></label>
                            <input class="form-control" id="inUsuarioUsuario" name="inUsuarioUsuario" type="text">
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
    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="procesarFormularioModal('<?php echo base_url('usuario/Crear') ?>', 'frmUsuarioCrear', 'El usuario ha sido creado.', 'Error en la creación del usuario, por favor comuníquese con el administrador del sistema.', null, true, '#modal')">Guardar</button>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>