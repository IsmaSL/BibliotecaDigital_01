<?php
/*************************************************************/
/* Estudiante.php
 * Objetivo: clase que encapsula el manejo de la entidad Estudiante
 * Autor: ISL
 *************************************************************/
error_reporting(E_ALL);
// Hcae referencia al archivo de metarial y extiende al mismo
include_once("UsuarioBiblioteca.php");
class Estudiante extends UsuarioBiblioteca{
	protected $sTipo="";
	protected $sIdentificador="";

	public function setIdentificador($value){
		$this->sIdentificador = $value;
	}
	public function getIdentificador(){
		return $this->sIdentificador;
	}
	
	public function setTipo($value){
       $this->sTipo = $value;
    }
    public function getTipo(){
       return $this->sTipo;
    }
	
	/*Busca todos los Estudiantes, regresa nulos si no hay información o 
	  un arreglo de Eestudiantes*/
	function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrEstudiantes = null;
	$arrLinea=null;
	$j=0;
	$oEstudiante=null;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT sidentificador, snombre, sprimerape, ssegundoape, stipo FROM usuariobiblioteca WHERE stipo = 'E'";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $arrLinea){
					$oEstudiante = new Estudiante();
					$oEstudiante->setIdentificador($arrLinea[0]);
					$oEstudiante->setNombre($arrLinea[1]);
					$oEstudiante->setPrimApellido($arrLinea[2]);
					$oEstudiante->setSegApellido($arrLinea[3]);
					$oEstudiante->setTipo($arrLinea[4]);
            		$arrEstudiantes[$j] = $oEstudiante;
					$j=$j+1;
                }
			}
        }
		return $arrEstudiantes;
	}
}
?> 