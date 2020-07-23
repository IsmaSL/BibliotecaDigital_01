<?php
/*************************************************************/
/* EmpleadoBiblioteca.php
 * Objetivo: clase que encapsula el manejo de la entidad EmpleadoBiblioteca
 * Autor: ISL
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");
class EmpleadoBiblioteca{
private $sCuenta="";
private $sContrasenia="";
private $sNombreCompleto="";
private $nTipo=-1;
//Constantes para facilitar lectura de tipo
CONST BIBLIOTECARIO = 1;
CONST CATALOGADOR = 2;
CONST ADMINISTRADOR = 3;
//No existe en el modelo, pero facilita el manejo de las restricciones
private static $arrTipos=array(
							self::BIBLIOTECARIO.""=>"Bibliotecario",
							self::CATALOGADOR.""=>"Catalogador",
							self::ADMINISTRADOR.""=>"Administrador"
						);
   
	function setCuenta($value){
       $this->sCuenta = $value;
	}
	function getCuenta(){
       return $this->sCuenta;
	}
   
	function setNombreCompleto($value){
       $this->sNombreCompleto = $value;
	}
	function getNombreCompleto(){
       return $this->sNombreCompleto;
	}
   
	function setContrasenia($value){
       $this->sContrasenia = $value;
	}
	function getContrasenia(){
       return $this->sContrasenia;
	}
   
	function setTipo($value){
       $this->nTipo = $value;
	}
	function getTipo(){
       return $this->nTipo;
	}
	public function getDescripTipo(){
	$sRet="";
		if ($this->nTipo >0 &&
			array_key_exists($this->nTipo."", self::$arrTipos))
			$sRet = self::$arrTipos[$this->nTipo.""];
		return $sRet;
	}
	
	//No existe set porque la información es fija
	public function getTipos(){
		return self::$arrTipos;
	}
   
	/*Busca por clave y contraseña, regresa verdadero si lo encontró*/
	function buscarCvePwd(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$bRet = false;
		if (empty($this->sCuenta) || empty($this->sContrasenia))
			throw new Exception("EmpleadoBiblioteca->buscarCvePwd(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = "SELECT sNombreCompleto, nTipo 
					FROM EmpleadoBiblioteca 
					WHERE sCuenta = '".$this->sCuenta."' 
					AND sPassword = '".$this->sContrasenia."'";
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
				error_log($sQuery,0);
				$oAccesoDatos->desconectar();
				if ($arrRS){
					$this->sNombreCompleto = $arrRS[0][0];
					$this->nTipo = (int)$arrRS[0][1];
					$bRet = true;
				}
			} 
		}
		return $bRet;
	}
 }
 ?>