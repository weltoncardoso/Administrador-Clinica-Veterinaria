<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mx1.hostinger.co';
$config['smtp_port'] = 2525;
$config['smtp_user'] = 'info@dogmedicat.com'; // correo sin espacio
$config['smtp_pass'] = 'jJd5Z2nYufxh';
$config['smtp_timeout'] = '10';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['mailtype'] = 'html'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not