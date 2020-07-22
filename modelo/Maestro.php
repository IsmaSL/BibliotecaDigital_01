<?php
/*************************************************************/
/* Estudiante.php
 * Objetivo: clase que encapsula el manejo de la entidad Estudiante
 * Autor: ISL
 *************************************************************/
error_reporting(E_ALL);
// Hcae referencia al archivo de usuario y extiende al mismo
include_once("UsuarioBiblioteca.php");
class Maestro extends UsuarioBiblioteca{
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
	$arrMaestros = null;
	$arrLinea=null;
	$j=0;
	$oMaestro=null;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT sidentificador, snombre, sprimerape, ssegundoape, stipo FROM usuariobiblioteca WHERE stipo = 'M'";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $arrLinea){
					$oMaestro = new Maestro();
					$oMaestro->setIdentificador($arrLinea[0]);
					$oMaestro->setNombre($arrLinea[1]);
					$oMaestro->setPrimApellido($arrLinea[2]);
					$oMaestro->setSegApellido($arrLinea[3]);
					$oMaestro->setTipo($arrLinea[4]);
            		$arrMaestros[$j] = $oMaestro;
					$j=$j+1;
                }
			}
        }
		return $arrMaestros;
	}
}
?> 