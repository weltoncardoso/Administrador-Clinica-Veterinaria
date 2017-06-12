<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HistoriaClinicaModel extends CI_Model {

    public $errores = array();
    public $id;

    public function __construct() {
        parent::__construct();
    }

    public function crearHistoriaClinica($idPaciente) {
        $this->crear($idPaciente);
    }

    public function modificarHistoriaClinica() {
        if ($this->validarHistoriaClinicaDatos('modificar')) {
            return $this->modificar($this->input->post('inIdHistoriaClinica'), $this->input->post('inFechaHistoriaClinica'));
        } else {
            $this->obtenerHistoriaClinicaErroresDatos();
            return $this->errores;
        }
    }

    public function validarHistoriaClinicaDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'modificar':
                $this->form_validation->set_rules('inIdHistoriaClinica', 'id', 'trim|required');
                $this->form_validation->set_rules('inFechaHistoriaClinica', 'fecha', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    public function crear($idPaciente) {
        $this->db->set(ID_PACIENTE, $idPaciente);
        $this->db->insert(TBL_HISTORIAS_CLINICAS);
    }

    public function modificar($idHistoriaClinica, $fechaHistoriaClinica) {
        $this->db->trans_start();
        $this->db->set(FECHA_HISTORIA_CLINICA, $fechaHistoriaClinica);
        $this->db->where(ID_HISTORIA_CLINICA, $idHistoriaClinica);
        $this->db->where(ESTADO_HISTORIA_CLINICA, 'ACTIVO');
        $this->db->update(TBL_HISTORIAS_CLINICAS);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function obtenerHistoriaClinicaPorIdHistoriaClinica($idHistoriaClinica) {
        $this->db->select(TODO);
        $this->db->from(TBL_HISTORIAS_CLINICAS);
        $this->db->where(ID_HISTORIA_CLINICA, $idHistoriaClinica);
        $this->db->where(ESTADO_HISTORIA_CLINICA, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obtenerHistoriaClinicaPorIdPaciente($idPaciente) {
        $this->db->select(TODO);
        $this->db->from(TBL_HISTORIAS_CLINICAS);
        $this->db->where(ID_PACIENTE, $idPaciente);
        $this->db->where(ESTADO_HISTORIA_CLINICA, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obtenerHistoriaClinicaErroresDatos() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
    }

}
