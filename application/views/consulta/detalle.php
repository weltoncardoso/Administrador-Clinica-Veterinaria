<div class="modal-header modal-header-personalizado">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="modal-title">Detalle Consulta</span>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inFechaConsulta">Fecha</label>
                            <input class="form-control" disabled id="inFechaConsulta" name="inFechaConsulta" type="text" value="<?php echo $consulta[FECHA_CONSULTA]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inAnamnesisConsulta">Anamnesis</label>
                            <textarea class="form-control" disabled id="inAnamnesisConsulta" name="inAnamnesisConsulta" rows="5"><?php echo $consulta[ANAMNESIS_CONSULTA]; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inUsuarioConsulta">Usuario</label>
                            <select class="form-control" disabled id="inUsuarioConsulta" name="inUsuarioConsulta" type="text">
                                <option value="">SELECCIONAR</option>
                                <?php
                                if (!empty($usuarios)) {
                                    foreach ($usuarios as $usuario) {
                                        ?>
                                        <option value="<?php echo $usuario[ID_USUARIO]; ?>" <?php echo ($usuario[ID_USUARIO] == $consulta[ID_USUARIO]) ? "selected" : "" ?>><?php echo $usuario[NOMBRES_USUARIO] . ' ' . $usuario[APELLIDOS_USUARIO]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inPConsulta">Peso</label>
                            <input class="form-control" disabled id="inPConsulta" name="inPConsulta" type="text" value="<?php echo $consulta[PESO_CONSULTA]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inTConsulta">Temperatura</label>
                            <input class="form-control" disabled id="inTConsulta" name="inTConsulta" type="text" value="<?php echo $consulta[TEMPERATURA_CONSULTA]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inFCConsulta">Frec. Cardiaca</label>
                            <input class="form-control" disabled id="inFCConsulta" name="inFCConsulta" type="text" value="<?php echo $consulta[FRECUENCIA_CARDIACA_CONSULTA]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inFRConsulta">Frec. Respiratoria</label>
                            <input class="form-control" disabled id="inFRConsulta" name="inFRConsulta" type="text" value="<?php echo $consulta[FRECUENCIA_RESPIRATORIA_CONSULTA]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inExamenClinicoConsulta">Exámen Clinico</label>
                            <textarea class="form-control" disabled id="inExamenClinicoConsulta" name="inExamenClinicoConsulta" rows="10"><?php echo $consulta[EXAMEN_CLINICO_CONSULTA]; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group form-group-sm">
                            <label for="inRecetaMedicaConsulta">Receta Médica</label>
                            <textarea class="form-control" disabled id="inRecetaMedicaConsulta" name="inRecetaMedicaConsulta" rows="5" placeholder="no registrada"><?php echo $consulta[RECETA_MEDICA_CONSULTA]; ?></textarea>
                        </div>
                    </div>
                </div>                                  
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a class="btn btn-<?php echo COLOR ?>" href="<?php echo base_url('Consulta/DescargarReporteRecetaMedica/' . $consulta[ID_CONSULTA]) ?>">Descargar Receta Medica</a>
    <button type="button" class="btn btn-<?php echo COLOR ?>" data-dismiss="modal">Cerrar</button>
</div>