<?php
/*************************************************************/
/* Prestamo.php
 * Objetivo: clase que encapsula el manejo de la entidad Prestamo
 * Autor: BAOZ
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");
include_once("UsuarioBiblioteca.php");
include_once("Ejemplar.php");
class Prestamo {
	private $nIdPrestamo;
	private $sSituacion;
	private $dFecRegistro=null;
	private $dFecEsperadaDevol=null;
	private $dFecRealDevol=null;
	private $arrEjemplares = array();
	private $oUsuarioBiblioteca=null;
	private $oEmpleadoBiblioteca=null;
	private $oMulta;
	//No existe en el modelo, pero facilita el manejo de las restricciones
	private static $arrSituaciones=array(
								"N"=>"Nuevo",
								"D"=>"Devuelto",
								"P"=>"Perdido"
							);
	
	public function setIdPrestamo($value){
		$this->nIdPrestamo = $value;
	}
	public function getIdPrestamo(){
		return $this->nIdPrestamo;
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
	
	public function setFecRegistro($value){
		$this->dFecRegistro = $value;
	}
	public function getFecRegistro(){
		return $this->dFecRegistro;
	}
	
	public function setFecEsperadaDevol($value){
		$this->dFecEsperadaDevol = $value;
	}
	public function getFecEsperadaDevol(){
		return $this->dFecEsperadaDevol;
	}
	
	public function setFecRealDevol($value){
		$this->dFecRealDevol = $value;
	}
	public function getFecRealDevol(){
		return $this->dFecRealDevol;
	}
	
	public function setEjemplares($value){
		$this->arrEjemplares = $value;
	}
	public function getEjemplares(){
		return $this->arrEjemplares;
	}
	
	public function setUsuarioBiblioteca($value){
		$this->oUsuarioBiblioteca = $value;
	}
	public function getUsuarioBiblioteca(){
		return $this->oUsuarioBiblioteca;
	}
	
	public function setEmpleadoBiblioteca($value){
		$this->oEmpleadoBiblioteca = $value;
	}
	public function getEmpleadoBiblioteca(){
		return $this->oEmpleadoBiblioteca;
	}
	
	public function setMulta($value){
		$this->oMulta = $value;
	}
	public function getMulta(){
		return $this->oMulta;
	}
	
	//No existe set porque la información es fija
	public function getSituaciones(){
		return self::$arrSituaciones;
	}
}
?>