<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PlanMedicinaPrepagadaModel extends CI_Model {

    public $errores = array();
    public $id;

    public function __construct() {
        parent::__construct();
    }

    public function obtenerPlanesMedicinaPrepagadaPagina($pagina, $campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_PLANES_MEDICINA_PREPAGADA);
        $this->db->where(ESTADO_PLAN_MEDICINA_PREPAGADA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerPlanesMedicinaPrepagadaCampoFiltro($campoFiltro), $valorFiltro);
        }
        $this->db->limit(REGISTROS_POR_PAGINA, empty($pagina) ? 0 : $pagina * REGISTROS_POR_PAGINA);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function obtenerPlanesMedicinaPrepagadaCantidadPaginas($campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_PLANES_MEDICINA_PREPAGADA);
        $this->db->where(ESTADO_PLAN_MEDICINA_PREPAGADA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerPlanesMedicinaPrepagadaCampoFiltro($campoFiltro), $valorFiltro);
        }
        $resultado = $this->db->get();
        $ajuste = 0;
        if ($resultado->num_rows() % REGISTROS_POR_PAGINA == 0) {
            $ajuste = 1;
        }
        return intval($resultado->num_rows() / REGISTROS_POR_PAGINA) - $ajuste;
    }

    private function obtenerPlanesMedicinaPrepagadaCampoFiltro($campoFiltro) {
        switch ($campoFiltro) {
            case 1:
                return TBL_PLANES_MEDICINA_PREPAGADA . '.' . ID_PLAN_MEDICINA_PREPAGADA;
            case 2:
                return TBL_PLANES_MEDICINA_PREPAGADA . '.' . NOMBRE_PLAN_MEDICINA_PREPAGADA;
        }
    }

    public function crearPlanMedicinaPrepagada() {
        if ($this->validarPlanMedicinaPrepagadaDatos('crear')) {
            return $this->crear($this->input->post('inNombrePlanMedicinaPrepagada'), $this->input->post('inDescripcionPlanMedicinaPrepagada'), $this->input->post('inDuracionPlanMedicinaPrepagada'), $this->input->post('inBeneficio'));
        } else {
            $this->obtenerPlanMedicinaPrepagadaErroresDatos();
            return $this->errores;
        }
    }

    public function modificarPlanMedicinaPrepagada() {
        if ($this->validarPlanMedicinaPrepagadaDatos('modificar')) {
            return $this->modificar($this->input->post('inIdPlanMedicinaPrepagada'), $this->input->post('inNombrePlanMedicinaPrepagada'), $this->input->post('inDescripcionPlanMedicinaPrepagada'), $this->input->post('inDuracionPlanMedicinaPrepagada'), $this->input->post('inBeneficio'));
        } else {
            $this->obtenerPlanMedicinaPrepagadaErroresDatos();
            return $this->errores;
        }
    }

    public function eliminarPlanMedicinaPrepagada() {
        if ($this->validarPlanMedicinaPrepagadaDatos('eliminar')) {
            return $this->eliminar($this->input->post('inIdPlanMedicinaPrepagada'));
        } else {
            $this->obtenerPlanMedicinaPrepagadaErroresDatos();
            return $this->errores;
        }
    }

    public function validarPlanMedicinaPrepagadaDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'crear':
                $this->form_validation->set_rules('inNombrePlanMedicinaPrepagada', 'nombre', 'trim|required');
                $this->form_validation->set_rules('inDuracionPlanMedicinaPrepagada', 'duración', 'trim|required');
                foreach ($this->input->post('inBeneficio') as $indice => $campo) {
                    $this->form_validation->set_rules('inBeneficio[' . $indice . '][nombre]', 'nombre beneficio', 'trim|required');
                    $this->form_validation->set_rules('inBeneficio[' . $indice . '][cantidad]', 'cantidad beneficio', 'trim|required');
                }
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'modificar':
                $this->form_validation->set_rules('inIdPlanMedicinaPrepagada', 'id', 'trim|required');
                $this->form_validation->set_rules('inNombrePlanMedicinaPrepagada', 'nombre', 'trim|required');
                $this->form_validation->set_rules('inDuracionPlanMedicinaPrepagada', 'duración', 'trim|required');
                foreach ($this->input->post('inBeneficio') as $indice => $campo) {
                    $this->form_validation->set_rules('inBeneficio[' . $indice . '][nombre]', 'nombre beneficio', 'trim|required');
                    $this->form_validation->set_rules('inBeneficio[' . $indice . '][cantidad]', 'cantidad beneficio', 'trim|required');
                }
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'eliminar':
                $this->form_validation->set_rules('inIdPlanMedicinaPrepagada', 'id', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    private function modificar($inIdPlanMedicinaPrepagada, $nombrePlanMedicinaPrepagada, $descripcionPlanMedicinaPrepagada, $duracionPlanMedicinaPrepagada, $beneficiosPlanMedicinaPrepagada) {
        $this->db->trans_start();
        $this->db->set(NOMBRE_PLAN_MEDICINA_PREPAGADA, $nombrePlanMedicinaPrepagada);
        $this->db->set(DESCRIPCION_PLAN_MEDICINA_PREPAGADA, $descripcionPlanMedicinaPrepagada);
        $this->db->set(DURACION_PLAN_MEDICINA_PREPAGADA, $duracionPlanMedicinaPrepagada);
        $this->db->where(ID_PLAN_MEDICINA_PREPAGADA, $inIdPlanMedicinaPrepagada);
        $this->db->update(TBL_PLANES_MEDICINA_PREPAGADA);
        $this->db->where(ID_PLAN_MEDICINA_PREPAGADA, $inIdPlanMedicinaPrepagada);
        $this->db->delete(TBL_PLANES_MEDICINA_PREPAGADA_BENEFICIOS);
        foreach ($beneficiosPlanMedicinaPrepagada as $campo) {
            $this->db->set(ID_PLAN_MEDICINA_PREPAGADA, $inIdPlanMedicinaPrepagada);
            $this->db->set(NOMBRE_BENEFICIO, $campo['nombre']);
            $this->db->set(CANTIDAD_BENEFICIO, $campo['cantidad']);
            $this->db->insert(TBL_PLANES_MEDICINA_PREPAGADA_BENEFICIOS);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    private function crear($nombrePlanMedicinaPrepagada, $descripcionPlanMedicinaPrepagada, $duracionPlanMedicinaPrepagada, $beneficiosPlanMedicinaPrepagada) {
        $this->db->trans_start();
        $this->db->set(NOMBRE_PLAN_MEDICINA_PREPAGADA, $nombrePlanMedicinaPrepagada);
        $this->db->set(DESCRIPCION_PLAN_MEDICINA_PREPAGADA, $descripcionPlanMedicinaPrepagada);
        $this->db->set(DURACION_PLAN_MEDICINA_PREPAGADA, $duracionPlanMedicinaPrepagada);
        $this->db->insert(TBL_PLANES_MEDICINA_PREPAGADA);
        $this->id = $this->db->insert_id();
        foreach ($beneficiosPlanMedicinaPrepagada as $campo) {
            $this->db->set(ID_PLAN_MEDICINA_PREPAGADA, $this->id);
            $this->db->set(NOMBRE_BENEFICIO, $campo['nombre']);
            $this->db->set(CANTIDAD_BENEFICIO, $campo['cantidad']);
            $this->db->insert(TBL_PLANES_MEDICINA_PREPAGADA_BENEFICIOS);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    private function eliminar($idPlanMedicinaPrepagada) {
        $this->db->trans_start();
        $this->db->set(ESTADO_PLAN_MEDICINA_PREPAGADA, 'ELIMINADO');
        $this->db->where(ID_PLAN_MEDICINA_PREPAGADA, $idPlanMedicinaPrepagada);
        $this->db->where(ESTADO_PLAN_MEDICINA_PREPAGADA, 'ACTIVO');
        $this->db->update(TBL_PLANES_MEDICINA_PREPAGADA);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function obtenerPlanMedicinaPrepagadaErroresDatos() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
        foreach ($this->input->post('inBeneficio') as $indice => $campo) {
            (form_error('inBeneficio[' . $indice . '][nombre]') != null) ? array_push($this->errores, array(
                                'campo' => 'inNombreBeneficio' . $indice,
                                'mensaje' => strip_tags(form_error('inBeneficio[' . $indice . '][nombre]')),
                                'valor' => $campo['nombre']
                            )) : null;
            (form_error('inBeneficio[' . $indice . '][cantidad]') != null) ? array_push($this->errores, array(
                                'campo' => 'inCantidadBeneficio' . $indice,
                                'mensaje' => strip_tags(form_error('inBeneficio[' . $indice . '][cantidad]')),
                                'valor' => $campo['cantidad']
                            )) : null;
        }
    }

    public function obtenerPlanMedicinaPrepagadaPorIdPlanMedicinaPrepagada($idPlanMedicinaPrepagada) {
        $this->db->select(TODO);
        $this->db->from(TBL_PLANES_MEDICINA_PREPAGADA);
        $this->db->where(ID_PLAN_MEDICINA_PREPAGADA, $idPlanMedicinaPrepagada);
        $this->db->where(ESTADO_PLAN_MEDICINA_PREPAGADA, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obtenerPlanMedicinaPrepagadaBeneficiosPorIdPlanMedicinaPrepagada($idPlanMedicinaPrepagada) {
        $this->db->select(TODO);
        $this->db->from(TBL_PLANES_MEDICINA_PREPAGADA_BENEFICIOS);
        $this->db->where(ID_PLAN_MEDICINA_PREPAGADA, $idPlanMedicinaPrepagada);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }
    
    public function obtenerPlanesMedicinaPrepagada() {
        $this->db->select(TODO);
        $this->db->from(TBL_PLANES_MEDICINA_PREPAGADA);
        $this->db->where(ESTADO_PLAN_MEDICINA_PREPAGADA, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

}
