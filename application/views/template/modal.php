<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalMensaje" id="modalMensaje">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-personalizado">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span class="modal-title" id="modalMensajeTitulo"></span>
            </div>
            <div class="modal-body" id="modalMensajeContenido"></div>
            <div class="modal-footer">
                <button id="modalMensajeBoton" type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalMensajeModal" id="modalMensajeModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-personalizado">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span class="modal-title" id="modalMensajeModalTitulo"></span>
            </div>
            <div class="modal-body" id="modalMensajeModalContenido"></div>
            <div class="modal-footer">
                <button id="modalMensajeModalBoton" type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($historiaClinica)) { ?>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAutorizacion" id="modalAutorizacion">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-personalizado">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="modal-title">Descargar Autorización</span>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <?php if (empty($historiaClinica)) { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        Historia Clínica no registrada.
                                    </div>                                       
                                </div>                    
                            <?php } else { ?>
                                <form id="frmGenerarAutorizacion" name="frmGenerarAutorizacion">
                                    <div class="row">
                                        <div class="col-lg-6 form-group form-group-sm">
                                            <label for="inCedulaAutorizacion">Cédula</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inCedulaAutorizacionError"></label>
                                            <input class="form-control" id="inCedulaAutorizacion" name="inCedulaAutorizacion" type="text">
                                        </div>
                                        <div class="col-lg-6 form-group form-group-sm">
                                            <label for="inProcedimiento">Procedimiento</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inProcedimientoError"></label>
                                            <input class="form-control" id="inProcedimiento" name="inProcedimiento" type="text">
                                        </div>                                    
                                    </div>                                
                                </form>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="descargarAutorizacion('<?php echo base_url('HistoriaClinica/DescargarAutorizacion/' . $historiaClinica[ID_HISTORIA_CLINICA] . '/') ?>')">Descargar Autorización</button>
                    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAutorizacion" id="modalAutorizacion">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-personalizado">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="modal-title">Descargar Autorización</span>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <?php if (empty($historiaClinica)) { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        Historia Clínica no registrada.
                                    </div>                                       
                                </div>                    
                            <?php } else { ?>
                                <form id="frmGenerarAutorizacion" name="frmGenerarAutorizacion">
                                    <div class="row">
                                        <div class="col-lg-6 form-group form-group-sm">
                                            <label for="inCedulaAutorizacion">Cédula</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inCedulaAutorizacionError"></label>
                                            <input class="form-control" id="inCedulaAutorizacion" name="inCedulaAutorizacion" type="text">
                                        </div>
                                        <div class="col-lg-6 form-group form-group-sm">
                                            <label for="inProcedimiento">Procedimiento</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inProcedimientoError"></label>
                                            <input class="form-control" id="inProcedimiento" name="inProcedimiento" type="text">
                                        </div>                                    
                                    </div>                                
                                </form>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="descargarAutorizacion('<?php echo base_url('HistoriaClinica/DescargarAutorizacion/' . $historiaClinica[ID_HISTORIA_CLINICA] . '/') ?>')">Descargar Autorización</button>
                    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalCertificacion" id="modalCertificacion">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-personalizado">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="modal-title">Descargar Certificación</span>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <?php if (empty($historiaClinica)) { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        Historia Clínica no registrada.
                                    </div>                                       
                                </div>                    
                            <?php } else { ?>
                                <form id="frmGenerarCertificacion" name="frmGenerarCertificacion">
                                    <div class="row">
                                        <div class="col-lg-6 form-group form-group-sm">
                                            <label for="inCedulaCertificacion">Cédula</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inCedulaCertificacionError"></label>
                                            <input class="form-control" id="inCedulaCertificacion" name="inCedulaCertificacion" type="text">
                                        </div>
                                        <div class="col-lg-6 form-group form-group-sm">
                                            <label for="inPasaporte">Pasaporte</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inPasaporteError"></label>
                                            <input class="form-control" id="inPasaporte" name="inPasaporte" type="text">
                                        </div>
                                        <div class="col-lg-12 form-group form-group-sm">
                                            <label for="inContenido">Contenido</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inContenidoError"></label>
                                            <textarea class="form-control" id="inContenido" name="inContenido" rows="5"></textarea>
                                        </div>                                    
                                    </div>                                 
                                </form>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="descargarCertificacion('<?php echo base_url('HistoriaClinica/DescargarCertificacion/' . $historiaClinica[ID_HISTORIA_CLINICA] . '/') ?>')">Descargar Certificación</button>
                    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalHospitalizacion" id="modalHospitalizacion">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-personalizado">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="modal-title">Descargar Hospitalización</span>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <?php if (empty($historiaClinica)) { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        Historia Clínica no registrada.
                                    </div>                                       
                                </div>                    
                            <?php } else { ?>
                                <form id="frmGenerarHospitalizacion" name="frmGenerarHospitalizacion">
                                    <div class="row">
                                        <div class="col-lg-6 form-group form-group-sm">
                                            <label for="inCedulaHospitalizacion">Cédula</label>
                                            <label class="badge label-<?php echo COLOR ?> error" id="inCedulaHospitalizacionError"></label>
                                            <input class="form-control" id="inCedulaHospitalizacion" name="inCedulaHospitalizacion" type="text">
                                        </div>
                                    </div>                                
                                </form>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-<?php echo COLOR ?>" onclick="descargarHospitalizacion('<?php echo base_url('HistoriaClinica/DescargarHospitalizacion/' . $historiaClinica[ID_HISTORIA_CLINICA] . '/') ?>')">Descargar Hospitalización</button>
                    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalMensaje" id="modalCargando">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">   
            <div class="modal-body">
                <div class="cssload-loader">cargando</div>
            </div>           
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal" style="overflow-y: auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content">            
        </div>
    </div>
</div>
<div id="date-picker"></div>
<style>    
    .cssload-loader {
        width: 244px;
        height: 49px;
        line-height: 49px;
        text-align: center;
        position: absolute;
        left: 50%;
        transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        font-family: helvetica, arial, sans-serif;
        text-transform: uppercase;
        font-weight: 900;
        font-size:18px;
        color: rgb(0,0,0);
        letter-spacing: 0.2em;
    }
    .cssload-loader::before, .cssload-loader::after {
        content: "";
        display: block;
        width: 15px;
        height: 15px;
        background: rgb(0,0,0);
        position: absolute;
        animation: cssload-load 0.81s infinite alternate ease-in-out;
        -o-animation: cssload-load 0.81s infinite alternate ease-in-out;
        -ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
        -webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
        -moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
    }
    .cssload-loader::before {
        top: 0;
    }
    .cssload-loader::after {
        bottom: 0;
    }
    @keyframes cssload-load {
        0% {
            left: 0;
            height: 29px;
            width: 15px;
        }
        50% {
            height: 8px;
            width: 39px;
        }
        100% {
            left: 229px;
            height: 29px;
            width: 15px;
        }
    }
    @-o-keyframes cssload-load {
        0% {
            left: 0;
            height: 29px;
            width: 15px;
        }
        50% {
            height: 8px;
            width: 39px;
        }
        100% {
            left: 229px;
            height: 29px;
            width: 15px;
        }
    }
    @-ms-keyframes cssload-load {
        0% {
            left: 0;
            height: 29px;
            width: 15px;
        }
        50% {
            height: 8px;
            width: 39px;
        }
        100% {
            left: 229px;
            height: 29px;
            width: 15px;
        }
    }
    @-webkit-keyframes cssload-load {
        0% {
            left: 0;
            height: 29px;
            width: 15px;
        }
        50% {
            height: 8px;
            width: 39px;
        }
        100% {
            left: 229px;
            height: 29px;
            width: 15px;
        }
    }
    @-moz-keyframes cssload-load {
        0% {
            left: 0;
            height: 29px;
            width: 15px;
        }
        50% {
            height: 8px;
            width: 39px;
        }
        100% {
            left: 229px;
            height: 29px;
            width: 15px;
        }
    }
</style>