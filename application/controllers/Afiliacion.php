<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Afiliacion extends CI_Controller {

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('AfiliacionModel');
            $respuesta = $this->AfiliacionModel->crearAfiliacion();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function eliminar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('AfiliacionModel');
            $respuesta = $this->AfiliacionModel->eliminarAfiliacion();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function aumentar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('AfiliacionModel');
            $respuesta = $this->AfiliacionModel->aumentarCantidadBeneficioUsado($this->input->post('inIdAfiliacionBeneficio'));
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function disminuir() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('AfiliacionModel');
            $respuesta = $this->AfiliacionModel->disminuirCantidadBeneficioUsado($this->input->post('inIdAfiliacionBeneficio'));
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function obtenerModal() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            switch ($this->input->post('operacion')) {
                case 'crear':
                    $this->load->model('HistoriaClinicaModel');
                    $this->load->model('PacienteModel');
                    $this->load->model('PlanMedicinaPrepagadaModel');
                    $informacionPagina['historiaClinica'] = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($this->input->post('inIdHistoriaClinica'));
                    $informacionPagina['paciente'] = $this->PacienteModel->obtenerPacientePorIdPaciente($informacionPagina['historiaClinica'][ID_PACIENTE]);
                    $informacionPagina['planesMedicinaPrepagada'] = $this->PlanMedicinaPrepagadaModel->obtenerPlanesMedicinaPrepagada();
                    $this->load->view('afiliacion/crear', $informacionPagina);
                    break;
                case 'eliminar':
                    $this->load->model('HistoriaClinicaModel');
                    $this->load->model('PacienteModel');
                    $this->load->model('PlanMedicinaPrepagadaModel');
                    $this->load->model('AfiliacionModel');
                    $informacionPagina['historiaClinica'] = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($this->input->post('inIdHistoriaClinica'));
                    $informacionPagina['paciente'] = $this->PacienteModel->obtenerPacientePorIdPaciente($this->input->post('inIdPaciente'));
                    $informacionPagina['planMedicinaPrepagada'] = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaPorIdPlanMedicinaPrepagada($this->input->post('inIdPlanMedicinaPrepagada'));
                    $informacionPagina['afiliacion'] = $this->AfiliacionModel->obtenerAfiliacionPorIdAfiliacion($this->input->post('inIdAfiliacion'));
                    $this->load->view('afiliacion/eliminar', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

}
