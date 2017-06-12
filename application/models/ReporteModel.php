<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class ReporteModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function generarRecetaMedica($propietario, $paciente, $consulta) {
        $dompdf = new Dompdf();
        $reporte = '';
        $reporte .= '<html>';
        $reporte .= '<head>';
        $reporte .= '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/bootstrap.min.css') . '"/>';
        $reporte .= '</head>';
        $reporte .= '<body style="font-size: 12px">';
        $reporte .= '<div class="container-fluid">';
        $reporte .= '<div class="row">';
        $reporte .= '<div class="col-sm-12">';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%" align="left">';
        $reporte .= '<strong>RECETARIO<br></strong>';
        $reporte .= empty(DIRECCION_CLINICA_VETERINARIA) ? '' : DIRECCION_CLINICA_VETERINARIA . '<br>';
        $reporte .= empty(TELEFONO_CLINICA_VETERINARIA) ? '' : 'Teléfono(s): ' . TELEFONO_CLINICA_VETERINARIA . '<br>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%" align="right" valign="middle">';
        $reporte .= '<img class="img-fluid" src="assets/img/logo.jpg" style="height: 40px">';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Propietario: </strong>';
        $reporte .= '<span>' . $propietario[NOMBRES_PROPIETARIO] . ' ' . $propietario[APELLIDOS_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 33%">';
        $reporte .= '<strong>Paciente: </strong>';
        $reporte .= '<span>' . $paciente[NOMBRE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 33%">';
        $reporte .= '<strong>Especie: </strong>';
        $reporte .= '<span>' . $paciente[ESPECIE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 33%">';
        $reporte .= '<strong>Raza: </strong>';
        $reporte .= '<span>' . $paciente[RAZA_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 33%">';
        $reporte .= '<strong>Sexo: </strong>';
        $reporte .= '<span>' . $paciente[SEXO_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 33%">';
        $reporte .= '<strong>Descripción: </strong>';
        $reporte .= '<span>' . $paciente[DESCRIPCION_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 33%">';
        $reporte .= '<strong>Peso: </strong>';
        $reporte .= '<span>' . $consulta[PESO_CONSULTA] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<div class="panel panel-' . COLOR . '">';
        $reporte .= '<div class="panel-body">';
        $reporte .= '<table style="width: 100%; min-height: 100px">';
        $reporte .= '<tr>';
        $reporte .= '<td>';
        $reporte .= '<label>Medicamentos: </label>';
        $reporte .= '<span>' . nl2br($consulta[RECETA_MEDICA_CONSULTA]) . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '</body>';
        $reporte .= '</html>';
        $dompdf->loadHtml($reporte);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $dompdf->stream('ConsultaRecetaMedica' . $consulta[ID_CONSULTA]);
    }

    public function generarAutorizacion($propietario, $paciente, $cedula, $procedimiento) {
        $fechaNacimiento = new DateTime($paciente[FECHA_NACIMIENTO_PACIENTE]);
        $fechaActual = new DateTime(date("Y-m-d H:i:s"));
        $diferencia = $fechaNacimiento->diff($fechaActual);
        $edad = $diferencia->y . ' años, ' . $diferencia->m . ' meses, ' . $diferencia->d . ' días';
        $dompdf = new Dompdf();
        $reporte = '';
        $reporte .= '<html>';
        $reporte .= '<head>';
        $reporte .= '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/bootstrap.min.css') . '"/>';
        $reporte .= '</head>';
        $reporte .= '<body style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size: 14px;">';
        $reporte .= '<div class="container-fluid">';
        $reporte .= '<div class="row">';
        $reporte .= '<div class="col-sm-12">';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="right">';
        $reporte .= '<img class="img-fluid" src="assets/img/logo1.jpg">';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="center">';
        $reporte .= '<p>';
        $reporte .= '<strong><u>AUTORIZACIÓN DE SEDACIÓN Y/O ANESTESIA<br>(CONSENTIMIENTO INFORMADO)</u></strong>';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= 'Autorizo por medio de este documento a la clínica veterinaria DOG MEDI CAT a realizar los procedimientos de sedación y/o anestesia necesarios al paciente relacionado a continuación para el procedimiento que  requiere.';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<strong>DATOS DEL PACIENTE</strong>';
        $reporte .= '<div class="panel panel-default">';
        $reporte .= '<div class="panel-body">';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Nombre del propietario: </strong>';
        $reporte .= '<span>' . $propietario[NOMBRES_PROPIETARIO] . ' ' . $propietario[APELLIDOS_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Cédula: </strong>';
        $reporte .= '<span>' . $cedula . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Teléfono(s): </strong>';
        $reporte .= '<span>' . $propietario['propietarioNumerosContactoConcatenado'][NUMERO_CONTACTO_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Dirección: </strong>';
        $reporte .= '<span>' . $propietario[DIRECCION_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Paciente: </strong>';
        $reporte .= '<span>' . $paciente[NOMBRE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Edad: </strong>';
        $reporte .= '<span>' . $edad . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Especie: </strong>';
        $reporte .= '<span>' . $paciente[ESPECIE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Sexo: </strong>';
        $reporte .= '<span>' . $paciente[SEXO_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Descripción: </strong>';
        $reporte .= '<span>' . $paciente[DESCRIPCION_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Raza: </strong>';
        $reporte .= '<span>' . $paciente[RAZA_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= '<strong>NOMBRE DEL PROCEDIMIENTO MEDICO Y/O QUIRURGICO POR EL CUAL SE REQUIERE LA SEDACION O ANESTESIA: ' . mb_strtoupper($procedimiento) . '</strong>';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= 'Conozco y acepto los riesgos que esto conlleva y me abstengo de formular acción judicial en contra de DOG MEDI CAT.<br>Con la presente acta, autorizo sean cargados a mi nombre todos los gastos y costos; me comprometo a cancelar la totalidad del saldo que quedase en el momento de liquidar la respectiva factura cambiaria de compraventa.';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= 'Este documento tiene acción legal y se firma a la fecha de: ' . date('Y-m-d H:i:s');
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '<div style="position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px; width: 100%; text-align: center; font-size: 10px; color: #878787">';
        $reporte .= '<hr style="padding: 0; margin: 0; border-color: #878787">';
        $reporte .= empty(DIRECCION_CLINICA_VETERINARIA) ? '' : DIRECCION_CLINICA_VETERINARIA;
        $reporte .= empty(TELEFONO_CLINICA_VETERINARIA) ? '' : ', Teléfono(s): ' . TELEFONO_CLINICA_VETERINARIA;
        $reporte .= '</div>';
        $reporte .= '</body>';
        $reporte .= '</html>';
        $dompdf->loadHtml($reporte);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Autorizacion' . $paciente[ID_PACIENTE]);
    }

    public function generarHospitalizacion($propietario, $paciente, $cedula) {
        $fechaNacimiento = new DateTime($paciente[FECHA_NACIMIENTO_PACIENTE]);
        $fechaActual = new DateTime(date("Y-m-d H:i:s"));
        $diferencia = $fechaNacimiento->diff($fechaActual);
        $edad = $diferencia->y . ' años, ' . $diferencia->m . ' meses, ' . $diferencia->d . ' días';
        $dompdf = new Dompdf();
        $reporte = '';
        $reporte .= '<html>';
        $reporte .= '<head>';
        $reporte .= '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/bootstrap.min.css') . '"/>';
        $reporte .= '</head>';
        $reporte .= '<body style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size: 14px;">';
        $reporte .= '<div class="container-fluid">';
        $reporte .= '<div class="row">';
        $reporte .= '<div class="col-sm-12">';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="right">';
        $reporte .= '<img class="img-fluid" src="assets/img/logo1.jpg">';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="center">';
        $reporte .= '<p>';
        $reporte .= '<strong><u>ACTA DE CONSENTIMIENTO HOSPITALIZACIÓN<br>(CONSENTIMIENTO INFORMADO)</u></strong>';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= 'Por medio de la presente, autorizo a DOG MEDI CAT para que preste los servicios de hospitalización que requiera el paciente.';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<strong>DATOS DEL PACIENTE</strong>';
        $reporte .= '<div class="panel panel-default">';
        $reporte .= '<div class="panel-body">';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Nombre del propietario: </strong>';
        $reporte .= '<span>' . $propietario[NOMBRES_PROPIETARIO] . ' ' . $propietario[APELLIDOS_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Cédula: </strong>';
        $reporte .= '<span>' . $cedula . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Teléfono(s): </strong>';
        $reporte .= '<span>' . $propietario['propietarioNumerosContactoConcatenado'][NUMERO_CONTACTO_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Dirección: </strong>';
        $reporte .= '<span>' . $propietario[DIRECCION_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Paciente: </strong>';
        $reporte .= '<span>' . $paciente[NOMBRE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Edad: </strong>';
        $reporte .= '<span>' . $edad . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Especie: </strong>';
        $reporte .= '<span>' . $paciente[ESPECIE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Sexo: </strong>';
        $reporte .= '<span>' . $paciente[SEXO_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Descripción: </strong>';
        $reporte .= '<span>' . $paciente[DESCRIPCION_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Raza: </strong>';
        $reporte .= '<span>' . $paciente[RAZA_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= '• DOG MEDI CAT no se hace responsable con los riesgos al someter al paciente a tratamientos durante la hospitalización lo mismo que accidentes, imprevistos, muertes u otros.';
        $reporte .= '<br>';
        $reporte .= '• El propietario de la mascota declara conocer el (los) procedimiento (s) que se va (n) a realizar en el paciente y se obliga a pagar a DOG MEDI CAT los honorarios, elementos médicos – quirúrgicos y exámenes complementarios que sean necesarios durante la hospitalización.';
        $reporte .= '<br>';
        $reporte .= '• Si el cliente no responde por su mascota en un lapso de 3 (tres) días o incumple con algún punto de este documento, la institución dispondrá del animal.';
        $reporte .= '<br>';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= 'Este documento tiene acción legal y se firma a la fecha de: ' . date('Y-m-d H:i:s');
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '<div style="position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px; width: 100%; text-align: center; font-size: 10px; color: #878787">';
        $reporte .= '<hr style="padding: 0; margin: 0; border-color: #878787">';
        $reporte .= empty(DIRECCION_CLINICA_VETERINARIA) ? '' : DIRECCION_CLINICA_VETERINARIA;
        $reporte .= empty(TELEFONO_CLINICA_VETERINARIA) ? '' : ', Teléfono(s): ' . TELEFONO_CLINICA_VETERINARIA;
        $reporte .= '</div>';
        $reporte .= '</body>';
        $reporte .= '</html>';
        $dompdf->loadHtml($reporte);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Hospitalizacion' . $paciente[ID_PACIENTE]);
    }

    public function generarCertificacion($propietario, $paciente, $cedula, $contenido, $pasaporte) {
        $fechaNacimiento = new DateTime($paciente[FECHA_NACIMIENTO_PACIENTE]);
        $fechaActual = new DateTime(date("Y-m-d H:i:s"));
        $diferencia = $fechaNacimiento->diff($fechaActual);
        $edad = $diferencia->y . ' años, ' . $diferencia->m . ' meses, ' . $diferencia->d . ' días';
        $dompdf = new Dompdf();
        $reporte = '';
        $reporte .= '<html>';
        $reporte .= '<head>';
        $reporte .= '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/bootstrap.min.css') . '"/>';
        $reporte .= '</head>';
        $reporte .= '<body style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size: 14px;">';
        $reporte .= '<div class="container-fluid">';
        $reporte .= '<div class="row">';
        $reporte .= '<div class="col-sm-12">';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="right">';
        $reporte .= '<img class="img-fluid" src="assets/img/logo1.jpg">';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="center">';
        $reporte .= '<p>';
        $reporte .= '<strong><u>CERTIFICADO VETERINARIO INTERNACIONAL</u></strong>';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<strong>DATOS DEL PACIENTE</strong>';
        $reporte .= '<div class="panel panel-default">';
        $reporte .= '<div class="panel-body">';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Nombre del propietario: </strong>';
        $reporte .= '<span>' . $propietario[NOMBRES_PROPIETARIO] . ' ' . $propietario[APELLIDOS_PROPIETARIO] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%">';
        $reporte .= '<strong>Cédula: </strong>';
        $reporte .= '<span>' . $cedula . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        if ($pasaporte != 'No Tiene') {
            $reporte .= '<td style="width: 100%">';
            $reporte .= '<strong>Pasaporte: </strong>';
            $reporte .= '<span>' . mb_strtoupper($pasaporte) . '</span>';
            $reporte .= '</td>';
        }
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Paciente: </strong>';
        $reporte .= '<span>' . $paciente[NOMBRE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Edad: </strong>';
        $reporte .= '<span>' . $edad . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Especie: </strong>';
        $reporte .= '<span>' . $paciente[ESPECIE_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Sexo: </strong>';
        $reporte .= '<span>' . $paciente[SEXO_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Descripción: </strong>';
        $reporte .= '<span>' . $paciente[DESCRIPCION_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '<td style="width: 50%">';
        $reporte .= '<strong>Raza: </strong>';
        $reporte .= '<span>' . $paciente[RAZA_PACIENTE] . '</span>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= nl2br($contenido);
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= 'Adjunto a esta certificación el carnet de vacunación del animal al día.';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '<br>';
        $reporte .= '<br>';
        $reporte .= '<table style="width: 100%">';
        $reporte .= '<tr>';
        $reporte .= '<td style="width: 100%" align="justify">';
        $reporte .= '<p>';
        $reporte .= 'Se expide este certificado a solicitud del interesado(a) en la ciudad de Bogotá D.C., a los ' . $this->obtenerNombreNumero(date("j")) . ' (' . date("d") . ') días del mes de ' . $this->obtenerNombreMes(date("n")) . ' (' . date("m") . ') del año dos mil ' . $this->obtenerNombreNumero(date("y")) . ' (' . date("Y") . ').';
        $reporte .= '</p>';
        $reporte .= '</td>';
        $reporte .= '</tr>';
        $reporte .= '</table>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '</div>';
        $reporte .= '<div style="position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px; width: 100%; text-align: center; font-size: 10px; color: #878787">';
        $reporte .= '<hr style="padding: 0; margin: 0; border-color: #878787">';
        $reporte .= empty(DIRECCION_CLINICA_VETERINARIA) ? '' : DIRECCION_CLINICA_VETERINARIA;
        $reporte .= empty(TELEFONO_CLINICA_VETERINARIA) ? '' : ', Teléfono(s): ' . TELEFONO_CLINICA_VETERINARIA;
        $reporte .= '</div>';
        $reporte .= '</body>';
        $reporte .= '</html>';
        $dompdf->loadHtml($reporte);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Certificacion' . $paciente[ID_PACIENTE]);
    }

    public function generarHistoria($propietario, $paciente, $consultas, $historiaClinica) {
        $fechaNacimiento = new DateTime($paciente[FECHA_NACIMIENTO_PACIENTE]);
        $fechaActual = new DateTime(date("Y-m-d H:i:s"));
        $diferencia = $fechaNacimiento->diff($fechaActual);
        $edad = $diferencia->y . ' años, ' . $diferencia->m . ' meses, ' . $diferencia->d . ' días';
        $dompdf = new Dompdf();
        $reporte = '';
        $reporte .= '<html>';
        $reporte .= '<head>';
        $reporte .= '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/bootstrap.min.css') . '"/>';
        $reporte .= '</head>';
        $reporte .= '<body style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size: 14px;">';
        $reporte .= '<table style="width: 100%" class="table table-bordered table-condensed">';
        $reporte .= '<thead>';
        $reporte .= '<tr>';
        $reporte .= '<th colspan="2" align="center">';
        $reporte .= '<img class="img-fluid" src="assets/img/logo1.jpg" style="height: 40px">';
        $reporte .= '</th>';
        $reporte .= '</tr>';
        $reporte .= '<tr class="' . COLOR . '">';
        $reporte .= '<th align="center">';
        $reporte .= '<strong>HISTORIA CLÍNICA No. ' . $historiaClinica[ID_HISTORIA_CLINICA] . '</strong>';
        $reporte .= '</th>';
        $reporte .= '<th align="center">';
        $reporte .= '<strong>Fecha ingreso:' . $historiaClinica[FECHA_HISTORIA_CLINICA] . '</strong>';
        $reporte .= '</th>';
        $reporte .= '</tr>';
        $reporte .= '<tr class="' . COLOR . '">';
        $reporte .= '<th colspan="2">';
        $reporte .= '<strong>Nombre del propietario: </strong>';
        $reporte .= '<span>' . $propietario[NOMBRES_PROPIETARIO] . ' ' . $propietario[APELLIDOS_PROPIETARIO] . '</span>';
        $reporte .= '</th>';
        $reporte .= '</tr>';
        $reporte .= '<tr class="' . COLOR . '">';
        $reporte .= '<th>';
        $reporte .= '<strong>Teléfono(s): </strong>';
        $reporte .= '<span>' . $propietario['propietarioNumerosContactoConcatenado'][NUMERO_CONTACTO_PROPIETARIO] . '</span>';
        $reporte .= '</th>';
        $reporte .= '<th>';
        $reporte .= '<strong>Dirección: </strong>';
        $reporte .= '<span>' . $propietario[DIRECCION_PROPIETARIO] . '</span>';
        $reporte .= '</th>';
        $reporte .= '</tr>';
        $reporte .= '<tr class="' . COLOR . '">';
        $reporte .= '<th>';
        $reporte .= '<strong>Paciente: </strong>';
        $reporte .= '<span>' . $paciente[NOMBRE_PACIENTE] . '</span>';
        $reporte .= '</th>';
        $reporte .= '<th>';
        $reporte .= '<strong>Edad: </strong>';
        $reporte .= '<span>' . $edad . '</span>';
        $reporte .= '</th>';
        $reporte .= '</tr>';
        $reporte .= '<tr class="' . COLOR . '">';
        $reporte .= '<th>';
        $reporte .= '<strong>Especie: </strong>';
        $reporte .= '<span>' . $paciente[ESPECIE_PACIENTE] . '</span>';
        $reporte .= '</th>';
        $reporte .= '<th>';
        $reporte .= '<strong>Sexo: </strong>';
        $reporte .= '<span>' . $paciente[SEXO_PACIENTE] . '</span>';
        $reporte .= '</th>';
        $reporte .= '</tr>';
        $reporte .= '<tr class="' . COLOR . '">';
        $reporte .= '<th>';
        $reporte .= '<strong>Descripción: </strong>';
        $reporte .= '<span>' . $paciente[DESCRIPCION_PACIENTE] . '</span>';
        $reporte .= '</th>';
        $reporte .= '<th>';
        $reporte .= '<strong>Raza: </strong>';
        $reporte .= '<span>' . $paciente[RAZA_PACIENTE] . '</span>';
        $reporte .= '</th>';
        $reporte .= '</tr>';
        $reporte .= '</thead>';
        $reporte .= '<tbody>';
        foreach ($consultas as $consulta) {
            $reporte .= '<tr class="active">';
            $reporte .= '<td colspan="2">Fecha de la consulta: ' . $consulta[FECHA_CONSULTA] . '</td>';
            $reporte .= '</tr>';
            $reporte .= '<tr>';
            $reporte .= '<td colspan="2">Médico veterinario: ' . $consulta[NOMBRES_USUARIO] . ' ' . $consulta[APELLIDOS_USUARIO] . '</td>';
            $reporte .= '</tr>';
            $reporte .= '<tr>';
            $reporte .= '<td colspan="2">Anamnesis: ' . nl2br($consulta[ANAMNESIS_CONSULTA]) . '</td>';
            $reporte .= '</tr>';
            $reporte .= '<tr>';
            $reporte .= '<td>Peso: ' . $consulta[PESO_CONSULTA] . '</td>';
            $reporte .= '<td>Temperatura: ' . $consulta[TEMPERATURA_CONSULTA] . '</td>';
            $reporte .= '</tr>';
            $reporte .= '<tr>';
            $reporte .= '<td>Frecuencia cardiaca: ' . $consulta[FRECUENCIA_CARDIACA_CONSULTA] . '</td>';
            $reporte .= '<td>Frecuencia respiratoria: ' . $consulta[FRECUENCIA_RESPIRATORIA_CONSULTA] . '</td>';
            $reporte .= '</tr>';
            $reporte .= '<tr>';
            $reporte .= '<td colspan="2">Exámen Clinico:</strong> ' . nl2br($consulta[EXAMEN_CLINICO_CONSULTA]) . '</td>';
            $reporte .= '</tr>';
            $reporte .= '<tr>';
            $reporte .= '<td colspan="2">Receta Médica: ' . ((empty($consulta[RECETA_MEDICA_CONSULTA])) ? 'Sin receta médica' : nl2br($consulta[RECETA_MEDICA_CONSULTA])) . '</td>';
            $reporte .= '</tr>';
        }
        $reporte .= '</tbody>';
        $reporte .= '</table>';
        $reporte .= '</body>';
        $reporte .= '</html>';
        $dompdf->loadHtml($reporte);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Historia' . $paciente[ID_PACIENTE]);
    }

    private function obtenerNombreNumero($numero) {
        switch ($numero) {
            case '00' :
                return 'cero';
            case '01' :
                return 'uno';
            case '02' :
                return 'dos';
            case '03' :
                return 'tres';
            case '04' :
                return 'cuatro';
            case '05' :
                return 'cinco';
            case '06' :
                return 'seis';
            case '07' :
                return 'siete';
            case '08' :
                return 'ocho';
            case '09' :
                return 'nueve';
            case 10:
                return 'diez';
            case 11:
                return 'once';
            case 12:
                return 'doce';
            case 13:
                return 'trece';
            case 14:
                return 'catorce';
            case 15:
                return 'quince';
            case 16:
                return 'dieciséis';
            case 17:
                return 'diecisiete';
            case 18:
                return 'dieciocho';
            case 19:
                return 'diecinueve';
            case 20:
                return 'veinte';
            case 21:
                return 'veintiuno';
            case 22:
                return 'veintidós';
            case 23:
                return 'veintitrés';
            case 24:
                return 'veinticuatro';
            case 25:
                return 'veinticinco';
            case 26:
                return 'veintiséis';
            case 27:
                return 'veintisiete';
            case 28:
                return 'veintiocho';
            case 29:
                return 'veintinueve';
            case 30:
                return 'treinta';
            case 31:
                return 'treinta y uno';
            case 32:
                return 'treinta y dos';
            case 33:
                return 'treinta y tres';
            case 34:
                return 'treinta y cuatro';
            case 35:
                return 'treinta y cinco';
            case 36:
                return 'treinta y seis';
            case 37:
                return 'treinta y siete';
            case 38:
                return 'treinta y ocho';
            case 39:
                return 'treinta y nueve';
            case 40:
                return 'cuarenta';
            case 41:
                return 'cuarenta y uno';
            case 42:
                return 'cuarenta y dos';
            case 43:
                return 'cuarenta y tres';
            case 44:
                return 'cuarenta y cuatro';
            case 45:
                return 'cuarenta y cinco';
            case 46:
                return 'cuarenta y seis';
            case 47:
                return 'cuarenta y siete';
            case 48:
                return 'cuarenta y ocho';
            case 49:
                return 'cuarenta y nueve';
            case 50:
                return 'cincuenta';
            case 51:
                return 'cincuenta y uno';
            case 52:
                return 'cincuenta y dos';
            case 53:
                return 'cincuenta y tres';
            case 54:
                return 'cincuenta y cuatro';
            case 55:
                return 'cincuenta y cinco';
            case 56:
                return 'cincuenta y seis';
            case 57:
                return 'cincuenta y siete';
            case 58:
                return 'cincuenta y ocho';
            case 59:
                return 'cincuenta y nueve';
            case 60:
                return 'sesenta';
            case 61:
                return 'sesenta y uno';
            case 62:
                return 'sesenta y dos';
            case 63:
                return 'sesenta y tres';
            case 64:
                return 'sesenta y cuatro';
            case 65:
                return 'sesenta y cinco';
            case 66:
                return 'sesenta y seis';
            case 67:
                return 'sesenta y siete';
            case 68:
                return 'sesenta y ocho';
            case 69:
                return 'sesenta y nueve';
            case 70:
                return 'setenta';
            case 71:
                return 'setenta y uno';
            case 72:
                return 'setenta y dos';
            case 73:
                return 'setenta y tres';
            case 74:
                return 'setenta y cuatro';
            case 75:
                return 'setenta y cinco';
            case 76:
                return 'setenta y seis';
            case 77:
                return 'setenta y siete';
            case 78:
                return 'setenta y ocho';
            case 79:
                return 'setenta y nueve';
            case 80:
                return 'ochenta';
            case 81:
                return 'ochenta y uno';
            case 82:
                return 'ochenta y dos';
            case 83:
                return 'ochenta y tres';
            case 84:
                return 'ochenta y cuatro';
            case 85:
                return 'ochenta y cinco';
            case 86:
                return 'ochenta y seis';
            case 87:
                return 'ochenta y siete';
            case 88:
                return 'ochenta y ocho';
            case 89:
                return 'ochenta y nueve';
            case 90:
                return 'noventa';
            case 91:
                return 'noventa y uno';
            case 92:
                return 'noventa y dos';
            case 93:
                return 'noventa y tres';
            case 94:
                return 'noventa y cuatro';
            case 95:
                return 'noventa y cinco';
            case 96:
                return 'noventa y seis';
            case 97:
                return 'noventa y siete';
            case 98:
                return 'noventa y ocho';
            case 99:
                return 'noventa y nueve';
        }
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
