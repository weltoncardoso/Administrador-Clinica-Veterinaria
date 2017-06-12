<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('SESION') or define('SESION', 'sesion');
defined('COUNT') or define('COUNT', 'count(*)');
defined('REGISTROS_POR_PAGINA') or define('REGISTROS_POR_PAGINA', 10);
defined('COLOR') or define('COLOR', 'danger');
defined('TODO') or define('TODO', '*');
defined('PATH_CONSULTAS') or define('PATH_CONSULTAS', 'consulta');
defined('LIMITE_SELECT') or define('LIMITE_SELECT', 30);

defined('DIRECCION_CLINICA_VETERINARIA') or define('DIRECCION_CLINICA_VETERINARIA', 'Carrera 55 161 A Bis 45, Bogotá D.C.');
defined('TELEFONO_CLINICA_VETERINARIA') or define('TELEFONO_CLINICA_VETERINARIA', '+57 1 526 90 19 / +57 1 526 16 10');
defined('SERVICIOS_CLINICA_VETERINARIA') or define('SERVICIOS_CLINICA_VETERINARIA', 'Consulta Médica Veterinaria - Hospitalización - Peluquería');

defined('TBL_USUARIOS') OR define('TBL_USUARIOS', 'tbl_usuarios');
defined('ID_USUARIO') OR define('ID_USUARIO', 'id_usuario');
defined('NOMBRES_USUARIO') OR define('NOMBRES_USUARIO', 'nombres_usuario');
defined('APELLIDOS_USUARIO') OR define('APELLIDOS_USUARIO', 'apellidos_usuario');
defined('CORREO_ELECTRONICO_USUARIO') OR define('CORREO_ELECTRONICO_USUARIO', 'correo_electronico_usuario');
defined('CARGO_USUARIO') OR define('CARGO_USUARIO', 'cargo_usuario');
defined('NUMERO_CONTACTO_USUARIO') OR define('NUMERO_CONTACTO_USUARIO', 'numero_contacto_usuario');
defined('USUARIO_USUARIO') OR define('USUARIO_USUARIO', 'usuario_usuario');
defined('CONTRASENA_USUARIO') OR define('CONTRASENA_USUARIO', 'contrasena_usuario');
defined('ESTADO_USUARIO') OR define('ESTADO_USUARIO', 'estado_usuario');
defined('TIPO_USUARIO') OR define('TIPO_USUARIO', 'tipo_usuario');
defined('FECHA_REGISTRO_USUARIO') OR define('FECHA_REGISTRO_USUARIO', 'fecha_registro_usuario');
defined('FECHA_MODIFICACION_USUARIO') OR define('FECHA_MODIFICACION_USUARIO', 'fecha_modificacion_usuario');

defined('TBL_PROPIETARIOS') OR define('TBL_PROPIETARIOS', 'tbl_propietarios');
defined('ID_PROPIETARIO') OR define('ID_PROPIETARIO', 'id_propietario');
defined('NOMBRES_PROPIETARIO') OR define('NOMBRES_PROPIETARIO', 'nombres_propietario');
defined('APELLIDOS_PROPIETARIO') OR define('APELLIDOS_PROPIETARIO', 'apellidos_propietario');
defined('IDENTIFICACION_PROPIETARIO') OR define('IDENTIFICACION_PROPIETARIO', 'identificacion_propietario');
defined('DIRECCION_PROPIETARIO') OR define('DIRECCION_PROPIETARIO', 'direccion_propietario');
defined('CORREO_ELECTRONICO_PROPIETARIO') OR define('CORREO_ELECTRONICO_PROPIETARIO', 'correo_electronico_propietario');
defined('ESTADO_PROPIETARIO') OR define('ESTADO_PROPIETARIO', 'estado_propietario');
defined('FECHA_REGISTRO_PROPIETARIO') OR define('FECHA_REGISTRO_PROPIETARIO', 'fecha_registro_propietario');
defined('FECHA_MODIFICACION_PROPIETARIO') OR define('FECHA_MODIFICACION_PROPIETARIO', 'fecha_modificacion_propietario');

defined('TBL_PROPIETARIOS_NUMEROS_CONTACTO') OR define('TBL_PROPIETARIOS_NUMEROS_CONTACTO', 'tbl_propietarios_numeros_contacto');
defined('ID_NUMERO_CONTACTO') OR define('ID_NUMERO_CONTACTO', 'id_numero_contacto');
defined('NUMERO_CONTACTO_PROPIETARIO') OR define('NUMERO_CONTACTO_PROPIETARIO', 'numero_contacto_propietario');
defined('ESTADO_NUMERO_CONTACTO') OR define('ESTADO_NUMERO_CONTACTO', 'estado_numero_contacto');
defined('FECHA_REGISTRO_NUMERO_CONTACTO') OR define('FECHA_REGISTRO_NUMERO_CONTACTO', 'fecha_registro_numero_contacto');
defined('FECHA_MODIFICACION_NUMERO_CONTACTO') OR define('FECHA_MODIFICACION_NUMERO_CONTACTO', 'fecha_modificacion_numero_contacto');

