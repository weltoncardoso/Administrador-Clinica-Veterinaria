<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('ClienteModel');
            $respuesta = $this->ClienteModel->crearCliente();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function index() {
        if ($this->session->has_userdata(SESION)) {
            if ($this->input->is_ajax_request()) {
                $this->load->model('TablaModel');
                $this->load->model('ClienteModel');
                $campoFiltro = $this->input->post('inCampoFiltro');
                $valorFiltro = $this->input->post('inValorFiltro');
                $filtro = $this->input->post('inFiltro');
                $pagina = empty($this->input->post('inPagina')) ? 0 : $this->input->post('inPagina');
                $informacionTabla = $this->TablaModel->cliente;
                $registrosTabla = $this->ClienteModel->obtenerClientesPagina($pagina, $campoFiltro, $valorFiltro);
                $paginas = $this->ClienteModel->obtenerClientesCantidadPaginas($campoFiltro, $valorFiltro);
                $url = base_url('Cliente');
                $urlDestino = base_url('HistoriaClinica');
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
                $informacionPagina['title'] = 'Clientes';
                $this->load->view('template/abrirHtml', $informacionPagina);
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('template/header');
                $this->load->view('cliente/index');
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
                case 'crear':
                    $this->load->view('cliente/crear');
                    break;
            }
        } else {
            redirect('');
        }
    }

}
