<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-<?php echo COLOR ?>">
                        <div class="panel-heading">
                            <h1 class="panel-title panel-title-personalizado">
                                <strong>Información Propietario</strong>
                                <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Propietario/ObtenerModal') ?>', {operacion: 'modificar', inIdPropietario:<?php echo $propietario[ID_PROPIETARIO] ?>}, '#modal')">Modificar</a>
                                <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Propietario/ObtenerModal') ?>', {operacion: 'eliminar', inIdPropietario:<?php echo $propietario[ID_PROPIETARIO] ?>}, '#modal')">Eliminar</a>                                
                            </h1>
                        </div>                                
                        <div class="panel-body">
                            <?php if (empty($propietario)) { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        Propietario no registrado.
                                    </div>                                       
                                </div>                                
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Nombre(s)</label>
                                        <?php echo $propietario[NOMBRES_PROPIETARIO]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Apellido(s)</label>
                                        <?php echo $propietario[APELLIDOS_PROPIETARIO]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Identificación</label>
                                        <?php echo $propietario[IDENTIFICACION_PROPIETARIO]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Dirección</label>
                                        <?php echo $propietario[DIRECCION_PROPIETARIO]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Correo Electrónico</label>
                                        <?php echo $propietario[CORREO_ELECTRONICO_PROPIETARIO]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Número(s) de Contacto</label>
                                        <?php
                                        if (empty($propietarioNumerosContactoConcatenado)) {
                                            echo 'Número(s) de contacto no registrado(s).';
                                        } else {
                                            echo $propietarioNumerosContactoConcatenado[NUMERO_CONTACTO_PROPIETARIO];
                                        }
                                        ?>
                                    </div>                                       
                                </div>
                            <?php } ?>
                        </div>                                
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-<?php echo COLOR ?>">
                        <div class="panel-heading">
                            <h1 class="panel-title panel-title-personalizado">
                                <strong>Información Paciente</strong>
                                <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Paciente/ObtenerModal') ?>', {operacion: 'modificar', inIdPaciente:<?php echo $paciente[ID_PACIENTE] ?>}, '#modal')">Modificar</a>
                                <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Paciente/ObtenerModal') ?>', {operacion: 'eliminar', inIdPaciente:<?php echo $paciente[ID_PACIENTE] ?>}, '#modal')">Eliminar</a>
                            </h1>
                        </div>
                        <div class="panel-body">
                            <?php if (empty($paciente)) { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        Paciente no registrado.
                                    </div>                                       
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Nombre</label>
                                        <?php echo $paciente[NOMBRE_PACIENTE]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Especie</label>
                                        <?php echo $paciente[ESPECIE_PACIENTE]; ?>
                                    </div>                                                
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Raza</label>
                                        <?php echo $paciente[RAZA_PACIENTE]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Sexo</label>
                                        <?php echo $paciente[SEXO_PACIENTE]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Fecha de Nacimiento</label>
                                        <?php echo $paciente[FECHA_NACIMIENTO_PACIENTE]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Chip</label>
                                        <?php echo empty($paciente[CHIP_PACIENTE]) ? 'No registrado' : $paciente[CHIP_PACIENTE]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Descripción</label>
                                        <?php echo $paciente[DESCRIPCION_PACIENTE]; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>