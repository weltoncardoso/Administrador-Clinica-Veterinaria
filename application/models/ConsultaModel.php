<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ConsultaModel extends CI_Model {

    public $errores = array();
    public $id;

    public function __construct() {
        parent::__construct();
    }

    public function crearConsulta() {
        if ($this->validarConsultaDatos('crear')) {
            return $this->crear($this->input->post('inIdHistoriaClinica'), $this->input->post('inUsuarioConsulta'), $this->input->post('inAnamnesisConsulta'), $this->input->post('inPConsulta'), $this->input->post('inTConsulta'), $this->input->post('inFCConsulta'), $this->input->post('inFRConsulta'), $this->input->post('inExamenClinicoConsulta'), $this->input->post('inRecetaMedicaConsulta'), $this->input->post('inFechaConsulta'));
        } else {
            $this->obtenerConsultaErroresDatos();
            return $this->errores;
        }
    }

    public function modificarConsulta() {
        if ($this->validarConsultaDatos('modificar')) {
            return $this->modificar($this->input->post('inIdConsulta'), $this->input->post('inUsuarioConsulta'), $this->input->post('inAnamnesisConsulta'), $this->input->post('inPConsulta'), $this->input->post('inTConsulta'), $this->input->post('inFCConsulta'), $this->input->post('inFRConsulta'), $this->input->post('inExamenClinicoConsulta'), $this->input->post('inRecetaMedicaConsulta'), $this->input->post('inFechaConsulta'));
        } else {
            $this->obtenerConsultaErroresDatos();
            return $this->errores;
        }
    }

    public function eliminarConsulta() {
        if ($this->validarConsultaDatos('eliminar')) {
            return $this->eliminar($this->input->post('inIdConsulta'));
        } else {
            $this->obtenerConsultaErroresDatos();
            return $this->errores;
        }
    }

    public function validarConsultaDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'crear':
                $this->form_validation->set_rules('inIdHistoriaClinica', 'id', 'trim|required');
                $this->form_validation->set_rules('inAnamnesisConsulta', 'anamnesis', 'trim|required');
                $this->form_validation->set_rules('inUsuarioConsulta', 'usuario', 'trim|required');
                //$this->form_validation->set_rules('inPConsulta', 'peso', 'trim|required');
                //$this->form_validation->set_rules('inTConsulta', 'temperatura', 'trim|required');
                //$this->form_validation->set_rules('inFCConsulta', 'frec. cardiaca', 'trim|required');
                //$this->form_validation->set_rules('inFRConsulta', 'frec. respiratoria', 'trim|required');
                $this->form_validation->set_rules('inExamenClinicoConsulta', 'exámen clinico', 'trim|required');
                $this->form_validation->set_rules('inFechaConsulta', 'fecha', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'modificar':
                $this->form_validation->set_rules('inIdConsulta', 'id', 'trim|required');
                $this->form_validation->set_rules('inAnamnesisConsulta', 'anamnesis', 'trim|required');
                $this->form_validation->set_rules('inUsuarioConsulta', 'usuario', 'trim|required');
                //$this->form_validation->set_rules('inPConsulta', 'peso', 'trim|required');
                //$this->form_validation->set_rules('inTConsulta', 'temperatura', 'trim|required');
                //$this->form_validation->set_rules('inFCConsulta', 'frec. cardiaca', 'trim|required');
                //$this->form_validation->set_rules('inFRConsulta', 'frec. respiratoria', 'trim|required');
                $this->form_validation->set_rules('inExamenClinicoConsulta', 'exámen clinico', 'trim|required');
                $this->form_validation->set_rules('inFechaConsulta', 'fecha', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'eliminar':
                $this->form_validation->set_rules('inIdConsulta', 'id', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    public function crear($idHistoriaClinica, $idUsuario, $anamnesisConsulta, $pesoConsulta, $temperaturaConsulta, $frecuenciaCardiacaConsulta, $frecuenciaRespiratoriaConsulta, $examenClinicoConsulta, $recetaMedicaConsulta, $fechaConsulta) {
        $this->db->trans_start();
        $this->db->set(ID_HISTORIA_CLINICA, $idHistoriaClinica);
        $this->db->set(ID_USUARIO, $idUsuario);
        $this->db->set(ANAMNESIS_CONSULTA, $anamnesisConsulta);
        $this->db->set(PESO_CONSULTA, $pesoConsulta);
        $this->db->set(TEMPERATURA_CONSULTA, $temperaturaConsulta);
        $this->db->set(FRECUENCIA_CARDIACA_CONSULTA, $frecuenciaCardiacaConsulta);
        $this->db->set(FRECUENCIA_RESPIRATORIA_CONSULTA, $frecuenciaRespiratoriaConsulta);
        $this->db->set(EXAMEN_CLINICO_CONSULTA, $examenClinicoConsulta);
        $this->db->set(RECETA_MEDICA_CONSULTA, $recetaMedicaConsulta);
        $this->db->set(FECHA_CONSULTA, $fechaConsulta);
        $this->db->insert(TBL_CONSULTAS);
        $this->id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            $this->crearConsultaDirectorio($this->id);
            return true;
        }
    }

    public function modificar($idConsulta, $idUsuario, $anamnesisConsulta, $pesoConsulta, $temperaturaConsulta, $frecuenciaCardiacaConsulta, $frecuenciaRespiratoriaConsulta, $examenClinicoConsulta, $recetaMedicaConsulta, $fechaConsulta) {
        $this->db->trans_start();
        $this->db->set(ID_USUARIO, $idUsuario);
        $this->db->set(ANAMNESIS_CONSULTA, $anamnesisConsulta);
        $this->db->set(PESO_CONSULTA, $pesoConsulta);
        $this->db->set(TEMPERATURA_CONSULTA, $temperaturaConsulta);
        $this->db->set(FRECUENCIA_CARDIACA_CONSULTA, $frecuenciaCardiacaConsulta);
        $this->db->set(FRECUENCIA_RESPIRATORIA_CONSULTA, $frecuenciaRespiratoriaConsulta);
        $this->db->set(EXAMEN_CLINICO_CONSULTA, $examenClinicoConsulta);
        $this->db->set(RECETA_MEDICA_CONSULTA, $recetaMedicaConsulta);
        $this->db->set(FECHA_CONSULTA, $fechaConsulta);
        $this->db->where(ID_CONSULTA, $idConsulta);
        $this->db->update(TBL_CONSULTAS);
        $this->id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function eliminar($idConsulta) {
        $this->db->trans_start();
        $this->db->set(ESTADO_CONSULTA, 'ELIMINADO');
        $this->db->where(ID_CONSULTA, $idConsulta);
        $this->db->where(ESTADO_CONSULTA, 'ACTIVO');
        $this->db->update(TBL_CONSULTAS);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('error', $this->db->error());
            return false;
        } else {
            return true;
        }
    }

    public function obtenerConsultaPorIdConsulta($idConsulta) {
        $this->db->select(''
                . '' . TBL_CONSULTAS . '.' . TODO . ','
                . '' . TBL_USUARIOS . '.' . NOMBRES_USUARIO . ','
                . '' . TBL_USUARIOS . '.' . APELLIDOS_USUARIO);
        $this->db->from(TBL_CONSULTAS);
        $this->db->join(TBL_USUARIOS, TBL_CONSULTAS . '.' . ID_USUARIO . '=' . TBL_USUARIOS . '.' . ID_USUARIO);
        $this->db->where(ID_CONSULTA, $idConsulta);
        $this->db->where(ESTADO_CONSULTA, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function obtenerConsultasCantidadPaginasPorIdHistoriaClinica($idHistoriaClinica, $campoFiltro, $valorFiltro) {
        $this->db->select(''
                . '' . TBL_CONSULTAS . '.' . TODO . ','
                . '' . TBL_USUARIOS . '.' . NOMBRES_USUARIO . ','
                . '' . TBL_USUARIOS . '.' . APELLIDOS_USUARIO);
        $this->db->from(TBL_CONSULTAS);
        $this->db->join(TBL_USUARIOS, TBL_CONSULTAS . '.' . ID_USUARIO . '=' . TBL_USUARIOS . '.' . ID_USUARIO);
        $this->db->where(ID_HISTORIA_CLINICA, $idHistoriaClinica);
        $this->db->where(ESTADO_CONSULTA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerHistoriasClinicasCampoFiltro($campoFiltro), $valorFiltro);
        }
        $resultado = $this->db->get();
        $ajuste = 0;
        if ($resultado->num_rows() % REGISTROS_POR_PAGINA == 0) {
            $ajuste = 1;
        }
        return intval($resultado->num_rows() / REGISTROS_POR_PAGINA) - $ajuste;
    }

    public function obtenerConsultasPaginaPorIdHistoriaClinica($idHistoriaClinica, $pagina, $campoFiltro, $valorFiltro) {
        $this->db->select(''
                . '' . TBL_CONSULTAS . '.' . TODO . ','
                . '' . TBL_USUARIOS . '.' . NOMBRES_USUARIO . ','
                . '' . TBL_USUARIOS . '.' . APELLIDOS_USUARIO);
        $this->db->from(TBL_CONSULTAS);
        $this->db->join(TBL_USUARIOS, TBL_CONSULTAS . '.' . ID_USUARIO . '=' . TBL_USUARIOS . '.' . ID_USUARIO);
        $this->db->where(ID_HISTORIA_CLINICA, $idHistoriaClinica);
        $this->db->where(ESTADO_CONSULTA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerHistoriasClinicasCampoFiltro($campoFiltro), $valorFiltro);
        }
        $this->db->order_by(ID_CONSULTA, "desc");
        $this->db->limit(REGISTROS_POR_PAGINA, empty($pagina) ? 0 : $pagina * REGISTROS_POR_PAGINA);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function obtenerConsultasrPorIdHistoriaClinica($idHistoriaClinica) {
        $this->db->select(''
                . '' . TBL_CONSULTAS . '.' . TODO . ','
                . '' . TBL_USUARIOS . '.' . NOMBRES_USUARIO . ','
                . '' . TBL_USUARIOS . '.' . APELLIDOS_USUARIO);
        $this->db->from(TBL_CONSULTAS);
        $this->db->join(TBL_USUARIOS, TBL_CONSULTAS . '.' . ID_USUARIO . '=' . TBL_USUARIOS . '.' . ID_USUARIO);
        $this->db->where(ID_HISTORIA_CLINICA, $idHistoriaClinica);
        $this->db->where(ESTADO_CONSULTA, 'ACTIVO');
        $this->db->order_by(ID_CONSULTA, "desc");
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function crearConsultaDirectorio($idConsulta) {
        $this->ftp->connect();
        $this->ftp->mkdir("consulta" . $idConsulta, 0777);
        $this->ftp->close();
    }

    public function obtenerConsultaErroresDatos() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
    }

    private function obtenerHistoriasClinicasCampoFiltro($campoFiltro) {
        switch ($campoFiltro) {
            case 1:
                return TBL_CONSULTAS . '.' . FECHA_REGISTRO_CONSULTA;
        }
    }

}
