<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ClienteModel extends CI_Model {

    public $errores = array();

    public function __construct() {
        parent::__construct();
    }

    public function crearCliente() {
        $this->load->model('PropietarioModel');
        $this->load->model('PacienteModel');
        if ($this->PropietarioModel->validarPropietarioDatos('crear') && $this->PacienteModel->validarPacienteDatos('crear')) {
            $this->db->trans_start();
            $this->PropietarioModel->crear($this->input->post('inNombresPropietario'), $this->input->post('inApellidosPropietario'), $this->input->post('inIdentificacionPropietario'), $this->input->post('inDireccionPropietario'), $this->input->post('inCorreoElectronicoPropietario'), $this->input->post('inPropietario'));
            $this->PacienteModel->crear($this->PropietarioModel->id, $this->input->post('inPaciente'));
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('error', $this->db->error());
                return false;
            } else {
                return true;
            }
        } else {
            $this->PropietarioModel->obtenerPropietarioErroresDatos();
            $this->PacienteModel->obtenerPacienteErroresDatos();
            $this->errores = array_merge($this->PropietarioModel->errores, $this->PacienteModel->errores);
            return $this->errores;
        }
    }

    public function obtenerClientesCantidadPaginas($campoFiltro, $valorFiltro) {
        $this->db->select(''
                . '' . TBL_PROPIETARIOS . '.' . NOMBRES_PROPIETARIO . ','
                . '' . TBL_PROPIETARIOS . '.' . APELLIDOS_PROPIETARIO . ','
                . '' . TBL_PACIENTES . '.' . NOMBRE_PACIENTE . ','
                . '' . TBL_PACIENTES . '.' . ESPECIE_PACIENTE . ','
                . '' . TBL_HISTORIAS_CLINICAS . '.' . ID_HISTORIA_CLINICA);
        $this->db->from(TBL_PROPIETARIOS);
        $this->db->join(TBL_PACIENTES, TBL_PROPIETARIOS . '.' . ID_PROPIETARIO . '=' . TBL_PACIENTES . '.' . ID_PROPIETARIO);
        $this->db->join(TBL_HISTORIAS_CLINICAS, TBL_PACIENTES . '.' . ID_PACIENTE . '=' . TBL_HISTORIAS_CLINICAS . '.' . ID_PACIENTE);
        $this->db->where(ESTADO_PROPIETARIO, 'ACTIVO');
        $this->db->where(ESTADO_PACIENTE, 'ACTIVO');
        $this->db->where(ESTADO_HISTORIA_CLINICA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerClientesCampoFiltro($campoFiltro), $valorFiltro);
        }
        $resultado = $this->db->get();
        $ajuste = 0;
        if ($resultado->num_rows() % REGISTROS_POR_PAGINA == 0) {
            $ajuste = 1;
        }
        return intval($resultado->num_rows() / REGISTROS_POR_PAGINA) - $ajuste;
    }

    public function obtenerClientesPagina($pagina, $campoFiltro, $valorFiltro) {
        $this->db->select(''
                . '' . TBL_PROPIETARIOS . '.' . ID_PROPIETARIO . ','
                . '' . TBL_PROPIETARIOS . '.' . NOMBRES_PROPIETARIO . ','
                . '' . TBL_PROPIETARIOS . '.' . APELLIDOS_PROPIETARIO . ','
                . '' . TBL_PACIENTES . '.' . ID_PACIENTE . ','
                . '' . TBL_PACIENTES . '.' . NOMBRE_PACIENTE . ','
                . '' . TBL_PACIENTES . '.' . ESPECIE_PACIENTE . ','
                . '' . TBL_HISTORIAS_CLINICAS . '.' . ID_HISTORIA_CLINICA);
        $this->db->from(TBL_PROPIETARIOS);
        $this->db->join(TBL_PACIENTES, TBL_PROPIETARIOS . '.' . ID_PROPIETARIO . '=' . TBL_PACIENTES . '.' . ID_PROPIETARIO);
        $this->db->join(TBL_HISTORIAS_CLINICAS, TBL_PACIENTES . '.' . ID_PACIENTE . '=' . TBL_HISTORIAS_CLINICAS . '.' . ID_PACIENTE);
        $this->db->where(ESTADO_PROPIETARIO, 'ACTIVO');
        $this->db->where(ESTADO_PACIENTE, 'ACTIVO');
        $this->db->where(ESTADO_HISTORIA_CLINICA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerClientesCampoFiltro($campoFiltro), $valorFiltro);
        }
        $this->db->limit(REGISTROS_POR_PAGINA, empty($pagina) ? 0 : $pagina * REGISTROS_POR_PAGINA);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    private function obtenerClientesCampoFiltro($campoFiltro) {
        switch ($campoFiltro) {
            case 1:
                return TBL_PROPIETARIOS . '.' . ID_PROPIETARIO;
            case 2:
                return TBL_PROPIETARIOS . '.' . NOMBRES_PROPIETARIO;
            case 3:
                return TBL_PROPIETARIOS . '.' . APELLIDOS_PROPIETARIO;
            case 4:
                return TBL_PACIENTES . '.' . ID_PACIENTE;
            case 5:
                return TBL_PACIENTES . '.' . NOMBRE_PACIENTE;
            case 6:
                return TBL_HISTORIAS_CLINICAS . '.' . ID_HISTORIA_CLINICA;
        }
    }

}