defined('TBL_PACIENTES') OR define('TBL_PACIENTES', 'tbl_pacientes');
defined('ID_PACIENTE') OR define('ID_PACIENTE', 'id_paciente');
defined('NOMBRE_PACIENTE') OR define('NOMBRE_PACIENTE', 'nombre_paciente');
defined('ESPECIE_PACIENTE') OR define('ESPECIE_PACIENTE', 'especie_paciente');
defined('RAZA_PACIENTE') OR define('RAZA_PACIENTE', 'raza_paciente');
defined('SEXO_PACIENTE') OR define('SEXO_PACIENTE', 'sexo_paciente');
defined('FECHA_NACIMIENTO_PACIENTE') OR define('FECHA_NACIMIENTO_PACIENTE', 'fecha_nacimiento_paciente');
defined('CHIP_PACIENTE') OR define('CHIP_PACIENTE', 'chip_paciente');
defined('FOTO_PACIENTE') OR define('FOTO_PACIENTE', 'foto_paciente');
defined('DESCRIPCION_PACIENTE') OR define('DESCRIPCION_PACIENTE', 'descripcion_paciente');
defined('ESTADO_PACIENTE') OR define('ESTADO_PACIENTE', 'estado_paciente');
defined('FECHA_REGISTRO_PACIENTE') OR define('FECHA_REGISTRO_PACIENTE', 'fecha_registro_paciente');
defined('FECHA_MODIFICACION_PACIENTE') OR define('FECHA_MODIFICACION_PACIENTE', 'fecha_modificacion_paciente');

defined('TBL_HISTORIAS_CLINICAS') OR define('TBL_HISTORIAS_CLINICAS', 'tbl_historias_clinicas');
defined('ID_HISTORIA_CLINICA') OR define('ID_HISTORIA_CLINICA', 'id_historia_clinica');
defined('ESTADO_HISTORIA_CLINICA') OR define('ESTADO_HISTORIA_CLINICA', 'estado_historia_clinica');
defined('FECHA_HISTORIA_CLINICA') OR define('FECHA_HISTORIA_CLINICA', 'fecha_historia_clinica');
defined('FECHA_REGISTRO_HISTORIA_CLINICA') OR define('FECHA_REGISTRO_HISTORIA_CLINICA', 'fecha_registro_historia_clinica');
defined('FECHA_MODIFICACION_HISTORIA_CLINICA') OR define('FECHA_MODIFICACION_HISTORIA_CLINICA', 'fecha_modificacion_historia_clinica');

defined('TBL_CONSULTAS') OR define('TBL_CONSULTAS', 'tbl_consultas');
defined('ID_CONSULTA') OR define('ID_CONSULTA', 'id_consulta');
defined('ANAMNESIS_CONSULTA') OR define('ANAMNESIS_CONSULTA', 'anamnesis_consulta');
defined('PESO_CONSULTA') OR define('PESO_CONSULTA', 'peso_consulta');
defined('TEMPERATURA_CONSULTA') OR define('TEMPERATURA_CONSULTA', 'temperatura_consulta');
defined('FRECUENCIA_CARDIACA_CONSULTA') OR define('FRECUENCIA_CARDIACA_CONSULTA', 'frecuencia_cardiaca_consulta');
defined('FRECUENCIA_RESPIRATORIA_CONSULTA') OR define('FRECUENCIA_RESPIRATORIA_CONSULTA', 'frecuencia_respiratoria_consulta');
defined('EXAMEN_CLINICO_CONSULTA') OR define('EXAMEN_CLINICO_CONSULTA', 'examen_clinico_consulta');
defined('RECETA_MEDICA_CONSULTA') OR define('RECETA_MEDICA_CONSULTA', 'receta_medica_consulta');
defined('ESTADO_CONSULTA') OR define('ESTADO_CONSULTA', 'estado_consulta');
defined('FECHA_CONSULTA') OR define('FECHA_CONSULTA', 'fecha_consulta');
defined('FECHA_REGISTRO_CONSULTA') OR define('FECHA_REGISTRO_CONSULTA', 'fecha_registro_consulta');
defined('FECHA_MODIFICACION_CONSULTA') OR define('FECHA_MODIFICACION_CONSULTA', 'fecha_modificacion_consulta');

