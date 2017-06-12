<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TablaModel extends CI_Model {

    public $cliente = array(
        ID_PROPIETARIO => 'Id Propietario',
        NOMBRES_PROPIETARIO => 'Nombre(s) Propietario',
        APELLIDOS_PROPIETARIO => 'Apellido(s) Propietario',
        ID_PACIENTE => 'Id Paciente',
        NOMBRE_PACIENTE => 'Nombre Paciente',
        ESPECIE_PACIENTE => 'Especie Paciente',
        ID_HISTORIA_CLINICA => 'Id Historia Clínica',
        'destino' => ID_HISTORIA_CLINICA);
    public $propietario = array(
        ID_PROPIETARIO => 'Id Propietario',
        NOMBRES_PROPIETARIO => 'Nombre(s) Propietario',
        APELLIDOS_PROPIETARIO => 'Apellido(s) Propietario',
        'detalle' => array('Propietario/ObtenerModal', array('operacion' => 'detalle', 'inIdPropietario' => ID_PROPIETARIO)),
        'modificar' => array('Propietario/ObtenerModal', array('operacion' => 'modificar', 'inIdPropietario' => ID_PROPIETARIO)),
        'eliminar' => array('Propietario/ObtenerModal', array('operacion' => 'eliminar', 'inIdPropietario' => ID_PROPIETARIO)),
        'agregar' => array('Paciente/ObtenerModal', array('operacion' => 'crear', 'inIdPropietario' => ID_PROPIETARIO)));
    public $historiaClinica = array(
        ID_USUARIO => 'Id Usuario',
        NOMBRES_USUARIO => 'Nombre(s) Usuario',
        APELLIDOS_USUARIO => 'Apellido(s) Usuario',
        ID_CONSULTA => 'Id Consulta',
        FECHA_CONSULTA => 'Fecha Consulta',
        EXAMEN_CLINICO_CONSULTA => 'Examen Clínico Consulta',
        'adjunto' => array('Consulta/ObtenerModal', array('operacion' => 'adjunto', 'inIdConsulta' => ID_CONSULTA)),
        'detalle' => array('Consulta/ObtenerModal', array('operacion' => 'detalle', 'inIdConsulta' => ID_CONSULTA)),
        'modificar' => array('Consulta/ObtenerModal', array('operacion' => 'modificar', 'inIdConsulta' => ID_CONSULTA)),
        'eliminar' => array('Consulta/ObtenerModal', array('operacion' => 'eliminar', 'inIdConsulta' => ID_CONSULTA)),);
    public $usuario = array(
        ID_USUARIO => 'Id Usuario',
        NOMBRES_USUARIO => 'Nombre(s) Usuario',
        APELLIDOS_USUARIO => 'Apellido(s) Usuario',
        'detalle' => array('Usuario/ObtenerModal', array('operacion' => 'detalle', 'inIdUsuario' => ID_USUARIO)),
        'modificar' => array('Usuario/ObtenerModal', array('operacion' => 'modificar', 'inIdUsuario' => ID_USUARIO)),
        'eliminar' => array('Usuario/ObtenerModal', array('operacion' => 'eliminar', 'inIdUsuario' => ID_USUARIO)));
    public $vacuna = array(
        ID_VACUNA => 'Id Vacuna',
        TIPO_VACUNA => 'Tipo Vacuna',
        MEDICAMENTO_VACUNA => 'Medicamento',
        FECHA_VACUNA => 'Fecha vacuna',
        PROXIMA_VACUNA => 'Fecha proxima vacuna',
        'modificar' => array('Vacuna/ObtenerModal', array('operacion' => 'modificar', 'inIdVacuna' => ID_VACUNA)),
        'eliminar' => array('Vacuna/ObtenerModal', array('operacion' => 'eliminar', 'inIdVacuna' => ID_VACUNA)));
    public $planMedicinaPrepagada = array(
        ID_PLAN_MEDICINA_PREPAGADA => 'Id Plan Medicina Prepagada',
        NOMBRE_PLAN_MEDICINA_PREPAGADA => 'Nombre Plan Medicina Prepagada',
        DESCRIPCION_PLAN_MEDICINA_PREPAGADA => 'Descripcion Plan Medicina Prepagada',
        'detalle' => array('PlanMedicinaPrepagada/ObtenerModal', array('operacion' => 'detalle', 'inIdPlanMedicinaPrepagada' => ID_PLAN_MEDICINA_PREPAGADA)),
        'modificar' => array('PlanMedicinaPrepagada/ObtenerModal', array('operacion' => 'modificar', 'inIdPlanMedicinaPrepagada' => ID_PLAN_MEDICINA_PREPAGADA)),
        'eliminar' => array('PlanMedicinaPrepagada/ObtenerModal', array('operacion' => 'eliminar', 'inIdPlanMedicinaPrepagada' => ID_PLAN_MEDICINA_PREPAGADA)));
    private $opciones = array(
        'destino',
        'detalle',
        'modificar',
        'eliminar',
        'agregar',
        'adjunto');

    public function __construct() {
        parent::__construct();
    }

    public function crearTABLE($informacionTabla, $registrosTabla, $pagina, $paginas, $url, $urlDestino, $contenedor, $filtro, $tipo) {
        $table = '<div class="table-responsive">';
        $table .= '<table class="margin-bottom-0 table table-condensed table-hover">';
        $table .= $this->crearTHEAD($informacionTabla);
        if (!empty($registrosTabla)) {
            $table .= $this->crearTFOOT($informacionTabla, $pagina, $paginas);
        }
        $table .= $this->crearTBODY($informacionTabla, $registrosTabla, $urlDestino, $tipo);
        $table .= '</table>';
        $table .= '</div>';
        if (!empty($registrosTabla)) {
            $table.= $this->crearPaginacion($pagina, $paginas, $url, $contenedor, $filtro);
        }
        return $table;
    }

    private function crearTHEAD($informacionTabla) {
        $table = '<thead>';
        $table .= '<tr>';
        foreach ($informacionTabla as $columnaDatabase => $columnaTable) {
            $table .= '<th>';
            if (!in_array($columnaDatabase, $this->opciones)) {
                $table .= $columnaTable;
            }
            $table .= '</th>';
        }
        $table .= '</tr>';
        $table .= '</thead>';
        return $table;
    }

    private function crearTBODY($informacionTabla, $registrosTabla, $urlDestino, $tipo) {
        $table = '';
        if (!empty($registrosTabla)) {
            foreach ($registrosTabla as $registro) {
                $table .= '<tr>';
                foreach ($informacionTabla as $columnaDatabase => $columnaTable) {
                    $table .= '<td class="vertical-align-middle">';
                    if ($columnaDatabase == 'destino') {
                        $table .= '<a class="btn btn-' . COLOR . ' btn-xs" href="' . $urlDestino . '/' . $registro[$columnaTable] . '">';
                        $table .= 'Ir';
                        $table .= '</a>';
                    } else if ($columnaDatabase == 'adjunto') {
                        $table .= '<a class="btn btn-' . COLOR . ' btn-xs" onclick="crearModal(\'' . base_url($columnaTable[0]) . '\', ' . $this->obtenerDatos($columnaTable[1], $registro) . ', \'#modal\')">';
                        $table .= 'Adjunto';
                        $table .= '</a>';
                    } else if ($columnaDatabase == 'detalle') {
                        $table .= '<a class="btn btn-' . COLOR . ' btn-xs" onclick="crearModal(\'' . base_url($columnaTable[0]) . '\', ' . $this->obtenerDatos($columnaTable[1], $registro) . ', \'#modal\')">';
                        $table .= 'Detalle';
                        $table .= '</a>';
                    } else if ($columnaDatabase == 'modificar') {
                        $table .= '<a class="btn btn-' . COLOR . ' btn-xs" onclick="crearModal(\'' . base_url($columnaTable[0]) . '\', ' . $this->obtenerDatos($columnaTable[1], $registro) . ', \'#modal\')">';
                        $table .= 'Modificar';
                        $table .= '</a>';
                    } else if ($columnaDatabase == 'eliminar') {
                        $table .= '<a class="btn btn-' . COLOR . ' btn-xs" onclick="crearModal(\'' . base_url($columnaTable[0]) . '\', ' . $this->obtenerDatos($columnaTable[1], $registro) . ', \'#modal\')">';
                        $table .= 'Eliminar';
                        $table .= '</a>';
                    } else if ($columnaDatabase == 'agregar') {
                        $table .= '<a class="btn btn-' . COLOR . ' btn-xs" onclick="crearModal(\'' . base_url($columnaTable[0]) . '\', ' . $this->obtenerDatos($columnaTable[1], $registro) . ', \'#modal\')">';
                        $table .= 'Agregar';
                        $table .= '</a>';
                    } else {
                        $table .= $registro[$columnaDatabase];
                    }
                    $table .= '</td>';
                }
                $table .= '</tr>';
            }
            return $table;
        } else {
            switch ($tipo) {
                case 'filtro':
                    $table .= '<tr>';
                    $table .= '<td class="vertical-align-middle"  colspan="' . count($informacionTabla) . '">';
                    $table .= 'No hay coincidencias con el filtro ingresado.';
                    $table .= '</td>';
                    $table .= '</tr>';
                    return $table;
                default:
                    $table .= '<tr>';
                    $table .= '<td class="vertical-align-middle"  colspan="' . count($informacionTabla) . '">';
                    $table .= 'No hay registros.';
                    $table .= '</td>';
                    $table .= '</tr>';
                    return $table;
            }
        }
    }

    private function crearTFOOT($informacionTabla, $pagina, $paginas) {
        $table = '<tfoot>';
        $table .= '<tr>';
        $table .= '<td class="text-right" colspan="' . count($informacionTabla) . '">';
        $table .= 'Página ' . ($pagina + 1) . ' de ' . ($paginas + 1);
        $table .= '</td>';
        $table .= '</tr>';
        $table .= '</tfoot>';
        return $table;
    }

    private function crearPaginacion($pagina, $paginas, $url, $contenedor, $filtro) {
        $paginador = '';
        if ($paginas > 0) {
            $paginador .= '<nav aria-label="Paginacion" class="text-center">';
            $paginador .= '<ul class="margin-bottom-0 pagination">';
            $paginador .= '<li>';
            if ($pagina != 0) {
                $paginador .= '<a onclick="procesarPagina(\'' . $url . '\', ' . ($pagina - 1) . ', \'' . $contenedor . '\', \'' . $filtro . '\')">';
            } else {
                $paginador .= '<a>';
            }
            $paginador .= '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>';
            $paginador .= '</li>';
            if ($paginas > 2) {
                $classBotonA = '';
                $classBotonB = '';
                $classBotonC = '';
                $valorBotonA = 0;
                $valorBotonB = 0;
                $valorBotonC = 0;
                if ($pagina == 0) {
                    $classBotonA = 'active';
                    $valorBotonA = $pagina;
                    $valorBotonB = $pagina + 1;
                    $valorBotonC = $pagina + 2;
                } else if ($pagina == $paginas) {
                    $classBotonC = 'active';
                    $valorBotonA = $pagina - 2;
                    $valorBotonB = $pagina - 1;
                    $valorBotonC = $pagina;
                } else {
                    $classBotonB = 'active';
                    $valorBotonA = $pagina - 1;
                    $valorBotonB = $pagina;
                    $valorBotonC = $pagina + 1;
                }
                $paginador .= '<li class="' . $classBotonA . '">';
                $paginador .= '<a onclick="procesarPagina(\'' . $url . '\', ' . $valorBotonA . ', \'' . $contenedor . '\', \'' . $filtro . '\')">' . ($valorBotonA + 1) . '</a>';
                $paginador .= '</li>';
                $paginador .= '<li class="' . $classBotonB . '">';
                $paginador .= '<a onclick="procesarPagina(\'' . $url . '\', ' . $valorBotonB . ', \'' . $contenedor . '\', \'' . $filtro . '\')">' . ($valorBotonB + 1) . '</a>';
                $paginador .= '</li>';
                $paginador .= '<li class="' . $classBotonC . '">';
                $paginador .= '<a onclick="procesarPagina(\'' . $url . '\', ' . $valorBotonC . ', \'' . $contenedor . '\', \'' . $filtro . '\')">' . ($valorBotonC + 1) . '</a>';
                $paginador .= '</li>';
            } else {
                for ($indice = 0; $indice <= $paginas; $indice++) {
                    if ($indice == $pagina) {
                        $paginador .= '<li class="active">';
                    } else {
                        $paginador .= '<li>';
                    }
                    $paginador .= '<a onclick="procesarPagina(\'' . $url . '\', ' . $indice . ', \'' . $contenedor . '\', \'' . $filtro . '\')">' . ($indice + 1) . '</a>';
                    $paginador .= '</li>';
                }
            }
            $paginador .= '<li>';
            if ($pagina != $paginas) {
                $paginador .= '<a onclick="procesarPagina(\'' . $url . '\', ' . ($pagina + 1) . ', \'' . $contenedor . '\', \'' . $filtro . '\')">';
            } else {
                $paginador .= '<a>';
            }
            $paginador .= '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>';
            $paginador .= '</li>';
            $paginador .= '</ul>';
            $paginador .= '</nav>';
        }
        return $paginador;
    }

    private function obtenerDatos($informacionData, $registro) {
        $data = array();
        foreach ($informacionData as $nombreDato => $valorDato) {
            if ($nombreDato == 'operacion') {
                array_push($data, $nombreDato . ':\'' . $valorDato . '\'');
            } else {
                array_push($data, $nombreDato . ':\'' . $registro[$valorDato] . '\'');
            }
        }
        return '{' . implode(',', $data) . '}';
    }

}
