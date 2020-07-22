<?php
/*************************************************************/
/* AccesoDatos.php
 * Objetivo: clase que encapsula el acceso a la base de datos
 * Autor: BAOZ
 *************************************************************/
 error_reporting(E_ALL);
 class AccesoDatos{
 private $oConexion=null; 
		/*Realiza la conexión a la base de datos*/
     	function conectar(){
		$bRet = false;
			try{
				$this->oConexion = new mysqli("localhost", "usubiblio", "usubiblio1", "bibliodb");
				$this->oConexion->set_charset("utf8");
			}catch(Exception $e){
				throw $e;
			}
			if (mysqli_connect_error())
				throw new Exception(mysqli_connect_error());
			else
				$bRet = true;
			return $bRet;
		}
		
		/*Realiza la desconexión de la base de datos*/
     	function desconectar(){
		$bRet = true;
			if ($this->oConexion != null){
				$bRet = $this->oConexion->close();
			}
			return $bRet;
		}
		
		/*Ejecuta en la base de datos la consulta que recibió por parámetro.
		Regresa
			Nulo si no hubo datos
			Un arreglo bidimensional de n filas y tantas columnas como campos se hayan
			solicitado en la consulta*/
      	function ejecutarConsulta($psConsulta){
		$arrRS = null;
		$rst = null;
		$oDato = null;
		$sValCol = "";
		$i=0;
		$j=0;
			if ($psConsulta == ""){
		       throw new Exception("AccesoDatos->ejecutarConsulta: falta indicar la consulta");
			}
			if ($this->oConexion == null){
				throw new Exception("AccesoDatos->ejecutarConsulta: falta conectar la base");
			}
			try{
				$rst = $this->oConexion->query($psConsulta);
			}catch(Exception $e){
				throw $e;
			}
			if ($this->oConexion->error == ""){
				while($oDato = $rst->fetch_object()){ 
					foreach($oDato as $sValCol){
						$arrRS[$i][$j] = $sValCol;
						$j++;
					}
					$j=0;
					$i++;
				}
				$rst->close();
			}
			else{
				throw new Exception($this->oConexion->error);
			}
			return $arrRS;
		}
		
		/*Ejecuta en la base de datos el comando que recibió por parámetro
		Regresa
			el número de registros afectados por el comando*/
      	function ejecutarComando($psComando){
		$nAfectados = -1;
	       if ($psComando == ""){
		       throw new Exception("AccesoDatos->ejecutarComando: falta indicar el comando");
			}
			if ($this->oConexion == null){
				throw new Exception("AccesoDatos->ejecutarComando: falta conectar la base");
			}
			try{
	       	   $this->oConexion->multi_query($psComando);
			   $nAfectados = $this->oConexion->affected_rows;
			}catch(Exception $e){
				throw $e;
			}
			return $nAfectados;
		}
	}
 ?>