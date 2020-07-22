<?php
/*************************************************************/
/* UsuarioBiblioteca.php
 * Objetivo: clase que encapsula el manejo de la entidad UsuarioBiblioteca
 * Autor: BAOZ
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");
abstract class UsuarioBiblioteca{
/*En este caso los atributos son protegidos (en lugar de privados)
  para utilizarlos en la herencia*/
protected $sNombre="";
protected $sPrimApellido="";
protected $sSegApellido="";
   
    public function setNombre($psNombre){
       $this->sNombre = $psNombre;
    }
    public function getNombre(){
       return $this->sNombre;
    }
   
    public function setPrimApellido($valor){
       $this->sPrimApellido = $valor;
    }
    public function getPrimApellido(){
       return $this->sPrimApellido;
    }
   
    public function setSegApellido($psSegApe){
       $this->sSegApellido = $psSegApe;
    }
    public function getSegApellido(){
       return $this->sSegApellido;
	}
	
	public function getNombreCompleto(){
		return $this->sNombre." ".$this->sPrimApellido." ".$this->sSegApellido;
	}
}
?>