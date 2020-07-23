<?php
/*************************************************************/
/* Libro.php
 * Objetivo: clase que encapsula el manejo de la entidad Libro
 * Autor: ISL
 *************************************************************/
error_reporting(E_ALL);
include_once("Material.php");
class Libro extends Material{
	protected $sAutor="";
	protected $sISBN="";
	protected $sEditorial="";
	
	public function setAutor($value){
       $this->sAutor = $value;
    }
    public function getAutor(){
       return $this->sAutor;
    }
	
	public function setISBN($value){
       $this->sISBN = $value;
    }
    public function getISBN(){
       return $this->sISBN;
    }
	
	public function setEditorial($value){
       $this->sEditorial = $value;
    }
    public function getEditorial(){
       return $this->sEditorial;
    }
	
	/*Busca todos los libros, regresa nulos si no hay información o 
	  un arreglo de libros*/
	function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrMateriales = null;
	$arrLinea=null;
	$j=0;
	$oMaterial=null;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT t1.nIdMaterial, t1.sNombre, t1.nPrecio,
							  t2.sAutor, t2.sISBN, t2.sEditorial
						FROM material t1, libro t2
						WHERE t2.nIdMaterial = t1.nIdMaterial
						ORDER BY t1.nIdMaterial";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $arrLinea){
					$oMaterial = new Libro();
					$oMaterial->setIdMaterial($arrLinea[0]);
					$oMaterial->setNombre($arrLinea[1]);
					$oMaterial->setPrecio($arrLinea[2]);
					$oMaterial->setAutor($arrLinea[3]);
					$oMaterial->setISBN($arrLinea[4]);
					$oMaterial->setEditorial($arrLinea[5]);
            		$arrMateriales[$j] = $oMaterial;
					$j=$j+1;
                }
			}
        }
		return $arrMateriales;
	}
}
?>