<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('ConsultaModel');
            $respuesta = $this->ConsultaModel->crearConsulta();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function modificar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('ConsultaModel');
            $respuesta = $this->ConsultaModel->modificarConsulta();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function eliminar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('ConsultaModel');
            $respuesta = $this->ConsultaModel->eliminarConsulta();
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
                    $this->load->model('UsuarioModel');
                    $informacionPagina['historiaClinica'] = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($this->input->post('inIdHistoriaClinica'));
                    $informacionPagina['usuarios'] = $this->UsuarioModel->obtenerUsuarios();
                    $this->load->view('consulta/crear', $informacionPagina);
                    break;
                case 'detalle':
                    $this->load->model('ConsultaModel');
                    $this->load->model('UsuarioModel');
                    $informacionPagina['consulta'] = $this->ConsultaModel->obtenerConsultaPorIdConsulta($this->input->post('inIdConsulta'));
                    $informacionPagina['usuarios'] = $this->UsuarioModel->obtenerUsuarios();
                    $this->load->view('consulta/detalle', $informacionPagina);
                    break;
                case 'modificar':
                    $this->load->model('ConsultaModel');
                    $this->load->model('UsuarioModel');
                    $informacionPagina['consulta'] = $this->ConsultaModel->obtenerConsultaPorIdConsulta($this->input->post('inIdConsulta'));
                    $informacionPagina['usuarios'] = $this->UsuarioModel->obtenerUsuarios();
                    $this->load->view('consulta/modificar', $informacionPagina);
                    break;
                case 'eliminar':
                    $this->load->model('ConsultaModel');
                    $informacionPagina['consulta'] = $this->ConsultaModel->obtenerConsultaPorIdConsulta($this->input->post('inIdConsulta'));
                    $this->load->view('consulta/eliminar', $informacionPagina);
                    break;
                case 'adjunto':
                    $this->load->model('ConsultaModel');
                    $informacionPagina['consulta'] = $this->ConsultaModel->obtenerConsultaPorIdConsulta($this->input->post('inIdConsulta'));
                    $this->load->view('consulta/adjunto', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

    public function descargarReporteRecetaMedica($idConsulta) {
        if ($this->session->has_userdata(SESION)) {
            $this->load->model('ConsultaModel');
            $this->load->model('HistoriaClinicaModel');
            $this->load->model('PacienteModel');
            $this->load->model('PropietarioModel');
            $this->load->model('ReporteModel');
            $consulta = $this->ConsultaModel->obtenerConsultaPorIdConsulta($idConsulta);
            $historiaClinica = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($consulta[ID_HISTORIA_CLINICA]);
            $paciente = $this->PacienteModel->obtenerPacientePorIdPaciente($historiaClinica[ID_PACIENTE]);
            $propietario = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($paciente[ID_PROPIETARIO]);
            $this->ReporteModel->generarRecetaMedica($propietario, $paciente, $consulta);
        } else {
            redirect('');
        }
    }

}
