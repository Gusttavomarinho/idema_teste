<?php
session_start();
locale_set_default('America/Sao_Paulo');
date_default_timezone_set('America/Sao_Paulo');

require 'config.php';
require 'vendor/autoload.php';

$core = new Core\Core();
$core->run();
