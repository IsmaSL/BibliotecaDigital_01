<?php
/*Archivo:  ctrlBuscaMateriales.php
Objetivo: control para buscar materiales de biblioteca
Autor:    ISL
*/
include_once("../modelo/Libro.php");
include_once("../modelo/Revista.php");
include_once("../modelo/Multa.php");
include_once("../modelo/ErroresAplic.php");
$nErr=-1;
$nNum=0;
$oMaterial=null;
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
				$oMaterial = new Libro();
				$arrEncontrados = $oMaterial->buscarTodos();
			}else if ($nNum==2){
				$oMaterial = new Revista();
				$arrEncontrados = $oMaterial->buscarTodos();
			}else
				$nErr = ErroresAplic::ERROR_TIPO_MAT;
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
			"montoMulta":'.Multa::$nCostoPorDia.',
			"arrMateriales": [
		';
		//Recorrer arreglo para llenar objetos
		foreach($arrEncontrados as $oMat){
			$sJsonRet = $sJsonRet.'{
					"id": '.$oMat->getIdMaterial().', 
					"nombre":"'.$oMat->getNombre().'",
					"is":"'.(($oMat instanceOf Libro)?$oMat->getISBN():$oMat->getISSN()).'"
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
			"montoMulta":-1,
			"arrMateriales": []
		}';
	}
	echo $sJsonRet;
?>