<?php

//configurando o PHP para mostrar os erros na tela
ini_set('display_errors', 1);
 
//configurando o PHP para reportar todo e qualquer erro
error_reporting(E_ALL);
 
require_once 'lib/Application.php';
$o_Application = new Application();
$o_Application->dispatch();