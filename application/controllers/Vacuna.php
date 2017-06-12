<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vacuna extends CI_Controller {

    public function index($idPaciente) {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('TablaModel');
            $this->load->model('VacunaModel');
            $campoFiltro = $this->input->post('inCampoFiltro');
            $valorFiltro = $this->input->post('inValorFiltro');
            $filtro = $this->input->post('inFiltro');
            $pagina = empty($this->input->post('inPagina')) ? 0 : $this->input->post('inPagina');
            $informacionTabla = $this->TablaModel->vacuna;
            $registrosTabla = $this->VacunaModel->obtenerVacunasPaginaPorIdPaciente($idPaciente, $pagina, $campoFiltro, $valorFiltro);
            $paginas = $this->VacunaModel->obtenerVacunasCantidadPaginasPorIdPaciente($idPaciente, $campoFiltro, $valorFiltro);
            $url = base_url('Vacuna/' . $idPaciente);
            $urlDestino = null;
            $contenedor = $this->input->post('inContenedor');
            $tipo = null;
            if (!empty($campoFiltro) && !empty($valorFiltro)) {
                $tipo = 'filtro';
            }
            $respuesta['tabla'] = $this->TablaModel->crearTABLE($informacionTabla, $registrosTabla, $pagina, $paginas, $url, $urlDestino, $contenedor, $filtro, $tipo);
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('VacunaModel');
            $respuesta = $this->VacunaModel->crearVacuna();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function modificar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('VacunaModel');
            $respuesta = $this->VacunaModel->modificarVacuna();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function eliminar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('VacunaModel');
            $respuesta = $this->VacunaModel->eliminarVacuna();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function calcularProximaFechaVacuna() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('VacunaModel');
            echo json_encode($this->VacunaModel->calcularProximaFechaVacuna($this->input->post('inFechaVacuna'), $this->input->post('tiempo'), $this->input->post('cantidad')));
        } else {
            redirect('');
        }
    }

    public function enviarRecordatorioVacuna() {
        $sql = "select nombres_propietario, apellidos_propietario, correo_electronico_propietario, nombre_paciente, proxima_vacuna, tipo_vacuna "
                . "from tbl_vacunas "
                . "left join tbl_pacientes on tbl_vacunas.id_paciente = tbl_pacientes.id_paciente "
                . "left join tbl_propietarios on tbl_propietarios.id_propietario = tbl_pacientes.id_propietario "
                . "where estado_vacuna = 'ACTIVO' "
                . "and estado_propietario = 'ACTIVO' "
                . "and estado_paciente = 'ACTIVO' "
                . "and (proxima_vacuna = '" . (date('Y-m-d', strtotime(date('Y-m-d') . ' -8 day '))) . "' "
                . "or proxima_vacuna = '" . date('Y-m-d') . "')";
        $resultado = $this->db->query($sql);
        foreach ($resultado->result_array() as $registro) {
            $this->load->model('VacunaModel');
            $this->VacunaModel->enviarRecordatorioVacuna($registro[CORREO_ELECTRONICO_PROPIETARIO], $registro[TIPO_VACUNA], $registro[NOMBRES_PROPIETARIO] . ' ' . $registro[APELLIDOS_PROPIETARIO], $registro[NOMBRE_PACIENTE], $registro[PROXIMA_VACUNA]);
        }
    }

    public function obtenerModal() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            switch ($this->input->post('operacion')) {
                case 'crear':
                    $this->load->model('PacienteModel');
                    $informacionPagina['paciente'] = $this->PacienteModel->obtenerPacientePorIdPaciente($this->input->post('inIdPaciente'));
                    $this->load->view('vacuna/crear', $informacionPagina);
                    break;
                case 'modificar':
                    $this->load->model('VacunaModel');
                    $informacionPagina['vacuna'] = $this->VacunaModel->obtenerVacunaPorIdVacuna($this->input->post('inIdVacuna'));
                    $this->load->view('vacuna/modificar', $informacionPagina);
                    break;
                case 'eliminar':
                    $this->load->model('VacunaModel');
                    $informacionPagina['vacuna'] = $this->VacunaModel->obtenerVacunaPorIdVacuna($this->input->post('inIdVacuna'));
                    $this->load->view('vacuna/eliminar', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

}
