<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PacienteModel');
            $respuesta = $this->PacienteModel->crearPaciente($this->input->post('inIdPropietario'));
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function modificar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PacienteModel');
            $respuesta = $this->PacienteModel->modificarPaciente();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function eliminar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PacienteModel');
            $respuesta = $this->PacienteModel->eliminarPaciente();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function obtenerModal() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            switch ($this->input->post('operacion')) {
                case 'crear':
                    $this->load->model('PropietarioModel');
                    $informacionPagina['propietario'] = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($this->input->post('inIdPropietario'));
                    $this->load->view('paciente/crear', $informacionPagina);
                    break;
                case 'modificar':
                    $this->load->model('PacienteModel');
                    $informacionPagina['paciente'] = $this->PacienteModel->obtenerPacientePorIdPaciente($this->input->post('inIdPaciente'));
                    $this->load->view('paciente/modificar', $informacionPagina);
                    break;
                case 'eliminar':
                    $this->load->model('PacienteModel');
                    $informacionPagina['paciente'] = $this->PacienteModel->obtenerPacientePorIdPaciente($this->input->post('inIdPaciente'));
                    $this->load->view('paciente/eliminar', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

}
