<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PlanMedicinaPrepagada extends CI_Controller {

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PlanMedicinaPrepagadaModel');
            $respuesta = $this->PlanMedicinaPrepagadaModel->crearPlanMedicinaPrepagada();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function modificar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PlanMedicinaPrepagadaModel');
            $respuesta = $this->PlanMedicinaPrepagadaModel->modificarPlanMedicinaPrepagada();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function eliminar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PlanMedicinaPrepagadaModel');
            $respuesta = $this->PlanMedicinaPrepagadaModel->eliminarPlanMedicinaPrepagada();
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

    public function index() {
        if ($this->session->has_userdata(SESION)) {
            if ($this->input->is_ajax_request()) {
                $this->load->model('TablaModel');
                $this->load->model('PlanMedicinaPrepagadaModel');
                $campoFiltro = $this->input->post('inCampoFiltro');
                $valorFiltro = $this->input->post('inValorFiltro');
                $filtro = $this->input->post('inFiltro');
                $pagina = empty($this->input->post('inPagina')) ? 0 : $this->input->post('inPagina');
                $informacionTabla = $this->TablaModel->planMedicinaPrepagada;
                $registrosTabla = $this->PlanMedicinaPrepagadaModel->obtenerPlanesMedicinaPrepagadaPagina($pagina, $campoFiltro, $valorFiltro);
                $paginas = $this->PlanMedicinaPrepagadaModel->obtenerPlanesMedicinaPrepagadaCantidadPaginas($campoFiltro, $valorFiltro);
                $url = base_url('PlanMedicinaPrepagada');
                $urlDestino = null;
                $contenedor = $this->input->post('inContenedor');
                $tipo = null;
                if (!empty($campoFiltro) && !empty($valorFiltro)) {
                    $tipo = 'filtro';
                }
                $respuesta['tabla'] = $this->TablaModel->crearTABLE($informacionTabla, $registrosTabla, $pagina, $paginas, $url, $urlDestino, $contenedor, $filtro, $tipo);
                echo json_encode($respuesta);
            } else {
                $this->load->model('TablaModel');
                $this->load->model('ClienteModel');
                $informacionPagina['title'] = 'Planes Medicina Prepagada';
                $this->load->view('template/abrirHtml', $informacionPagina);
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('template/header');
                $this->load->view('planmedicinaprepagada/index');
                $this->load->view('template/modal');
                $this->load->view('template/cerrarHtml');
            }
        } else {
            redirect('');
        }
    }

    public function obtenerModal() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            switch ($this->input->post('operacion')) {
                case 'detalle':
                    $this->load->model('PlanMedicinaPrepagadaModel');
                    $informacionPagina['planMedicinaPrepagada'] = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaPorIdPlanMedicinaPrepagada($this->input->post('inIdPlanMedicinaPrepagada'));
                    $informacionPagina['planMedicinaPrepagadaBeneficios'] = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaBeneficiosPorIdPlanMedicinaPrepagada($this->input->post('inIdPlanMedicinaPrepagada'));
                    $this->load->view('planmedicinaprepagada/detalle', $informacionPagina);
                    break;
                case 'crear':
                    $this->load->view('planmedicinaprepagada/crear');
                    break;
                case 'modificar':
                    $this->load->model('PlanMedicinaPrepagadaModel');
                    $informacionPagina['planMedicinaPrepagada'] = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaPorIdPlanMedicinaPrepagada($this->input->post('inIdPlanMedicinaPrepagada'));
                    $informacionPagina['planMedicinaPrepagadaBeneficios'] = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaBeneficiosPorIdPlanMedicinaPrepagada($this->input->post('inIdPlanMedicinaPrepagada'));
                    $this->load->view('planmedicinaprepagada/modificar', $informacionPagina);
                    break;
                case 'eliminar':
                    $this->load->model('PlanMedicinaPrepagadaModel');
                    $informacionPagina['planMedicinaPrepagada'] = $this->PlanMedicinaPrepagadaModel->obtenerPlanMedicinaPrepagadaPorIdPlanMedicinaPrepagada($this->input->post('inIdPlanMedicinaPrepagada'));
                    $this->load->view('planmedicinaprepagada/eliminar', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

}
