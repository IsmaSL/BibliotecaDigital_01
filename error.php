<?php
/*************************************************************/
/* Archivo:  error.php
 * Objetivo: manejo de errores
 * Autor:    ISL
 *************************************************************/
include_once("modelo/ErroresAplic.php");
$oErr = new ErroresAplic();
include_once("cabecera.php");
include_once("menu.php");
include_once("latIzq.html");
?>
	<section>
		<h1>Error</h1>
		<h4>
			<?php 
				if (isset($_REQUEST["nError"])){
					$oErr->setError($_REQUEST["nError"]);
					echo $oErr->getTextoError();
				}else{
					echo "Otro error";
				}
			?>
		</h4>
    </section>
<?php
include_once("latDcha.html");
include_once("pie.html");
?>