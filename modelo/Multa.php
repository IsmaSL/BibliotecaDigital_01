<?php
/*************************************************************/
/* Multa.php
 * Objetivo: clase que encapsula el manejo de la entidad Multa
 * Autor: BAOZ
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");
include_once("Prestamo.php");
class Multa {
	private $nIdMulta;
	public static $nCostoPorDia;
	private $nMontoMulta;
	private $dFecPago;
	
	//La función es necesaria porque no existen los bloques estáticos en PHP
	public static function init(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrLinea=null;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT t1.svalor
						FROM atributosdeclase t1
						WHERE t1.sClase = 'Multa'
						AND t1.sAtributo = 'sCostoPorDia'";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				self::$nCostoPorDia = $arrRS[0][0];
			}
		}
	}
}
//Esta línea es necesaria porque no existen los bloques estáticos en PHP
Multa::init();
?>