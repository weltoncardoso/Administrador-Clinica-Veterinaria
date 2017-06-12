<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-<?php echo COLOR ?>">
                <div class="panel-heading">
                    <h1 class="panel-title panel-title-personalizado">
                        <strong>Reportes</strong>
                    </h1>
                </div>
                <div class="panel-body" <?php if (!empty($historiaClinica)) { ?> style="padding-bottom: 0" <?php } ?>>
                    <?php if (empty($historiaClinica)) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                Historia Clínica no registrada.
                            </div>                                       
                        </div>                            
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3 text-center form-group form-group-sm">
                                <a class="btn btn-block btn-<?php echo COLOR ?>" onclick="mostrarAutorizacion()">Autorización</a>
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center form-group form-group-sm">
                                <a class="btn btn-block btn-<?php echo COLOR ?>" onclick="mostrarCertificacion()">Certificación</a>
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center form-group form-group-sm">
                                <a class="btn btn-block btn-<?php echo COLOR ?>" href="<?php echo base_url('HistoriaClinica/DescargarHistoria/' . $historiaClinica[ID_HISTORIA_CLINICA]) ?>">Descargar Historia</a>
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center form-group form-group-sm">
                                <a class="btn btn-block btn-<?php echo COLOR ?>" onclick="mostrarModal('#modalHospitalizacion')">Hospitalización</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>