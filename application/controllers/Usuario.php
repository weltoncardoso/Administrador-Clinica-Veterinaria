<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function crear() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('UsuarioModel');
            $respuesta = $this->UsuarioModel->crearUsuario();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function modificar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('UsuarioModel');
            $respuesta = $this->UsuarioModel->modificarUsuario();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function eliminar() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            $this->load->model('UsuarioModel');
            $respuesta = $this->UsuarioModel->eliminarUsuario();
            echo json_encode($respuesta);
        } else {
            redirect('');
        }
    }

    public function obtenerModal() {
        if ($this->session->has_userdata(SESION) && $this->input->is_ajax_request()) {
            switch ($this->input->post('operacion')) {
                case 'crear':
                    $this->load->view('usuario/crear');
                    break;
                case 'detalle':
                    $this->load->model('UsuarioModel');
                    $informacionPagina['usuario'] = $this->UsuarioModel->obtenerUsuarioPorIdUsuario($this->input->post('inIdUsuario'));
                    $this->load->view('usuario/detalle', $informacionPagina);
                    break;
                case 'modificar':
                    $this->load->model('UsuarioModel');
                    $informacionPagina['usuario'] = $this->UsuarioModel->obtenerUsuarioPorIdUsuario($this->input->post('inIdUsuario'));
                    $this->load->view('usuario/modificar', $informacionPagina);
                    break;
                case 'eliminar':
                    $this->load->model('UsuarioModel');
                    $informacionPagina['usuario'] = $this->UsuarioModel->obtenerUsuarioPorIdUsuario($this->input->post('inIdUsuario'));
                    $this->load->view('usuario/eliminar', $informacionPagina);
                    break;
            }
        } else {
            redirect('');
        }
    }

    public function ingresar() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('UsuarioModel');
            $respuesta = $this->UsuarioModel->ingresarUsuario();
            echo json_encode($respuesta);
        } else {
            if ($this->session->has_userdata(SESION)) {
                redirect('Cliente');
            } else {
                $informacionPagina['title'] = 'Ingresar';
                $this->load->view('template/abrirHtml', $informacionPagina);
                $this->load->view('template/head');
                $this->load->view('template/header');
                $this->load->view('usuario/ingresar');
                $this->load->view('template/modal');
                $this->load->view('template/cerrarHtml');
            }
        }
    }

    public function salir() {
        $this->load->model('UsuarioModel');
        $this->UsuarioModel->salirUsuario();
        redirect('');
    }

    public function index() {
        if ($this->session->has_userdata(SESION)) {
            if ($this->input->is_ajax_request()) {
                $this->load->model('TablaModel');
                $this->load->model('UsuarioModel');
                $campoFiltro = $this->input->post('inCampoFiltro');
                $valorFiltro = $this->input->post('inValorFiltro');
                $filtro = $this->input->post('inFiltro');
                $pagina = empty($this->input->post('inPagina')) ? 0 : $this->input->post('inPagina');
                $informacionTabla = $this->TablaModel->usuario;
                $registrosTabla = $this->UsuarioModel->obtenerUsuariosPagina($pagina, $campoFiltro, $valorFiltro);
                $paginas = $this->UsuarioModel->obtenerUsuariosCantidadPaginas($campoFiltro, $valorFiltro);
                $url = base_url('Usuario');
                $urlDestino = null;
                $contenedor = $this->input->post('inContenedor');
                $tipo = null;
                if (!empty($campoFiltro) && !empty($valorFiltro)) {
                    $tipo = 'filtro';
                }
                $respuesta['tabla'] = $this->TablaModel->crearTABLE($informacionTabla, $registrosTabla, $pagina, $paginas, $url, $urlDestino, $contenedor, $filtro, $tipo);
                echo json_encode($respuesta);
            } else {
                $informacionPagina['title'] = 'Usuarios';
                $this->load->view('template/abrirHtml', $informacionPagina);
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('template/header');
                $this->load->view('usuario/index');
                $this->load->view('template/modal');
                $this->load->view('template/cerrarHtml');
            }
        } else {
            redirect('');
        }
    }

}
