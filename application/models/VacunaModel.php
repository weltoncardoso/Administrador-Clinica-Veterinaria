<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VacunaModel extends CI_Model {

    public $errores = array();

    public function __construct() {
        parent::__construct();
    }

    public function crearVacuna() {
        if ($this->validarConsultaDatos('crear')) {
            $this->db->trans_start();
            $this->db->set(ID_PACIENTE, mb_strtoupper($this->input->post('inIdPaciente')));
            $this->db->set(TIPO_VACUNA, mb_strtoupper($this->input->post('inTipoVacuna')));
            $this->db->set(MEDICAMENTO_VACUNA, mb_strtoupper($this->input->post('inMedicamentoVacuna')));
            $this->db->set(FECHA_VACUNA, mb_strtoupper($this->input->post('inFechaVacuna')));
            $this->db->set(PROXIMA_VACUNA, mb_strtoupper($this->input->post('inFechaProximaVacuna')));
            $this->db->insert(TBL_VACUNAS);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('error', $this->db->error());
                return false;
            } else {
                return true;
            }
        } else {
            $this->obtenerVacunaErroresDatos();
            return $this->errores;
        }
    }

    public function modificarVacuna() {
        if ($this->validarConsultaDatos('modificar')) {
            $this->db->trans_start();
            $this->db->set(TIPO_VACUNA, mb_strtoupper($this->input->post('inTipoVacuna')));
            $this->db->set(MEDICAMENTO_VACUNA, mb_strtoupper($this->input->post('inMedicamentoVacuna')));
            $this->db->set(FECHA_VACUNA, mb_strtoupper($this->input->post('inFechaVacuna')));
            $this->db->set(PROXIMA_VACUNA, mb_strtoupper($this->input->post('inFechaProximaVacuna')));
            $this->db->where(ID_VACUNA, mb_strtoupper($this->input->post('inIdVacuna')));
            $this->db->update(TBL_VACUNAS);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('error', $this->db->error());
                return false;
            } else {
                return true;
            }
        } else {
            $this->obtenerVacunaErroresDatos();
            return $this->errores;
        }
    }

    public function eliminarVacuna() {
        if ($this->validarConsultaDatos('eliminar')) {
            $this->db->trans_start();
            $this->db->set(ESTADO_VACUNA, 'ELIMINADO');
            $this->db->where(ID_VACUNA, $this->input->post('inIdVacuna'));
            $this->db->update(TBL_VACUNAS);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('error', $this->db->error());
                return false;
            } else {
                return true;
            }
        } else {
            $this->obtenerVacunaErroresDatos();
            return $this->errores;
        }
    }

    public function obtenerVacunasCantidadPaginasPorIdPaciente($idPaciente, $campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_VACUNAS);
        $this->db->where(ID_PACIENTE, $idPaciente);
        $this->db->where(ESTADO_VACUNA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerVacunasCampoFiltro($campoFiltro), $valorFiltro);
        }
        $resultado = $this->db->get();
        $ajuste = 0;
        if ($resultado->num_rows() % REGISTROS_POR_PAGINA == 0) {
            $ajuste = 1;
        }
        return intval($resultado->num_rows() / REGISTROS_POR_PAGINA) - $ajuste;
    }

    public function obtenerVacunasPaginaPorIdPaciente($idPaciente, $pagina, $campoFiltro, $valorFiltro) {
        $this->db->select(TODO);
        $this->db->from(TBL_VACUNAS);
        $this->db->where(ID_PACIENTE, $idPaciente);
        $this->db->where(ESTADO_VACUNA, 'ACTIVO');
        if (!empty($campoFiltro) && !empty($valorFiltro)) {
            $this->db->like($this->obtenerVacunasCampoFiltro($campoFiltro), $valorFiltro);
        }
        $this->db->order_by(ID_VACUNA, "desc");
        $this->db->limit(REGISTROS_POR_PAGINA, empty($pagina) ? 0 : $pagina * REGISTROS_POR_PAGINA);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    public function obtenerVacunaPorIdVacuna($idVacuna) {
        $this->db->select(TODO);
        $this->db->from(TBL_VACUNAS);
        $this->db->where(ID_VACUNA, $idVacuna);
        $this->db->where(ESTADO_VACUNA, 'ACTIVO');
        $resultado = $this->db->get();
        return $resultado->row_array();
    }

    public function validarConsultaDatos($metodo) {
        $estado = true;
        switch ($metodo) {
            case 'crear':
                $this->form_validation->set_rules('inIdPaciente', 'id', 'trim|required');
                $this->form_validation->set_rules('inTipoVacuna', 'tipo vacuna', 'trim|required');
                $this->form_validation->set_rules('inFechaVacuna', 'fecha vacuna', 'trim|required');
                $this->form_validation->set_rules('inFechaProximaVacuna', 'fecha proxima vacuna', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'modificar':
                $this->form_validation->set_rules('inIdVacuna', 'id', 'trim|required');
                $this->form_validation->set_rules('inFechaVacuna', 'fecha vacuna', 'trim|required');
                $this->form_validation->set_rules('inFechaProximaVacuna', 'fecha proxima vacuna', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
            case 'eliminar':
                $this->form_validation->set_rules('inIdVacuna', 'id', 'trim|required');
                if (!$this->form_validation->run()) {
                    $estado = false;
                }
                break;
        }
        return $estado;
    }

    public function obtenerVacunaErroresDatos() {
        foreach ($this->input->post() as $campo => $valor) {
            (form_error($campo) != null) ? array_push($this->errores, array('campo' => $campo, 'mensaje' => strip_tags(form_error($campo)), 'valor' => $valor)) : null;
        }
    }

    public function calcularProximaFechaVacuna($fecha, $tiempo, $cantidad) {
        return date('Y-m-d', strtotime($fecha . ' ' . $cantidad . ' ' . mb_strtolower($tiempo)));
    }

    private function obtenerVacunasCampoFiltro($campoFiltro) {
        switch ($campoFiltro) {
            case 1:
                return TBL_VACUNAS . '.' . FECHA_VACUNA;
        }
    }

    public function enviarRecordatorioVacuna($destino, $tipoVacuna, $nombreCompletoPropietario, $nombrePaciente, $fecha) {
        $fechaMensaje = DateTime::createFromFormat("Y-m-d", $fecha);
        $this->email->from('test@bigmarketinghouse.com', 'Test');
        $this->email->to($destino);
        $this->email->subject('DOG MEDI CAT - Recordatorio de ' . $tipoVacuna);
        $this->email->message('Buenos días ' . $nombreCompletoPropietario . '.<br><br>'
                . 'Recuerde que el proximo ' . $fechaMensaje->format("d") . ' de '
                . '' . $this->obtenerNombreMes($fechaMensaje->format("m")) . ' del '
                . '' . $fechaMensaje->format("Y") . ' su mascota '
                . '' . $nombrePaciente . ' debe asistir a su '
                . '' . $tipoVacuna . '.<br><br>'
                . 'Cordialmente,<br>'
                . 'DOG MEDI CAT');
        $this->email->send();
    }

    private function obtenerNombreMes($mes) {
        switch ($mes) {
            case 1:
                return 'Enero';
            case 2:
                return 'Febrero';
            case 3:
                return 'Marzo';
            case 4:
                return 'Abril';
            case 5:
                return 'Mayo';
            case 6:
                return 'Junio';
            case 7:
                return 'Julio';
            case 8:
                return 'Agosto';
            case 9:
                return 'Septiembre';
            case 10:
                return 'Octubre';
            case 11:
                return 'Noviembre';
            case 12:
                return 'Diciembre';
        }
    }

}
