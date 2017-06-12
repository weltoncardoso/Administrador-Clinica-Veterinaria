<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong data-toggle="collapse" data-target="#panelAfiliaciones">Información Afiliaciones</strong>
                        <a class="btn btn-default btn-xs" onclick="crearModal('<?php echo base_url('Afiliacion/ObtenerModal') ?>', {operacion: 'crear', inIdHistoriaClinica: '<?php echo $historiaClinica[ID_HISTORIA_CLINICA] ?>'}, '#modal')">Crear</a>
                        <span class="glyphicon glyphicon-chevron-down float-right" data-toggle="collapse" data-target="#panelAfiliaciones"></span>
                    </h1>
                </div>
                <div class="collapse panel-body" <?php if (!empty($paciente)) { ?> style="padding-bottom: 0" <?php } ?> id="panelAfiliaciones">
                    <?php if (empty($paciente)) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                Paciente no registrado.
                            </div>                                       
                        </div>                            
                    <?php } else { ?>                        
                        <?php if (empty($afiliacionesBeneficios)) { ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    Afiliación no registrada.
                                </div>                                       
                            </div>
                            <?php
                        } else {
                            $separador = false;
                            foreach ($afiliaciones as $afiliacion) {
                                if ($separador) {
                                    ?>
                                    <hr class="divider margin-top-0"/>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-xs-6 col-lg-4">
                                        <a class="btn btn-<?php echo COLOR ?> btn-xs" onclick="crearModal('<?php echo base_url('Afiliacion/ObtenerModal') ?>', {operacion: 'eliminar', inIdAfiliacion: '<?php echo $afiliacion[ID_AFILIACION] ?>', inIdHistoriaClinica: '<?php echo $historiaClinica[ID_HISTORIA_CLINICA] ?>', inIdPlanMedicinaPrepagada: '<?php echo $afiliacion[ID_PLAN_MEDICINA_PREPAGADA] ?>', inIdPaciente: '<?php echo $paciente[ID_PACIENTE] ?>'}, '#modal')">Eliminar</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-lg-4">
                                        <label>Duración</label>
                                        <?php echo ' desde ' . $afiliacion[FECHA_INICIO_AFILIACION] . ' hasta ' . $afiliacion[FECHA_FIN_AFILIACION] ?>
                                    </div>
                                    <div class="col-xs-6 col-lg-4">
                                        <label>Id afiliación</label>
                                        <?php echo $afiliacion[ID_AFILIACION]; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    foreach ($afiliacionesBeneficios as $afiliacionBeneficio) {
                                        if ($afiliacion[ID_AFILIACION] == $afiliacionBeneficio[ID_AFILIACION]) {
                                            ?>
                                            <div class="col-lg-6 text-center form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><?php echo $afiliacionBeneficio[NOMBRE_BENEFICIO] ?></span>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Cantidad</span>
                                                    <span class="input-group-addon" id="cantidadMaxima<?php echo $afiliacionBeneficio[ID_AFILIACION_BENEFICIO] ?>"><?php echo $afiliacionBeneficio[CANTIDAD_BENEFICIO] ?></span>
                                                    <span class="input-group-addon">de</span>                                    
                                                    <span class="input-group-btn">
                                                        <a class="btn btn-group-justified btn-<?php echo COLOR ?>" onclick="$('#inIdAfiliacionBeneficio').val('<?php echo $afiliacionBeneficio[ID_AFILIACION_BENEFICIO] ?>'); procesarFormularioCambioCantidad('<?php echo base_url('Afiliacion/Aumentar') ?>', 'frmCambiarCantidadAfiliacionBeneficio', '+', <?php echo $afiliacionBeneficio[ID_AFILIACION_BENEFICIO] ?>, '<?php echo $afiliacionBeneficio[NOMBRE_BENEFICIO] ?>')">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                        </a>
                                                    </span>
                                                    <span class="input-group-addon" id="cantidadUsada<?php echo $afiliacionBeneficio[ID_AFILIACION_BENEFICIO] ?>"><?php echo $afiliacionBeneficio[USADO_BENEFICIO] ?></span>
                                                    <span class="input-group-btn">
                                                        <a class="btn btn-group-justified btn-<?php echo COLOR ?>" onclick="$('#inIdAfiliacionBeneficio').val('<?php echo $afiliacionBeneficio[ID_AFILIACION_BENEFICIO] ?>'); procesarFormularioCambioCantidad('<?php echo base_url('Afiliacion/Disminuir') ?>', 'frmCambiarCantidadAfiliacionBeneficio', '-', <?php echo $afiliacionBeneficio[ID_AFILIACION_BENEFICIO] ?>, '<?php echo $afiliacionBeneficio[NOMBRE_BENEFICIO] ?>')">
                                                            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                                $separador = true;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<form name="frmCambiarCantidadAfiliacionBeneficion" id="frmCambiarCantidadAfiliacionBeneficio">
    <input type="hidden" name="inIdAfiliacionBeneficio" id="inIdAfiliacionBeneficio">
</form>