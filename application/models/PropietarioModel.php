<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PropietarioModel extends CI_Model {

    public $errores = array();
    public $id;

    public function __construct() {
        parent::__construct();
    }

    public function crearPropietario() {
        if ($this->validarPropietarioDatos('crear')) {
            return $this->crear($this->input->post('inNombresPropietario'), $this->input->post('inApellidosPropietario'), $this->input->post('inIdentificacionPropietario'), $this->input->post('inDireccionPropietario'), $this->input->post('inCorreoElectronicoPropietario'), $this->input->post('inPropietario'));
        } else {
            $this->obtenerPropietarioErroresDatos();
            return $this->errores;
        }
    }

    public function modificarPropietario() {
        if ($this->validarPropietarioDatos('modificar')) {
            return $this->modificar($this->input->post('inIdPropietario'), $this->input->post('inNombresPropietario'), $this->input->post('inApellidosPropietario'), $this->input->post('inIdentificacionPropietario'), $this->input->post('inDireccionPropietario'), $this->input->post('inCorreoElectronicoPropietario'), $this->input->post('inPropietario'));
        } else {
            $this->obtenerPropietarioErroresDatos();
            return $this->errores;
        }
    }

    public function eliminarPropietario() {
        if ($this->validarPropietarioDatos('eliminar')) {
            return $this->eliminar($this->input->post('inIdPropietario'));
        } else {
            $this->obtenerPropietarioErroresDatos();
            return $this->errores;
        }
    }

    /* public function crearPropietario() {
      $this->db->set(NOMBRES_PROPIETARIO, mb_strtoupper($this->input->post('inNombresPropietario')));
      $this->db->set(APELLIDOS_PROPIETARIO, mb_strtoupper($this->input->post('inApellidosPropietario')));
      $this->db->set(DIRECCION_PROPIETARIO, mb_strtoupper($this->input->post('inDireccionPropietario')));
      $this->db->set(CORREO_ELECTRONICO_PROPIETARIO, mb_strtoupper($this->input->post('inCorreoElectronicoPropietario')));
      $this->db->insert(TBL_PROPIETARIOS);
      $this->id = $this->db->insert_id();
      $this->crearPropietarioNumerosContacto();
      } */

    /* public function modificarPropietario() {
      if ($this->validarPropietarioDatos('modificar')) {
      $this->db->trans_start();
      $this->db->set(NOMBRES_PROPIETARIO, mb_strtoupper($this->input->post('inNombresPropietario')));
      $this->db->set(APELLIDOS_PROPIETARIO, mb_strtoupper($this->input->post('inApellidosPropietario')));
      $this->db->set(DIRECCION_PROPIETARIO, mb_strtoupper($this->input->post('inDireccionPropietario')));
      $this->db->set(CORREO_ELECTRONICO_PROPIETARIO, mb_strtoupper($this->input->post('inCorreoElectronicoPropietario')));
      $this->db->where(ID_PROPIETARIO, mb_strtoupper($this->input->post('inIdPropietario')));
      $this->db->update(TBL_PROPIETARIOS);
      $this->id = mb_strtoupper($this->input->post('inIdPropietario'));
      $this->eliminarPropietarioNumerosContacto();
      $this->crearPropietarioNumerosContacto();
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
      log_message('error', $this->db->error());
      return false;
      } else {
      return true;
      }
      } else {
      $this->obtenerPropietarioErroresDatos();
      return $this->errores;
      }
      } */

    /* public function eliminarPropietario() {
      $this->db->trans_start();
      $sqlA = 'UPDATE tbl_propietarios, tbl_propietarios_numeros_contacto, tbl_pacientes, tbl_historias_clinicas SET tbl_propietarios.`estado_propietario` = "ELIMINADO", tbl_propietarios_numeros_contacto.`estado_numero_contacto` = "ELIMINADO", tbl_pacientes.`estado_paciente` = "ELIMINADO", tbl_historias_clinicas.`estado_historia_clinica` = "ELIMINADO" WHERE tbl_propietarios.`id_propietario` = tbl_propietarios_numeros_contacto.`id_propietario` AND tbl_propietarios.`id_propietario` = tbl_pacientes.`id_propietario` AND tbl_pacientes.`id_paciente` = tbl_historias_clinicas.`id_paciente` AND tbl_propietarios.`id_propietario` = ?';
      $this->db->query($sqlA, mb_strtoupper($this->input->post('inIdPropietario')));
      $sqlB = 'UPDATE tbl_propietarios, tbl_pacientes, tbl_historias_clinicas, tbl_consultas SET tbl_consultas.`estado_consulta` = "ELIMINADO" WHERE tbl_propietarios.`id_propietario` = tbl_pacientes.`id_propietario` AND tbl_pacientes.`id_paciente` = tbl_historias_clinicas.`id_paciente` AND tbl_historias_clinicas.`id_historia_clinica` = tbl_consultas.`id_historia_clinica` AND tbl_propietarios.`id_propietario` = ?';
      $this->db->query($sqlB, mb_strtoupper($this->input->post('inIdPropietario')));
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
      log_message('error', $this->db->error());
      return false;
      } else {
      return true;
      }
      } */

    /* public function crearPropietarioNumerosContacto() {
      foreach ($this->input->post('inPropietario') as $campo) {
      $this->db->set(ID_PROPIETARIO, $this->id);
      $this->db->set(NUMERO_CONTACTO_PROPIETARIO, mb_strtoupper($campo['numerocontacto']));
      $this->db->insert(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
      }
      } */

    /* public function eliminarPropietarioNumerosContacto($idPropietario) {
      $this->db->where(ID_PROPIETARIO, $idPropietario);
      $this->db->delete(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
      } */

    public function validarPropietarioDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'crear':
                $this->form_validation->set_rules('inNombresPropietario', 'nombre(s)', 'trim|required');
                $this->form_validation->set_rules('inApellidosPropietario', 'apellidos(s)', 'trim|required');
                $this->form_validation->set_rules('inDireccionPropietario', 'dirección', 'trim|required');
                $this->form_validation->set_rules('inCorreoElectronicoPropietario', 'correo electrónico', 'trim|required');
                foreach ($this->input->post('inPropietario') as $indice => $campo) {
                    $this->form_validation->set_rules('inPropietario[' . $indice . '][numerocontacto]', 'número de contacto', 'trim|required');
                }
                if ($this->form_validation->run()) {
                    if (!($this->validarPropietarioExistenciaCorreoElectronico(null, $this->input->post('inCorreoElectronicoPropietario')) && $this->validarPropietarioExistenciaNumeroContacto(null, $this->input->post('inPropietario')))) {
                        $estado = false;
                    }
                } else {
                    $estado = false;
                }
                break;
            case 'modificar':
                $this->form_validation->set_rules('inIdPropietario', 'id', 'trim|required');
                $this->form_validation->set_rules('inNombresPropietario', 'nombre(s)', 'trim|required');
                $this->form_validation->set_rules('inApellidosPropietario', 'apellidos(s)', 'trim|required');
                $this->form_validation->set_rules('inDireccionPropietario', 'dirección', 'trim|required');
                $this->form_validation->set_rules('inCorreoElectronicoPropietario', 'correo electrónico', 'trim|required');
                foreach ($this->input->post('inPropietario') as $indice => $campo) {
                    $this->form_validation->set_rules('inPropietario[' . $indice . '][numerocontacto]', 'número de contacto', 'trim|required');
                }
                if ($this->form_validation->run()) {
                    if (!($this->validarPropietarioExistenciaCorreoElectronico($this->input->post('inIdPropietario'), $this->input->post('inCorreoElectronicoPropietario')) && $this->validarPropietarioExistenciaNumeroContacto($this->input->post('inIdPropietario'), $this->input->post('inPropietario')))) {
                        $estado = false;
                    }
                } else {
                    $estado = false;
                }
                break;
            case 'eliminar':
                $this->form_validation->set_rules('inIdPropietario', 'id', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    public function validarPropietarioExistenciaCorreoElectronico($idPropietario, $correoElectronicoPropietario) {
        $this->db->select(CORREO_ELECTRONICO_PROPIETARIO);
        $this->db->from(TBL_PROPIETARIOS);
        $this->db->where(CORREO_ELECTRONICO_PROPIETARIO, $correoElectronicoPropietario);
        $this->db->where(ESTADO_PROPIETARIO, 'ACTIVO');
        if (!empty($idPropietario)) {
            $this->db->where(ID_PROPIETARIO . ' !=', $idPropietario);
        }
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            array_push($this->errores, array('campo' => 'inCorreoElectronicoPropietario', 'mensaje' => 'El correo electrónico ingresado ya ha sido registrado.', 'valor' => $this->input->post('inCorreoElectronicoPropietario')));
            return false;
        } else {
            return true;
        }
    }

    public function validarPropietarioExistenciaNumeroContacto($idPropietario, $numeroContacto) {
        $estado = true;
        foreach ($numeroContacto as $indice => $campo) {
            $this->db->select(NUMERO_CONTACTO_PROPIETARIO);
            $this->db->from(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
            $this->db->where(NUMERO_CONTACTO_PROPIETARIO, $campo['numerocontacto']);
            $this->db->where(ESTADO_NUMERO_CONTACTO, 'ACTIVO');
            if (!empty($idPropietario)) {
                $this->db->where(ID_PROPIETARIO . ' !=', $idPropietario);
            }
            $resultado = $this->db->get();
            if ($resultado->num_rows() > 0) {
                array_push($this->errores, array('campo' => 'inNumeroContactoPropietario' . $indice, 'mensaje' => 'El número de contacto ingresado ya ha sido registrado.', 'valor' => $campo['numerocontacto']));
                $estado = false;
            }
        }
        return $estado;
    }

    public function crear($nombresPropietario, $apellidosPropietario, $identificacionPropietario, $direccionPropietario, $correoElectronicoPropietario, $numerosContactoPropietario) {
        $this->db->trans_start();
        $this->db->set(NOMBRES_PROPIETARIO, $nombresPropietario);
        $this->db->set(APELLIDOS_PROPIETARIO, $apellidosPropietario);
        $this->db->set(IDENTIFICACION_PROPIETARIO, $identificacionPropietario);
        $this->db->set(DIRECCION_PROPIETARIO, $direccionPropietario);
        $this->db->set(CORREO_ELECTRONICO_PROPIETARIO, $correoElectronicoPropietario);
        $this->db->insert(TBL_PROPIETARIOS);
        $this->id = $this->db->insert_id();
        foreach ($numerosContactoPropietario as $campo) {
            $this->db->set(ID_PROPIETARIO, $this->id);
            $this->db->set(NUMERO_CONTACTO_PROPIETARIO, $campo['numerocontacto']);
            $this->db->insert(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function modificar($idPropietario, $nombresPropietario, $apellidosPropietario, $identificacionPropietario, $direccionPropietario, $correoElectronicoPropietario, $numerosContactoPropietario) {
        $this->db->trans_start();
        $this->db->set(NOMBRES_PROPIETARIO, $nombresPropietario);
        $this->db->set(APELLIDOS_PROPIETARIO, $apellidosPropietario);
        $this->db->set(IDENTIFICACION_PROPIETARIO, $identificacionPropietario);
        $this->db->set(DIRECCION_PROPIETARIO, $direccionPropietario);
        $this->db->set(CORREO_ELECTRONICO_PROPIETARIO, $correoElectronicoPropietario);
        $this->db->where(ID_PROPIETARIO, $idPropietario);
        $this->db->update(TBL_PROPIETARIOS);
        $this->db->where(ID_PROPIETARIO, $idPropietario);
        $this->db->delete(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
        foreach ($numerosContactoPropietario as $campo) {
            $this->db->set(ID_PROPIETARIO, $idPropietario);
            $this->db->set(NUMERO_CONTACTO_PROPIETARIO, $campo['numerocontacto']);
            $this->db->insert(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    private function eliminar($idPropietario) {
        $this->db->trans_start();
        $this->db->set(ESTADO_PROPIETARIO, 'ELIMINADO');
        $this->db->where(ID_PROPIETARIO, $idPropietario);
        $this->db->where(ESTADO_PROPIETARIO, 'ACTIVO');
        $this->db->update(TBL_PROPIETARIOS);
        $this->db->set(ESTADO_NUMERO_CONTACTO, 'ELIMINADO');
        $this->db->where(ID_PROPIETARIO, $idPropietario);
        $this->db->where(ESTADO_NUMERO_CONTACTO, 'ACTIVO');
        $this->db->update(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function obtenerPropietarioPorIdPropietario($idPropietario) {
        $this->db->select(TODO);
        $this->db->from(TBL_PROPIETARIOS);
        $this->db->where(ID_PROPIETARIO, $idPropietario);
        $this->db->where(ESTADO_PROPIETARIO, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obtenerPropietarioNumerosContactoPorIdPropietario($idPropietario) {
        $this->db->select(TODO);
        $this->db->from(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
        $this->db->where(ID_PROPIETARIO, $idPropietario);
        $this->db->where(ESTADO_NUMERO_CONTACTO, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado;
    }

    public function obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($idPropietario) {
        $this->db->select('group_concat(' . NUMERO_CONTACTO_PROPIETARIO . ' separator " - ") as ' . NUMERO_CONTACTO_PROPIETARIO);
        $this->db->from(TBL_PROPIETARIOS_NUMEROS_CONTACTO);
        $this->db->where(ID_PROPIETARIO, $idPropietario);
        $this->db->where(ESTADO_NUMERO_CONTACTO, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obtenerPropietariosCantidadPaginas($campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_PROPIETARIOS);
        $this->db->where(ESTADO_PROPIETARIO, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerPropietariosCampoFiltro($campoFiltro), $valorFiltro);
        }
        $resultado = $this->db->get();
        $ajuste = 0;
        if ($resultado->num_rows() % REGISTROS_POR_PAGINA == 0) {
            $ajuste = 1;
        }
        return intval($resultado->num_rows() / REGISTROS_POR_PAGINA) - $ajuste;
    }

    public function obtenerPropietariosPagina($pagina, $campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_PROPIETARIOS);
        $this->db->where(ESTADO_PROPIETARIO, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerPropietariosCampoFiltro($campoFiltro), $valorFiltro);
        }
        $this->db->limit(REGISTROS_POR_PAGINA, empty($pagina) ? 0 : $pagina * REGISTROS_POR_PAGINA);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function obtenerPropietarioErroresDatos() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
        foreach ($this->input->post('inPropietario') as $indice => $campo) {
            (form_error('inPropietario[' . $indice . '][numerocontacto]') != null) ? array_push($this->errores, array(
                                'campo' => 'inNumeroContactoPropietario' . $indice,
                                'mensaje' => strip_tags(form_error('inPropietario[' . $indice . '][numerocontacto]')),
                                'valor' => $campo['numerocontacto']
                            )) : null;
        }
    }

    private function obtenerPropietariosCampoFiltro($campoFiltro) {
        switch ($campoFiltro) {
            case 1:
                return TBL_PROPIETARIOS . '.' . ID_PROPIETARIO;
            case 2:
                return TBL_PROPIETARIOS . '.' . NOMBRES_PROPIETARIO;
            case 3:
                return TBL_PROPIETARIOS . '.' . APELLIDOS_PROPIETARIO;
            case 4:
                return TBL_PROPIETARIOS . '.' . IDENTIFICACION_PROPIETARIO;
        }
    }

}
