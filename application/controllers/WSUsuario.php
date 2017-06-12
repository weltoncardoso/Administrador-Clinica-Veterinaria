<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class WSUsuario extends REST_Controller {

    public function ingresar_get($usuario, $contrasena) {
        //if ($this->input->is_ajax_request()) {
            $this->load->model('UsuarioModel');
            $respuesta['respuesta'] = $this->UsuarioModel->ingresar($usuario, $contrasena);
            if ($respuesta['respuesta']) {
                $respuesta['usuario'] = $this->UsuarioModel->obtenerUsuarioPorUsuarioUsuario($usuario);
            }
            $this->response(json_encode($respuesta));
        //}
    }

}
