<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="menu">
            <?php if (!empty($regresar)) { ?>
                <form class="navbar-form navbar-left">                
                    <a class="btn btn-block btn-<?php echo COLOR ?>" href="<?php echo $regresar ?>">Regresar</a>
                </form>
            <?php } ?>
            <ul class="nav navbar-nav">
                <?php if ($this->session->userdata(SESION)[TIPO_USUARIO] == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Usuario') ?>">Usuarios</a>
                    </li>
                <?php } else { ?>                    
                    <li class="nav-item">
                        <a class="nav-link" onclick="crearModal('<?php echo base_url('Usuario/ObtenerModal') ?>', {operacion: 'modificar', inIdUsuario: <?php echo $this->session->userdata(SESION)[ID_USUARIO] ?>}, '#modal')">Usuario</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('Cliente') ?>">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('Propietario') ?>">Propietarios</a>
                </li>
                <?php if ($this->session->userdata(SESION)[TIPO_USUARIO] == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('PlanMedicinaPrepagada') ?>">Planes Medicina Prepagada</a>
                    </li>
                <?php } ?>
            </ul>            
            <form class="navbar-form navbar-right">                
                <a class="btn btn-block btn-<?php echo COLOR ?>" href="<?php echo base_url('Usuario/Salir') ?>">Salir</a>
            </form>
        </div>
    </div>
</nav>
<div class="row" style="margin-top: 70px">
</div>