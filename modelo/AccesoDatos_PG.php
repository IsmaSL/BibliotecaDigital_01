<?php
/*************************************************************/
/* AccesoDatos.php
 * Objetivo: clase que encapsula el acceso a la base de datos (PostgreSQL)
 * Autor: BAOZ
 *************************************************************/
 error_reporting(E_ALL);
 class AccesoDatos{
 private $nConexion=-1; 
		/*Realiza la conexión a la base de datos*/
     	function conectar(){
		$bRet = false;
			try{
				$this->nConexion = pg_connect("host=localhost port=5432 user=usubiblio password=usubiblio1 dbname=bibliodb", PGSQL_CONNECT_FORCE_NEW);
			}catch(Exception $e){
				throw $e;
			}
			if (!$this->nConexion)
				throw new Exception("Error al conectar");
			else
				$bRet = true;
			return $bRet;
		}
		
		/*Realiza la desconexión de la base de datos*/
     	function desconectar(){
		$bRet = true;
			if ($this->nConexion != -1){
				$bRet = pg_close($this->nConexion);
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
		$arrLin = null;
		$sValCol = "";
		$i=0;
		$j=0;
			if ($psConsulta == ""){
		       throw new Exception("AccesoDatos->ejecutarConsulta: falta indicar la consulta");
			}
			if ($this->nConexion == -1){
				throw new Exception("AccesoDatos->ejecutarConsulta: falta conectar la base");
			}
			try{
				$rst = pg_query($this->nConexion, $psConsulta);
			}catch(Exception $e){
				throw $e;
			}
			if ($rst){
				while($arrLin = pg_fetch_row($rst)){ 
					foreach($arrLin as $sValCol){
						$arrRS[$i][$j] = $sValCol;
						$j++;
					}
					$j=0;
					$i++;
				}
			}
			else{
				throw new Exception($this->nConexion->error);
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
			if ($this->nConexion == -1){
				throw new Exception("AccesoDatos->ejecutarComando: falta conectar la base");
			}
			try{
	       	   $bResult=pg_query($this->nConexion, $psComando);
			   $nAfectados = pg_affected_rows($bResult);
			}catch(Exception $e){
				throw $e;
			}
			return $nAfectados;
		}
	}
 ?>