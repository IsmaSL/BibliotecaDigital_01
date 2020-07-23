<?php
/*************************************************************/
/* Revista.php
 * Objetivo: clase que encapsula el manejo de la entidad Revista
 * Autor: ISL
 *************************************************************/
error_reporting(E_ALL);
include_once("Material.php");
class Revista extends Material{
	protected $sISSN="";
	protected $dFecPublicacion=null;
	
	public function setISSN($value){
       $this->sISSN = $value;
    }
    public function getISSN(){
       return $this->sISSN;
    }
	
	public function setFecPublicacion($value){
       $this->dFecPublicacion = $value;
    }
    public function getFecPublicacion(){
       return $this->dFecPublicacion;
    }
	
	/*Busca todas las revistas, regresa nulos si no hay información o 
	  un arreglo de revistas*/
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
							  t2.sISSN, t2.dPublicacion
						FROM material t1, revista t2
						WHERE t2.nIdMaterial = t1.nIdMaterial
						ORDER BY t1.nIdMaterial";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $arrLinea){
					$oMaterial = new Revista();
					$oMaterial->setIdMaterial($arrLinea[0]);
					$oMaterial->setNombre($arrLinea[1]);
					$oMaterial->setPrecio($arrLinea[2]);
					$oMaterial->setISSN($arrLinea[3]);
					$oMaterial->setFecPublicacion(
								DateTime::createFromFormat('Y-m-d',$arrLinea[4]));
            		$arrMateriales[$j] = $oMaterial;
					$j=$j+1;
                }
			}
        }
		return $arrMateriales;
	}
}
?>