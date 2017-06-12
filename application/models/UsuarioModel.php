<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model {

    public $errores = array();

    public function __construct() {
        parent::__construct();
    }

    public function crearUsuario() {
        if ($this->validarUsuarioDatos('crear')) {
            return $this->crear($this->input->post('inNombresUsuario'), $this->input->post('inApellidosUsuario'), $this->input->post('inCorreoElectronicoUsuario'), $this->input->post('inCargoUsuario'), $this->input->post('inNumeroContactoUsuario'), $this->input->post('inUsuarioUsuario'), $this->input->post('inContrasenaUsuario'));
        } else {
            $this->obtenerUsuarioErroresDatos();
            return $this->errores;
        }
    }

    public function modificarUsuario() {
        if ($this->validarUsuarioDatos('modificar')) {
            return $this->modificar($this->input->post('inIdUsuario'), $this->input->post('inNombresUsuario'), $this->input->post('inApellidosUsuario'), $this->input->post('inCorreoElectronicoUsuario'), $this->input->post('inCargoUsuario'), $this->input->post('inNumeroContactoUsuario'), $this->input->post('inUsuarioUsuario'), $this->input->post('inContrasenaUsuario'));
        } else {
            $this->obtenerUsuarioErroresDatos();
            return $this->errores;
        }
    }

    public function eliminarUsuario() {
        if ($this->validarUsuarioDatos('eliminar')) {
            return $this->eliminar($this->input->post('inIdUsuario'));
        } else {
            $this->obtenerUsuarioErroresDatos();
            return $this->errores;
        }
    }

    public function ingresarUsuario() {
        if ($this->validarUsuarioDatos('ingresar')) {
            return $this->ingresar($this->input->post('inUsuarioUsuario'), $this->input->post('inContrasenaUsuario'));
        } else {
            $this->obtenerUsuarioErroresDatos();
            return $this->errores;
        }
    }

    private function validarUsuarioDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'crear':
                $this->form_validation->set_rules('inNombresUsuario', 'nombre(s)', 'trim|required');
                $this->form_validation->set_rules('inApellidosUsuario', 'apellidos(s)', 'trim|required');
                $this->form_validation->set_rules('inCorreoElectronicoUsuario', 'correo electrónico', 'trim|required');
                $this->form_validation->set_rules('inCargoUsuario', 'cargo', 'trim|required');
                $this->form_validation->set_rules('inNumeroContactoUsuario', 'número de contacto', 'trim|required');
                $this->form_validation->set_rules('inUsuarioUsuario', 'usuario', 'trim|required');
                $this->form_validation->set_rules('inContrasenaUsuario', 'contraseña', 'trim|required');
                if ($this->form_validation->run()) {
                    if (!($this->validarUsuarioExistenciaCorreoElectronico(null, $this->input->post('inCorreoElectronicoUsuario')) && $this->validarUsuarioExistenciaNumeroContacto(null, $this->input->post('inNumeroContactoUsuario')) && $this->validarUsuarioExistenciaUsuario(null, $this->input->post('inUsuarioUsuario')))) {
                        $estado = false;
                    }
                } else {
                    $estado = false;
                }
                break;
            case 'modificar':
                $this->form_validation->set_rules('inIdUsuario', 'id', 'trim|required');
                $this->form_validation->set_rules('inNombresUsuario', 'nombre(s)', 'trim|required');
                $this->form_validation->set_rules('inApellidosUsuario', 'apellidos(s)', 'trim|required');
                $this->form_validation->set_rules('inCorreoElectronicoUsuario', 'correo electrónico', 'trim|required');
                $this->form_validation->set_rules('inCargoUsuario', 'cargo', 'trim|required');
                $this->form_validation->set_rules('inNumeroContactoUsuario', 'número de contacto', 'trim|required');
                $this->form_validation->set_rules('inUsuarioUsuario', 'usuario', 'trim|required');
                $this->form_validation->set_rules('inContrasenaUsuario', 'contraseña', 'trim|required');
                if ($this->form_validation->run()) {
                    if (!($this->validarUsuarioExistenciaCorreoElectronico($this->input->post('inIdUsuario'), $this->input->post('inCorreoElectronicoUsuario')) && $this->validarUsuarioExistenciaNumeroContacto($this->input->post('inIdUsuario'), $this->input->post('inNumeroContactoUsuario')) && $this->validarUsuarioExistenciaUsuario($this->input->post('inIdUsuario'), $this->input->post('inUsuarioUsuario')))) {
                        $estado = false;
                    }
                } else {
                    $estado = false;
                }
                break;
            case 'eliminar':
                $this->form_validation->set_rules('inIdUsuario', 'id', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'ingresar':
                $this->form_validation->set_rules('inUsuarioUsuario', 'usuario', 'trim|required');
                $this->form_validation->set_rules('inContrasenaUsuario', 'contraseña', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    private function validarUsuarioExistenciaCorreoElectronico($idUsuario, $correoElectronicoUsuario) {
        $this->db->select(CORREO_ELECTRONICO_USUARIO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(CORREO_ELECTRONICO_USUARIO, $correoElectronicoUsuario);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        if (!empty($idUsuario)) {
            $this->db->where(ID_USUARIO . ' !=', $idUsuario);
        }
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            array_push($this->errores, array('campo' => 'inCorreoElectronicoUsuario', 'mensaje' => 'El correo electrónico ingresado ya ha sido registrado.', 'valor' => $correoElectronicoUsuario));
            return false;
        } else {
            return true;
        }
    }

    public function validarUsuarioExistenciaNumeroContacto($idUsuario, $numeroContactoUsuario) {
        $this->db->select(NUMERO_CONTACTO_USUARIO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(NUMERO_CONTACTO_USUARIO, $numeroContactoUsuario);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        if (!empty($idUsuario)) {
            $this->db->where(ID_USUARIO . ' !=', $idUsuario);
        }
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            array_push($this->errores, array('campo' => 'inNumeroContactoUsuario', 'mensaje' => 'El número de contacto ingresado ya ha sido registrado.', 'valor' => $numeroContactoUsuario));
            return false;
        } else {
            return true;
        }
    }

    public function validarUsuarioExistenciaUsuario($idUsuario, $usuarioUsuario) {
        $this->db->select(USUARIO_USUARIO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(USUARIO_USUARIO, $usuarioUsuario);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        if (!empty($idUsuario)) {
            $this->db->where(ID_USUARIO . ' !=', $idUsuario);
        }
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            array_push($this->errores, array('campo' => 'inUsuarioUsuario', 'mensaje' => 'El usuario ingresado ya ha sido registrado.', 'valor' => $usuarioUsuario));
            return false;
        } else {
            return true;
        }
    }

    private function crear($nombresUsuario, $apellidosUsuario, $correoElectronicoUsuario, $cargoUsuario, $numeroContactoUsuario, $usuarioUsuario, $contrasenaUsuario) {
        $this->db->trans_start();
        $this->db->set(NOMBRES_USUARIO, $nombresUsuario);
        $this->db->set(APELLIDOS_USUARIO, $apellidosUsuario);
        $this->db->set(CORREO_ELECTRONICO_USUARIO, $correoElectronicoUsuario);
        $this->db->set(CARGO_USUARIO, $cargoUsuario);
        $this->db->set(NUMERO_CONTACTO_USUARIO, $numeroContactoUsuario);
        $this->db->set(USUARIO_USUARIO, $usuarioUsuario);
        $this->db->set(CONTRASENA_USUARIO, $this->encriptarUsuarioContrasena($contrasenaUsuario));
        $this->db->insert(TBL_USUARIOS);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    private function modificar($idUsuario, $nombresUsuario, $apellidosUsuario, $correoElectronicoUsuario, $cargoUsuario, $numeroContactoUsuario, $usuarioUsuario, $contrasenaUsuario) {
        $this->db->trans_start();
        $this->db->set(NOMBRES_USUARIO, $nombresUsuario);
        $this->db->set(APELLIDOS_USUARIO, $apellidosUsuario);
        $this->db->set(CORREO_ELECTRONICO_USUARIO, $correoElectronicoUsuario);
        $this->db->set(CARGO_USUARIO, $cargoUsuario);
        $this->db->set(NUMERO_CONTACTO_USUARIO, $numeroContactoUsuario);
        $this->db->set(USUARIO_USUARIO, $usuarioUsuario);
        $this->db->set(CONTRASENA_USUARIO, $this->encriptarUsuarioContrasena($contrasenaUsuario));
        $this->db->where(ID_USUARIO, $idUsuario);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        $this->db->update(TBL_USUARIOS);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    private function eliminar($idUsuario) {
        $this->db->trans_start();
        $this->db->set(ESTADO_USUARIO, 'ELIMINADO');
        $this->db->where(ID_USUARIO, $idUsuario);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        $this->db->update(TBL_USUARIOS);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function ingresar($usuarioUsuario, $contrasenaUsuario) {
        $estado = true;
        $this->db->select(TODO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(USUARIO_USUARIO, $usuarioUsuario);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $usuario = $resultado->row_array();
            if (!password_verify($contrasenaUsuario, $usuario[CONTRASENA_USUARIO])) {
                $estado = false;
            } else {
                $this->session->set_userdata('sesion', $usuario);
            }
        } else {
            $estado = false;
        }
        return $estado;
    }

    private function encriptarUsuarioContrasena($contrasenaUsuario) {
        return password_hash($contrasenaUsuario, PASSWORD_BCRYPT);
    }

    public function obtenerUsuariosPagina($pagina, $campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerUsuariosCampoFiltro($campoFiltro), $valorFiltro);
        }
        $this->db->limit(REGISTROS_POR_PAGINA, empty($pagina) ? 0 : $pagina * REGISTROS_POR_PAGINA);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function obtenerUsuariosCantidadPaginas($campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerUsuariosCampoFiltro($campoFiltro), $valorFiltro);
        }
        $resultado = $this->db->get();
        $ajuste = 0;
        if ($resultado->num_rows() % REGISTROS_POR_PAGINA == 0) {
            $ajuste = 1;
        }
        return intval($resultado->num_rows() / REGISTROS_POR_PAGINA) - $ajuste;
    }

    private function obtenerUsuariosCampoFiltro($campoFiltro) {
        switch ($campoFiltro) {
            case 1:
                return TBL_USUARIOS . '.' . ID_USUARIO;
            case 2:
                return TBL_USUARIOS . '.' . NOMBRES_USUARIO;
            case 3:
                return TBL_USUARIOS . '.' . APELLIDOS_USUARIO;
        }
    }

    public function obtenerUsuarios() {
        $this->db->select(TODO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        $this->db->where(TIPO_USUARIO . ' !=', 1);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function obtenerUsuarioPorIdUsuario($idUsuario) {
        $this->db->select(TODO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        $this->db->where(ID_USUARIO, $idUsuario);
        $resultado = $this->db->get();
        return $resultado->row_array();
    }
    
    public function obtenerUsuarioPorUsuarioUsuario($usuarioUsuario) {
        $this->db->select(TODO);
        $this->db->from(TBL_USUARIOS);
        $this->db->where(ESTADO_USUARIO, 'ACTIVO');
        $this->db->where(USUARIO_USUARIO, $usuarioUsuario);
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obtenerUsuarioErroresDatos() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
    }

    public function salirUsuario() {
        $this->session->unset_userdata('sesion');
    }

}
