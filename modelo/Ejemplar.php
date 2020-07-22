<?php
/*************************************************************/
/* Ejemplar.php
 * Objetivo: clase que encapsula el manejo de la entidad Ejemplar 
 *           ("copia" física de un material)
 * Autor: BAOZ
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");
include_once("Material.php");
include_once("Prestamo.php");
class Ejemplar {
	private $sCodBarras;
	private $sSituacion;
	private $dFecCambioSit=null;
	private $arrPrestamos = array();
	private $oMaterial=null;
	//No existe en el modelo, pero facilita el manejo de las restricciones
	private static $arrSituaciones=array(
								"EC"=>"En circulación",
								"PR"=>"Prestado",
								"PE"=>"Perdido",
								"RO"=>"Robado",
								"DA"=>"Dañado"
							);
	
	public function setCodBarras($value){
		$this->sCodBarras = $value;
	}
	public function getCodBarras(){
		return $this->sCodBarras;
	}
	
	public function setSituacion($value){
		$this->sSituacion = $value;
	}
	public function getSituacion(){
		return $this->sSituacion;
	}
	public function getDescripSituacion(){
	$sRet="";
		if ($this->sSituacion != "" &&
			array_key_exists($this->sSituacion, self::$arrSituaciones))
			$sRet = self::$arrSituaciones[$this->sSituacion];
		return $sRet;
	}
	
	public function setFecCambioSit($value){
		$this->dFecCambioSit = $value;
	}
	public function getFecCambioSit(){
		return $this->dFecCambioSit;
	}
	
	public function setPrestamos($value){
		$this->arrPrestamos = $value;
	}
	public function getPrestamos(){
		return $this->arrPrestamos;
	}
	
	public function setMaterial($value){
		$this->oMaterial = $value;
	}
	public function getMaterial(){
		return $this->oMaterial;
	}
	
	//No existe set porque la información es fija
	public function getSituaciones(){
		return self::$arrSituaciones;
	}
}
?>