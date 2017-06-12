<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HistoriaClinica extends CI_Controller {

    public function modificar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('HistoriaClinicaModel');
            $respuesta = $this->HistoriaClinicaModel->modificarHistoriaClinica();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function nuevas() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $pacientes = empty($this->session->tempdata('historiasClinicas')) ? null : $this->session->tempdata('historiasClinicas');
            $this->session->set_tempdata('historiasClinicas', null, 60);
            echo json_encode($pacientes);
        } else {
            redirect('');
        }
    }

    public function index($idHistoriaClinica) {
        if ($this->session->has_userdata(SESION)) {
            if ($this->input->is_ajax_request()) {
                $this->load->model('TablaModel');
                $this->load->model('ConsultaModel');
                $campoFiltro = $this->input->post('inCampoFiltro');
                $valorFiltro = $this->input->post('inValorFiltro');
                $filtro = $this->input->post('inFiltro');
                $pagina = empty($this->input->post('inPagina')) ? 0 : $this->input->post('inPagina');
                $informacionTabla = $this->TablaModel->historiaClinica;
                $registrosTabla = $this->ConsultaModel->obtenerConsultasPaginaPorIdHistoriaClinica($idHistoriaClinica, $pagina, $campoFiltro, $valorFiltro);
                $paginas = $this->ConsultaModel->obtenerConsultasCantidadPaginasPorIdHistoriaClinica($idHistoriaClinica, $campoFiltro, $valorFiltro);
                $url = base_url('HistoriaClinica/' . $idHistoriaClinica);
                $urlDestino = null;
                $contenedor = $this->input->post('inContenedor');
                $tipo = null;
                if (!empty($campoFiltro) && !empty($valorFiltro)) {
                    $tipo = 'filtro';
                }
                $respuesta['tabla'] = $this->TablaModel->crearTABLE($informacionTabla, $registrosTabla, $pagina, $paginas, $url, $urlDestino, $contenedor, $filtro, $tipo);
                echo json_encode($respuesta);
            } else {
                $this->load->model('PropietarioModel');
                $this->load->model('PacienteModel');
                $this->load->model('HistoriaClinicaModel');
                $this->load->model('AfiliacionModel');
                $this->load->model('PlanMedicinaPrepagadaModel');
                $informacionPagina['title'] = 'Historia Clínica';
                $informacionPagina['historiaClinica'] = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($idHistoriaClinica);
                $informacionPagina['paciente'] = $this->PacienteModel->obtenerPacientePorIdPaciente($informacionPagina['historiaClinica'][ID_PACIENTE]);
                $informacionPagina['propietario'] = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($informacionPagina['paciente'][ID_PROPIETARIO]);
                $informacionPagina['propietarioNumerosContactoConcatenado'] = $this->PropietarioModel->obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($informacionPagina['propietario'][ID_PROPIETARIO]);
                $informacionPagina['afiliaciones'] = $this->AfiliacionModel->obtenerAfiliacionesPorIdPaciente($informacionPagina['paciente'][ID_PACIENTE]);
                $informacionPagina['afiliacionesBeneficios'] = $this->AfiliacionModel->obetenerAfiliacionesBeneficiosPorIdPaciente($informacionPagina['paciente'][ID_PACIENTE]);
                $planesMedicinaPrepagada = $this->PlanMedicinaPrepagadaModel->obtenerPlanesMedicinaPrepagada();
                $informacionPagina['regresar'] = base_url('Cliente');
                $this->load->view('template/abrirHtml', $informacionPagina);
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('template/header');
                $this->load->view('cliente/detalle');
                $this->load->view('historiaclinica/detalle');
                if (!empty($planesMedicinaPrepagada)) {
                    $this->load->view('afiliacion/index');
                }
                $this->load->view('historiaclinica/index');
                $this->load->view('vacuna/index');
                $this->load->view('historiaclinica/reportes');
                $this->load->view('template/modal');
                $this->load->view('template/cerrarHtml');
            }
        } else {
            redirect('');
        }
    }

    public function descargarAutorizacion($idHistoriaClinica, $cedula, $procedimiento) {
        if ($this->session->has_userdata(SESION)) {
            $this->load->model('HistoriaClinicaModel');
            $this->load->model('PacienteModel');
            $this->load->model('PropietarioModel');
            $this->load->model('ReporteModel');
            $historiaClinica = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($idHistoriaClinica);
            $paciente = $this->PacienteModel->obtenerPacientePorIdPaciente($historiaClinica[ID_PACIENTE]);
            $propietario = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($paciente[ID_PROPIETARIO]);
            $propietario['propietarioNumerosContactoConcatenado'] = $this->PropietarioModel->obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($propietario[ID_PROPIETARIO]);
            $this->ReporteModel->generarAutorizacion($propietario, $paciente, urldecode($cedula), urldecode($procedimiento));
        } else {
            redirect('');
        }
    }

    public function descargarHospitalizacion($idHistoriaClinica, $cedula) {
        if ($this->session->has_userdata(SESION)) {
            $this->load->model('HistoriaClinicaModel');
            $this->load->model('PacienteModel');
            $this->load->model('PropietarioModel');
            $this->load->model('ReporteModel');
            $historiaClinica = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($idHistoriaClinica);
            $paciente = $this->PacienteModel->obtenerPacientePorIdPaciente($historiaClinica[ID_PACIENTE]);
            $propietario = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($paciente[ID_PROPIETARIO]);
            $propietario['propietarioNumerosContactoConcatenado'] = $this->PropietarioModel->obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($propietario[ID_PROPIETARIO]);
            $this->ReporteModel->generarHospitalizacion($propietario, $paciente, urldecode($cedula));
        } else {
            redirect('');
        }
    }

    public function descargarCertificacion($idHistoriaClinica, $cedula, $contenido, $pasaporte) {
        if ($this->session->has_userdata(SESION)) {
            $this->load->model('HistoriaClinicaModel');
            $this->load->model('PacienteModel');
            $this->load->model('PropietarioModel');
            $this->load->model('ReporteModel');
            $historiaClinica = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($idHistoriaClinica);
            $paciente = $this->PacienteModel->obtenerPacientePorIdPaciente($historiaClinica[ID_PACIENTE]);
            $propietario = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($paciente[ID_PROPIETARIO]);
            $propietario['propietarioNumerosContactoConcatenado'] = $this->PropietarioModel->obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($propietario[ID_PROPIETARIO]);
            $this->ReporteModel->generarCertificacion($propietario, $paciente, urldecode($cedula), urldecode($contenido), urldecode($pasaporte));
        } else {
            redirect('');
        }
    }

    public function descargarHistoria($idHistoriaClinica) {
        if ($this->session->has_userdata(SESION)) {
            $this->load->model('HistoriaClinicaModel');
            $this->load->model('PacienteModel');
            $this->load->model('PropietarioModel');
            $this->load->model('ReporteModel');
            $this->load->model('ConsultaModel');
            $historiaClinica = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($idHistoriaClinica);
            $paciente = $this->PacienteModel->obtenerPacientePorIdPaciente($historiaClinica[ID_PACIENTE]);
            $propietario = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($paciente[ID_PROPIETARIO]);
            $propietario['propietarioNumerosContactoConcatenado'] = $this->PropietarioModel->obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($propietario[ID_PROPIETARIO]);
            $consultas = $this->ConsultaModel->obtenerConsultasrPorIdHistoriaClinica($idHistoriaClinica);
            $this->ReporteModel->generarHistoria($propietario, $paciente, $consultas, $historiaClinica);
        } else {
            redirect('');
        }
    }

    public function obtenerModal() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            switch ($this->input->post('operacion')) {
                case 'modificar':
                    $this->load->model('HistoriaClinicaModel');
                    $informacionPagina['historiaClinica'] = $this->HistoriaClinicaModel->obtenerHistoriaClinicaPorIdHistoriaClinica($this->input->post('inIdHistoriaClinica'));
                    $this->load->view('historiaclinica/modificar', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

}
