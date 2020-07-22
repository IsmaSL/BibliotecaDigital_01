<?php
/*Archivo:  ctrlFrm.php
Objetivo: control para buscar materiales de biblioteca
Autor:    ISL
*/
include_once("../modelo/Estudiante.php");
include_once("../modelo/Maestro.php");
include_once("../modelo/ErroresAplic.php");
include_once("../modelo/UsuarioBiblioteca.php");
$nErr=-1;
$nNum=0;
$oUsuario=null;
$arrEncontrados=null;
$sJsonRet = "";
$oErr = null;
    /*Verifica que haya llegado el tipo*/
    if (isset($_REQUEST["cmbTipo"]) && !empty($_REQUEST["cmbTipo"])){
        try{
            //Convierte el tipo indicado a número
            $nNum = intval(($_REQUEST["cmbTipo"]),10);
            
            //Busca en la base de datos de acuerdo al tipo indicado
			if ($nNum==1){
				$oUsuario = new Estudiante();
				$arrEncontrados = $oUsuario->buscarTodos();
			}else if ($nNum==2){
				$oUsuario = new Maestro();
				$arrEncontrados = $oUsuario->buscarTodos();
			}else
				$nErr = ErroresAplic::ERROR_TIPO_USR;
        }catch(Exception $e){
            //Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
            error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
            $nErr = ErroresAplic::ERROR_EN_BD;
        }
    }
    else
		$nErr = ErroresAplic::FALTAN_DATOS;
		
	if ($nErr==-1){
        $sJsonRet = 
        '{
            "success":true,
            "situacion": "ok",
            "arrUsuarios": [
        ';
        //Recorrer arreglo para llenar objetos
		foreach($arrEncontrados as $oUsr){
			$sJsonRet = $sJsonRet.'{
					"id": '.$oUsr->getIdentificador().', 
					"nombre":"'.$oUsr->getNombreCompleto().'"
					},';
        }
        //Sobra una coma, eliminarla
		$sJsonRet = substr($sJsonRet,0, strlen($sJsonRet)-1);
		
		//Colocar cierre de arreglo y de objeto
		$sJsonRet = $sJsonRet.'
			]
		}';
	}else{
		$oErr = new ErroresAplic();
		$oErr->setError($nErr);
		$sJsonRet = 
		'{
			"success":false,
			"situacion": "'.$oErr->getTextoError().'",
			"arrUsuarios": []
		}';
	}
	echo $sJsonRet;
?>