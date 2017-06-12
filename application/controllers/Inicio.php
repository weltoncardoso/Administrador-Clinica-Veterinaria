<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function index() {
        if ($this->session->has_userdata(SESION)) {
            $informacionPagina['title'] = 'Inicio';
            $this->load->view('template/abrirHtml', $informacionPagina);
            $this->load->view('template/head');
            $this->load->view('template/nav');
            $this->load->view('template/header');
            $this->load->view('template/modal');
            $this->load->view('template/cerrarHtml');
        } else {
            redirect('');
        }
    }

}
