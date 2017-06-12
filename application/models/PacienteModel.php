<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PacienteModel extends CI_Model {

    public $errores = array();
    public $id;
    public $ids = array();

    public function __construct() {
        parent::__construct();
    }

    public function crearPaciente($idPropietario) {
        if ($this->validarPacienteDatos('crear')) {
            return $this->crear($idPropietario, $this->input->post('inPaciente'));
        } else {
            $this->obtenerPacienteErroresDatos();
            return $this->errores;
        }
    }

    public function modificarPaciente() {
        if ($this->validarPacienteDatos('modificar')) {
            return $this->modificar($this->input->post('inPaciente'));
        } else {
            $this->obtenerPacienteErroresDatos();
            return $this->errores;
        }
    }

    public function eliminarPaciente() {
        if ($this->validarPacienteDatos('eliminar')) {
            return $this->eliminar($this->input->post('inIdPaciente'));
        } else {
            $this->obtenerPacienteErroresDatos();
            return $this->errores;
        }
    }

    public function validarPacienteDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'crear':
                foreach ($this->input->post('inPaciente') as $indice => $campo) {
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][nombre]', 'nombre', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][especie]', 'especie', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][raza]', 'raza', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][sexo]', 'sexo', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][fechanacimiento]', 'fecha de nacimiento', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][descripcion]', 'descripción', 'trim|required');
                }
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'modificar':
                foreach ($this->input->post('inPaciente') as $indice => $campo) {
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][id]', 'id', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][nombre]', 'nombre', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][especie]', 'especie', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][raza]', 'raza', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][sexo]', 'sexo', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][fechanacimiento]', 'fecha de nacimiento', 'trim|required');
                    $this->form_validation->set_rules('inPaciente[' . $indice . '][descripcion]', 'descripción', 'trim|required');
                }
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'eliminar':
                $this->form_validation->set_rules('inIdPaciente', 'id', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    public function crear($idPropietario, $pacientes) {
        $this->db->trans_start();
        foreach ($pacientes as $campo) {
            $this->db->set(ID_PROPIETARIO, $idPropietario);
            $this->db->set(NOMBRE_PACIENTE, $campo['nombre']);
            $this->db->set(ESPECIE_PACIENTE, $campo['especie']);
            $this->db->set(RAZA_PACIENTE, $campo['raza']);
            $this->db->set(SEXO_PACIENTE, $campo['sexo']);
            $this->db->set(FECHA_NACIMIENTO_PACIENTE, $campo['fechanacimiento']);
            $this->db->set(CHIP_PACIENTE, $campo['chip']);
            //$this->db->set(FOTO_PACIENTE, $campo['foto']);
            $this->db->set(DESCRIPCION_PACIENTE, $campo['descripcion']);
            $this->db->insert(TBL_PACIENTES);
            $idPaciente = $this->db->insert_id();
            $this->db->set(ID_PACIENTE, $idPaciente);
            $this->db->set(FECHA_HISTORIA_CLINICA, date('Y-m-d'));
            $this->db->insert(TBL_HISTORIAS_CLINICAS);
            array_push($this->ids, $this->db->insert_id());
        }
        $this->session->set_tempdata('historiasClinicas', $this->ids, 60);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function modificar($pacientes) {
        $this->db->trans_start();
        foreach ($pacientes as $campo) {
            $this->db->set(NOMBRE_PACIENTE, $campo['nombre']);
            $this->db->set(ESPECIE_PACIENTE, $campo['especie']);
            $this->db->set(RAZA_PACIENTE, $campo['raza']);
            $this->db->set(SEXO_PACIENTE, $campo['sexo']);
            $this->db->set(FECHA_NACIMIENTO_PACIENTE, $campo['fechanacimiento']);
            $this->db->set(CHIP_PACIENTE, $campo['chip']);
            //$this->db->set(FOTO_PACIENTE, $campo['foto']);
            $this->db->set(DESCRIPCION_PACIENTE, $campo['descripcion']);
            $this->db->where(ID_PACIENTE, $campo['id']);
            $this->db->update(TBL_PACIENTES);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function eliminar($idPaciente) {
        $this->db->trans_start();
        $this->db->set(ESTADO_PACIENTE, 'ELIMINADO');
        $this->db->where(ID_PACIENTE, $idPaciente);
        $this->db->where(ESTADO_PACIENTE, 'ACTIVO');
        $this->db->update(TBL_PACIENTES);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function obtenerPacienteErroresDatos() {
        foreach ($this->input->post('inPaciente') as $indice => $campo) {
            (form_error('inPaciente[' . $indice . '][nombre]') != null) ? array_push($this->errores, array(
                                'campo' => 'inNombrePaciente' . $indice,
                                'mensaje' => strip_tags(form_error('inPaciente[' . $indice . '][nombre]')),
                                'valor' => $campo['nombre']
                            )) : null;
            (form_error('inPaciente[' . $indice . '][especie]') != null) ? array_push($this->errores, array(
                                'campo' => 'inEspeciePaciente' . $indice,
                                'mensaje' => strip_tags(form_error('inPaciente[' . $indice . '][especie]')),
                                'valor' => $campo['especie']
                            )) : null;
            (form_error('inPaciente[' . $indice . '][raza]') != null) ? array_push($this->errores, array(
                                'campo' => 'inRazaPaciente' . $indice,
                                'mensaje' => strip_tags(form_error('inPaciente[' . $indice . '][raza]')),
                                'valor' => $campo['raza']
                            )) : null;
            (form_error('inPaciente[' . $indice . '][sexo]') != null) ? array_push($this->errores, array(
                                'campo' => 'inSexoPaciente' . $indice,
                                'mensaje' => strip_tags(form_error('inPaciente[' . $indice . '][sexo]')),
                                'valor' => $campo['sexo']
                            )) : null;
            (form_error('inPaciente[' . $indice . '][fechanacimiento]') != null) ? array_push($this->errores, array(
                                'campo' => 'inFechaNacimientoPaciente' . $indice,
                                'mensaje' => strip_tags(form_error('inPaciente[' . $indice . '][fechanacimiento]')),
                                'valor' => $campo['fechanacimiento']
                            )) : null;
            (form_error('inPaciente[' . $indice . '][descripcion]') != null) ? array_push($this->errores, array(
                                'campo' => 'inDescripcionPaciente' . $indice,
                                'mensaje' => strip_tags(form_error('inPaciente[' . $indice . '][descripcion]')),
                                'valor' => $campo['descripcion']
                            )) : null;
        }
    }

    public function obtenerPacienteErroresDato() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
    }

    public function obtenerPacientePorIdPaciente($idPaciente) {
        $this->db->select(TODO);
        $this->db->from(TBL_PACIENTES);
        $this->db->where(ID_PACIENTE, $idPaciente);
        $this->db->where(ESTADO_PACIENTE, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    /* public function modificarPaciente() {
      if ($this->validarPacienteDatos('modificar')) {
      $this->db->trans_start();
      $this->db->set(NOMBRE_PACIENTE, $this->input->post('inNombrePaciente'));
      $this->db->set(ESPECIE_PACIENTE, $this->input->post('inEspeciePaciente'));
      $this->db->set(RAZA_PACIENTE, $this->input->post('inRazaPaciente'));
      $this->db->set(SEXO_PACIENTE, $this->input->post('inSexoPaciente'));
      $this->db->set(FECHA_NACIMIENTO_PACIENTE, $this->input->post('inFechaNacimientoPaciente'));
      $this->db->set(CHIP_PACIENTE, $this->input->post('inChipPaciente'));
      //$this->db->set(FOTO_PACIENTE, $this->input->post('inFotoPaciente'));
      $this->db->set(DESCRIPCION_PACIENTE, $this->input->post('inDescripcionPaciente'));
      $this->db->where(ID_PACIENTE, $this->input->post('inIdPaciente'));
      $this->db->update(TBL_PACIENTES);
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
      log_message('error', $this->db->error());
      return false;
      } else {
      return true;
      }
      } else {
      $this->obtenerPacienteErroresDato();
      return $this->errores;
      }
      } */

    /* public function eliminarPaciente() {
      $this->db->trans_start();
      $sqlA = 'UPDATE tbl_pacientes, tbl_historias_clinicas SET tbl_pacientes.`estado_paciente` = "ELIMINADO", tbl_historias_clinicas.`estado_historia_clinica` = "ELIMINADO" WHERE tbl_pacientes.`id_paciente` = tbl_historias_clinicas.`id_paciente` AND tbl_pacientes.`id_paciente` = ?';
      $this->db->query($sqlA, $this->input->post('inIdPaciente'));
      $sqlB = 'UPDATE tbl_pacientes, tbl_historias_clinicas, tbl_consultas SET tbl_consultas.`estado_consulta` = "ELIMINADO" WHERE tbl_pacientes.`id_paciente` = tbl_historias_clinicas.`id_paciente` AND tbl_historias_clinicas.`id_historia_clinica` = tbl_consultas.`id_historia_clinica` AND tbl_pacientes.`id_paciente` = ?';
      $this->db->query($sqlB, $this->input->post('inIdPaciente'));
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
      log_message('error', $this->db->error());
      return false;
      } else {
      return true;
      }
      } */
}
