<?php
/*************************************************************/
/* Archivo:  cabecera.php
 * Objetivo: cabecera y encabezado de páginas reutilizable, 
 *		  maneja una hoja de estilos mínima, 
 *		  incluye consideraciones para sesiones
 * Autor:    ISL
 *************************************************************/
include_once("modelo/EmpleadoBiblioteca.php");
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ejemplo Multicapas con Base de Datos y Estilos m&iacute;nimos</title>
        <meta charset="utf-8"/>
		<link href="css/trad4.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
		<header>
			<figure class="logo">
				<img src="media/logo.png" border="0"/>
			</figure>
			<h2 id="titPral">Cabecera de p&aacute;gina (t&iacute;tulo, logo, eslogan)</h2>
		</header>