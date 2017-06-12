<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AfiliacionModel extends CI_Model {

    public $errores = array();
    public $id;

    public function __construct() {
        parent::__construct();
    }

    public function crearAfiliacion() {
        if ($this->validarAfiliacionDatos('crear')) {
            return $this->crear($this->input->post('inIdPaciente'), $this->input->post('inIdPlanMedicinaPrepagada'));
        } else {
            $this->obtenerAfiliacionErroresDatos();
            return $this->errores;
        }
    }

    public function eliminarAfiliacion() {
        if ($this->validarAfiliacionDatos('eliminar')) {
            return $this->eliminar($this->input->post('inIdAfiliacion'));
        } else {
            $this->obtenerAfiliacionErroresDatos();
            return $this->errores;
        }
    }

    public function validarAfiliacionDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'crear':
                $this->form_validation->set_rules('inIdPaciente', 'id', 'trim|required');
                $this->form_validation->set_rules('inIdPlanMedicinaPrepagada', 'plan medicina prepagada', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'eliminar':
                $this->form_validation->set_rules('inIdAfiliacion', 'id', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    public function obtenerAfiliacionErroresDatos() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
    }

    private function crear($idPaciente, $idPlanMedicinaPrepagada) {
        $this->load->model('PlanMedicinaPrepagadaModel');
        $planeMedicinaPrepagada = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaPorIdPlanMedicinaPrepagada($idPlanMedicinaPrepagada);
        $planMedicinaPrepagadaBeneficios = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaBeneficiosPorIdPlanMedicinaPrepagada($idPlanMedicinaPrepagada);
        $this->db->trans_start();
        $this->db->set(ID_PLAN_MEDICINA_PREPAGADA, $idPlanMedicinaPrepagada);
        $this->db->set(ID_PACIENTE, $idPaciente);
        $this->db->set(FECHA_INICIO_AFILIACION, date('Y-m-d'));
        $this->db->set(FECHA_FIN_AFILIACION, $this->calcularDuracionAfiliacion(date('Y-m-d'), $planeMedicinaPrepagada[DURACION_PLAN_MEDICINA_PREPAGADA]));
        $this->db->insert(TBL_AFILIACIONES);
        $this->id = $this->db->insert_id();
        foreach ($planMedicinaPrepagadaBeneficios as $beneficio) {
            $this->db->set(ID_AFILIACION, $this->id);
            $this->db->set(NOMBRE_BENEFICIO, $beneficio[NOMBRE_BENEFICIO]);
            $this->db->set(CANTIDAD_BENEFICIO, $beneficio[CANTIDAD_BENEFICIO]);
            $this->db->insert(TBL_AFILIACIONES_BENEFICIOS);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    private function calcularDuracionAfiliacion($fecha, $cantidad) {
        return date('Y-m-d', strtotime($fecha . ' +' . $cantidad . ' month'));
    }

    public function obtenerAfiliacionesPorIdPaciente($idPaciente) {
        $this->db->select(TODO);
        $this->db->from(TBL_AFILIACIONES);
        $this->db->where(ID_PACIENTE, $idPaciente);
        $this->db->where(ESTADO_AFILIACION, 'ACTIVO');
        $this->db->order_by(ID_AFILIACION, "desc");
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function obtenerAfiliacionPorIdAfiliacion($idAfiliacion) {
        $this->db->select(TODO);
        $this->db->from(TBL_AFILIACIONES);
        $this->db->where(ID_AFILIACION, $idAfiliacion);
        $this->db->where(ESTADO_AFILIACION, 'ACTIVO');
        $this->db->order_by(ID_AFILIACION, "desc");
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obetenerAfiliacionesBeneficiosPorIdPaciente($idPaciente) {
        $this->db->select(TBL_AFILIACIONES_BENEFICIOS . '.' . TODO);
        $this->db->from(TBL_AFILIACIONES);
        $this->db->join(TBL_AFILIACIONES_BENEFICIOS, TBL_AFILIACIONES . '.' . ID_AFILIACION . '=' . TBL_AFILIACIONES_BENEFICIOS . '.' . ID_AFILIACION);
        $this->db->where(ID_PACIENTE, $idPaciente);
        $this->db->where(ESTADO_AFILIACION, 'ACTIVO');
        $this->db->order_by(TBL_AFILIACIONES_BENEFICIOS . '.' . ID_AFILIACION_BENEFICIO, "desc");
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function eliminar($idAfiliacion) {
        $this->db->trans_start();
        $this->db->set(ESTADO_AFILIACION, 'ELIMINADO');
        $this->db->where(ID_AFILIACION, $idAfiliacion);
        $this->db->where(ESTADO_AFILIACION, 'ACTIVO');
        $this->db->update(TBL_AFILIACIONES);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function aumentarCantidadBeneficioUsado($idAfiliacionBeneficio) {
        $this->db->trans_start();
        $this->db->set(USADO_BENEFICIO, USADO_BENEFICIO . '+1', false);
        $this->db->where(ID_AFILIACION_BENEFICIO, $idAfiliacionBeneficio);
        $this->db->update(TBL_AFILIACIONES_BENEFICIOS);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function disminuirCantidadBeneficioUsado($idAfiliacionBeneficio) {
        $this->db->trans_start();
        $this->db->set(USADO_BENEFICIO, USADO_BENEFICIO . '-1', false);
        $this->db->where(ID_AFILIACION_BENEFICIO, $idAfiliacionBeneficio);
        $this->db->update(TBL_AFILIACIONES_BENEFICIOS);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

}
