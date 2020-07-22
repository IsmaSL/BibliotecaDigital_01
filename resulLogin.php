<?php
/*Archivo:  resulLogin.php
Objetivo: resultado (vista) de login, presenta mensaje de bienvenida
Autor:    ISL
*/
include_once("modelo/EmpleadoBiblioteca.php");
include_once("modelo/ErroresAplic.php");
session_start(); //Le avisa al servidor que va a utilizar sesiones
$nErr=-1;
$oFirmado=null;
	/*Verificar que exista el objeto de sesión*/
	if (isset($_SESSION["usrFirmado"])){
		$oFirmado = $_SESSION["usrFirmado"];
	}
	else
		$nErr = ErroresAplic::SIN_SESION;
	
	if ($nErr != -1){
		header("Location: error.php?nError=".$nErr);
		exit();
	}
include_once("cabecera.php");
include_once("menu.php");
include_once("latIzq.html");
?>
	<section>
		<h4>Hola <?php echo $oFirmado->getNombreCompleto();?></h4>
		<h5>Eres tipo <?php echo $oFirmado->getDescripTipo();?></h5>
    </section>
<?php
include_once("latDcha.html");
include_once("pie.html");
?>