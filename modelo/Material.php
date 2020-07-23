<?php
/*************************************************************/
/* Material.php
 * Objetivo: clase que encapsula el manejo de la entidad Material
 * Autor: ISL
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");
include_once("Ejemplar.php");
abstract class Material {
	protected $nIdMaterial=0;
	protected $sNombre="";
	protected $nPrecio=0.0;
	protected $arrEjemplares=array();
	
	public function setIdMaterial($value){
       $this->nIdMaterial = $value;
    }
    public function getIdMaterial(){
       return $this->nIdMaterial;
    }
	
	public function setNombre($value){
       $this->sNombre = $value;
    }
    public function getNombre(){
       return $this->sNombre;
    }
	
	public function setPrecio($value){
       $this->nPrecio = $value;
    }
    public function getPrecio(){
       return $this->nPrecio;
    }
	
	public function setEjemplares($value){
       $this->arrEjemplares = $value;
    }
    public function getEjemplares(){
       return $this->arrEjemplares;
    }
}
?>