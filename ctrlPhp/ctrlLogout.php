<?php
/*Archivo:  ctrlLogout.php
Objetivo: control para terminar sesión
Autor:    ISL
*/
include_once("../modelo/EmpleadoBiblioteca.php");
include_once("../modelo/ErroresAplic.php");
session_start(); //Le avisa al servidor que va a utilizar sesiones
	session_destroy();
	header("Location: ../index.php");
?>