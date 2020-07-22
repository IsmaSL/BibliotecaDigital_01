<?php
/*Archivo:  ctrlLogin.php
Objetivo: control para iniciar sesión
Autor:    ISL
*/
include_once("../modelo/EmpleadoBiblioteca.php");
include_once("../modelo/ErroresAplic.php");
session_start(); //Le avisa al servidor que va a utilizar sesiones
$nErr=-1;
$oEmpleado=new EmpleadoBiblioteca();
$sJsonRet = "";
	/*Verifica que hayan llegado los datos*/
	if (isset($_REQUEST["txtCuenta"]) && !empty($_REQUEST["txtCuenta"]) &&
		isset($_REQUEST["txtPwd"]) && !empty($_REQUEST["txtPwd"])){
		try{
			//Pasa los datos al objeto
			$oEmpleado->setCuenta($_REQUEST["txtCuenta"]);
			$oEmpleado->setContrasenia($_REQUEST["txtPwd"]);
			//Busca en la base de datos
			if ($oEmpleado->buscarCvePwd()){
				//Guarda el empleado firmado en una variable de sesión
				$_SESSION["usrFirmado"] = $oEmpleado;
			}else
				$nErr = ErroresAplic::USR_DESCONOCIDO;
		}catch(Exception $e){
			//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$nErr = ErroresAplic::ERROR_EN_BD;
		}
	}
	else
		$nErr = ErroresAplic::FALTAN_DATOS;
	
	if ($nErr==-1){
		$sJsonRet = '{
			"sNombreCompleto":"'.$oEmpleado->getNombreCompleto().'",
			"sDescTipo":"'.$oEmpleado->getDescripTipo().'",
			"nTipo":'.$oEmpleado->getTipo().'
		}';
	}
	else{
		$oErr = new ErroresAplic();
		$oErr->setError($nErr);
		$sJsonRet = '{
			"sNombreCompleto":"'.$oErr->getTextoError().'",
			"sDescTipo":"",
			"nTipo":-1
		}';
	}
	echo $sJsonRet;
?>