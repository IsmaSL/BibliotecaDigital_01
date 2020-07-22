<?php
/*
Archivo:  buscaMateriales.php
Objetivo: formulario para buscar materiales
Autor:    ISL
*/
include_once("modelo/ErroresAplic.php");
session_start(); //Le avisa al servidor que va a utilizar sesiones
$nErr=-1;
$oFirmado=null;
	/*Verificar que exista el objeto de sesión*/
	if (isset($_SESSION["usrFirmado"])){
		$oFirmado = $_SESSION["usrFirmado"];
	}
	else
		$nErr = ErroresAplic::SIN_SESION;
	
	if ($nErr != -1){
		header("Location: error.php?nError=".$nErr);
		exit();
	}
include_once("cabecera.php");
include_once("menu.php");
include_once("latIzq.html");
?>
	<section>
        <script src="js/ctrlBuscaUsuarios.js"></script>
        <script>
            function oculta(){
            var frmFiltros = document.getElementById("frmBuscaUsuarios");
            var divDatos = document.getElementById("resBuscaUsuarios");
                if (frmFiltros == null || divDatos == null)
                    alert("Error en HTML");
                else{
                    frmFiltros.style.display="block";
                    divDatos.style.display="none";
                }
		    }
        </script>
        <br>
        <form id="frmBuscaUsuarios" onsubmit="llamaBuscaUsuarios(); return false;" style="display:block">
            <table>
                <tr>
                    <td>
                        <label for="cmbTipoUse">Tipo de usuario:</label></td>
                    <td>
                        <select id="cmbTipoUse">
							<option value="1">Estudiante</option>
							<option value="2">Maestro</option>
						</select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Enviar" name="btnEnviar"/>
                    </td>
                </tr>
            </table>
        </form>
        <div id="resBuscaUsuarios" style="display:none">
            <h4>Usuarios encontrados</h4>
            <table border="1" id="tblUsuarios">
                <thead>
                    <tr>
                        <td>Id</td>
	    	    	    <td>Nombre</td>
                    </tr>
                </thead>
                <tbody id="tblBodyUsuarios">
                </tbody>
            </table>
            <br>
            <input type="button" value="Regresar" onclick="oculta()"/>
        </div>
    </section>
<?php
include_once("latDcha.html");
include_once("pie.html");
?>