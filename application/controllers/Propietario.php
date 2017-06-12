<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Propietario extends CI_Controller {

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PropietarioModel');
            $respuesta = $this->PropietarioModel->crearPropietario();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function modificar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PropietarioModel');
            $respuesta = $this->PropietarioModel->modificarPropietario();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function eliminar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('PropietarioModel');
            $respuesta = $this->PropietarioModel->eliminarPropietario();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function obtenerModal() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            switch ($this->input->post('operacion')) {
                case 'crear':
                    $this->load->view('propietario/crear');
                    break;
                case 'detalle':
                    $this->load->model('PropietarioModel');
                    $informacionPagina['propietario'] = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($this->input->post('inIdPropietario'));
                    $informacionPagina['propietarioNumerosContactoConcatenado'] = $this->PropietarioModel->obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($this->input->post('inIdPropietario'));
                    $this->load->view('propietario/detalle', $informacionPagina);
                    break;
                case 'modificar':
                    $this->load->model('PropietarioModel');
                    $informacionPagina['propietario'] = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($this->input->post('inIdPropietario'));
                    $informacionPagina['propietarioNumerosContactoConcatenado'] = $this->PropietarioModel->obtenerPropietarioNumerosContactoConcatenadoPorIdPropietario($this->input->post('inIdPropietario'));
                    $this->load->view('propietario/modificar', $informacionPagina);
                    break;
                case 'eliminar':
                    $this->load->model('PropietarioModel');
                    $informacionPagina['propietario'] = $this->PropietarioModel->obtenerPropietarioPorIdPropietario($this->input->post('inIdPropietario'));
                    $this->load->view('propietario/eliminar', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

    public function index() {
        if ($this->session->has_userdata(SESION)) {
            if ($this->input->is_ajax_request()) {
                $this->load->model('TablaModel');
                $this->load->model('PropietarioModel');
                $campoFiltro = $this->input->post('inCampoFiltro');
                $valorFiltro = $this->input->post('inValorFiltro');
                $filtro = $this->input->post('inFiltro');
                $pagina = empty($this->input->post('inPagina')) ? 0 : $this->input->post('inPagina');
                $informacionTabla = $this->TablaModel->propietario;
                $registrosTabla = $this->PropietarioModel->obtenerPropietariosPagina($pagina, $campoFiltro, $valorFiltro);
                $paginas = $this->PropietarioModel->obtenerPropietariosCantidadPaginas($campoFiltro, $valorFiltro);
                $url = base_url('Propietario');
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
                $informacionPagina['title'] = 'Clientes';
                $this->load->view('template/abrirHtml', $informacionPagina);
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('template/header');
                $this->load->view('propietario/index');
                $this->load->view('template/modal');
                $this->load->view('template/cerrarHtml');
            }
        } else {
            redirect('');
        }
    }

}
