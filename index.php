<?php
/*
Archivo:  index.php
Objetivo: inicio del ejemplo de manejo de sesiones y login
Autor:    ISL
*/
session_start();
include_once("cabecera.php");
include_once("menu.php");
include_once("latIzq.html");
?>
	<section>
        <script src="js/ctrlLogin.js"></script>
        <br>
        <form id="frmLogin" onsubmit="llamaLogin(txtCuenta.value, txtPwd.value); return false;" style="display:block;">
        <table>
                <tr>
                    <td>
                        <label for="txtCuenta">Cuenta:</label></td>
                    <td>
                        <input type="text" name="txtCuenta" required size="14"
							pattern="[a-zA-Z0-9]{8,12}"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="txtPwd">Contrase&ntilde;a:</label></td>
                    <td>
                        <input type="password" name="txtPwd" required size="10"
							pattern="[a-zA-Z0-9@_'-']{8}"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Enviar" name="btnEnviar"/>
                    </td>
                </tr>
            </table>
        </form>
        <div id="bienvenido" style="display:none">
			<h4>Hola <span id="paraNombre"></span></h4>
			<h5>Eres tipo <span id="paraTipo"></span></h5>
		</div>
    </section>
<?php
include_once("latDcha.html");
include_once("pie.html");
?>