<?php
/*
Archivo:  buscaMateriales.php
Objetivo: formulario para buscar materiales
Autor:    ISL
*/
include_once("cabecera.php");
include_once("menu.php");
include_once("latIzq.html");
?>
	<section>
		<script src="js/ctrlBuscaMateriales.js"></script>
		<script>
            function oculta(){
            var frmFiltros = document.getElementById("frmBuscaMateriales");
            var divDatos = document.getElementById("resBuscaMateriales");
                if (frmFiltros == null || divDatos == null)
                    alert("Error en HTML");
                else{
                    frmFiltros.style.display="block";
                    divDatos.style.display="none";
                }
		    }
        </script>
		<br/>
        <form id="frmBuscaMateriales" onsubmit="llamaBuscaMateriales(); return false;" style="display:block">
            <table>
                <tr>
                    <td>
                        <label for="cmbTipoMat">Tipo de material:</label></td>
                    <td>
                        <select id="cmbTipoMat">
							<option value="1">Libro</option>
							<option value="2">Revista</option>
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
		<div id="resBuscaMateriales" style="display:none">
			<h4>Materiales encontrados</h4>
			<table border="1" id="tblMateriales">
				<thead>
					<tr>
						<td>Id</td>
						<td>Nombre</td>
						<td>ISBN / ISSN</td>
					</tr>
				</thead>
				<tbody id="tblBodyMateriales">
				</tbody>
			</table>
			<p>
				Nota: el monto de la multa es de <span id="spanMontoMulta"/> pesos por d&iacute;a
			</p>
			<br>
            <input type="button" value="Regresar" onclick="oculta()"/>
		</div>
    </section>
<?php
include_once("latDcha.html");
include_once("pie.html");
?>