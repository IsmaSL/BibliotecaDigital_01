<!--
Archivo:  menu.php
Objetivo: menú reutilizable
Autor:    ISL
-->
	<nav>
		<?php
			if (isset($_SESSION["usrFirmado"])){
		?>
			<a id="menuInicio" href="resulLogin.php" class="menu">Inicio</a>
			<a id="menuMateriales" href="buscaMateriales.php" class="menu">Consultar materiales</a>
			<a id="menuUsuarios" href="buscaUsuarios.php" class="menu">Consultar usuarios</a>
			<a id="menuSalir" href="ctrlPhp/ctrlLogout.php" class="menu">Salir</a>
		<?php
			}else{
		?>
			<a id="menuInicio" href="index.php" class="menu">Inicio</a>
			<a id="menuMateriales" href="buscaMateriales.php" class="menu">Consultar materiales</a>
			<a id="menuUsuarios" href="#" class="menu"></a>
			<a id="menuSalir" href="#" class="menu"></a>
		<?php
			}
		?>
	</nav>