defined('TBL_VACUNAS') OR define('TBL_VACUNAS', 'tbl_vacunas');
defined('ID_VACUNA') OR define('ID_VACUNA', 'id_vacuna');
defined('TIPO_VACUNA') OR define('TIPO_VACUNA', 'tipo_vacuna');
defined('MEDICAMENTO_VACUNA') OR define('MEDICAMENTO_VACUNA', 'medicamento_vacuna');
defined('FECHA_VACUNA') OR define('FECHA_VACUNA', 'fecha_vacuna');
defined('PROXIMA_VACUNA') OR define('PROXIMA_VACUNA', 'proxima_vacuna');
defined('FECHA_REGISTRO_VACUNA') OR define('FECHA_REGISTRO_VACUNA', 'fecha_registro_vacuna');
defined('FECHA_MODIFICACION_VACUNA') OR define('FECHA_MODIFICACION_VACUNA', 'fecha_modificacion_vacuna');
defined('ESTADO_VACUNA') OR define('ESTADO_VACUNA', 'estado_vacuna');

defined('TBL_PLANES_MEDICINA_PREPAGADA') OR define('TBL_PLANES_MEDICINA_PREPAGADA', 'tbl_planes_medicina_prepagada');
defined('ID_PLAN_MEDICINA_PREPAGADA') OR define('ID_PLAN_MEDICINA_PREPAGADA', 'id_plan_medicina_prepagada');
defined('NOMBRE_PLAN_MEDICINA_PREPAGADA') OR define('NOMBRE_PLAN_MEDICINA_PREPAGADA', 'nombre_plan_medicina_prepagada');
defined('DESCRIPCION_PLAN_MEDICINA_PREPAGADA') OR define('DESCRIPCION_PLAN_MEDICINA_PREPAGADA', 'descripcion_plan_medicina_prepagada');
defined('DURACION_PLAN_MEDICINA_PREPAGADA') OR define('DURACION_PLAN_MEDICINA_PREPAGADA', 'duracion_plan_medicina_prepagada');
defined('ESTADO_PLAN_MEDICINA_PREPAGADA') OR define('ESTADO_PLAN_MEDICINA_PREPAGADA', 'estado_plan_medicina_prepagada');
defined('FECHA_REGISTRO_PLAN_MEDICINA_PREPAGADA') OR define('FECHA_REGISTRO_PLAN_MEDICINA_PREPAGADA', 'fecha_registro_plan_medicina_prepagada');
defined('FECHA_MODIFICACION_PLAN_MEDICINA_PREPAGADA') OR define('FECHA_MODIFICACION_PLAN_MEDICINA_PREPAGADA', 'fecha_modificacion_plan_medicina_prepagada');

defined('TBL_PLANES_MEDICINA_PREPAGADA_BENEFICIOS') OR define('TBL_PLANES_MEDICINA_PREPAGADA_BENEFICIOS', 'tbl_planes_medicina_prepagada_beneficios');
defined('NOMBRE_BENEFICIO') OR define('NOMBRE_BENEFICIO', 'nombre_beneficio');
defined('CANTIDAD_BENEFICIO') OR define('CANTIDAD_BENEFICIO', 'cantidad_beneficio');

defined('TBL_AFILIACIONES') OR define('TBL_AFILIACIONES', 'tbl_afiliaciones');
defined('ID_AFILIACION') OR define('ID_AFILIACION', 'id_afiliacion');
defined('FECHA_INICIO_AFILIACION') OR define('FECHA_INICIO_AFILIACION', 'fecha_inicio_afiliacion');
defined('FECHA_FIN_AFILIACION') OR define('FECHA_FIN_AFILIACION', 'fecha_fin_afiliacion');
defined('ESTADO_AFILIACION') OR define('ESTADO_AFILIACION', 'estado_afiliacion');
defined('FECHA_REGISTRO_AFILIACION') OR define('FECHA_REGISTRO_AFILIACION', 'fecha_registro_afiliacion');
defined('FECHA_MODIFICACION_AFILIACION') OR define('FECHA_MODIFICACION_AFILIACION', 'fecha_modificacion_afiliacion');

defined('TBL_AFILIACIONES_BENEFICIOS') OR define('TBL_AFILIACIONES_BENEFICIOS', 'tbl_afiliaciones_beneficios');
defined('ID_AFILIACION_BENEFICIO') OR define('ID_AFILIACION_BENEFICIO', 'id_afiliacion_beneficio');
defined('USADO_BENEFICIO') OR define('USADO_BENEFICIO', 'usado_beneficio');