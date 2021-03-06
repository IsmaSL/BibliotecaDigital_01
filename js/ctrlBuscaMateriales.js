/*
Archivo:  ctrlBuscaMateriales.js
Objetivo: código de JavaScript para realizar llamada parcial a PHP para obtener 
		  información de materiales
Autor:    ISL
*/

//Configura y lanza la llamada parcial al servidor
function llamaBuscaMateriales() {
    var request = new XMLHttpRequest();
    var url = "ctrlPhp/ctrlBuscaMateriales.php";
    var oCmb = document.getElementById("cmbTipoMat");
    var sQueryString = "";
    if (oCmb == null || oCmb.selectedIndex < 0) {
        console.log(oCmb);
        console.log(oCmb.selectedIndex);
        alert("Faltan datos para buscar materiales");
    } else {
        //Arma los parámetros a enviar al servidor (se reciben como $_REQUEST)
        sQueryString = "cmbTipo=" + oCmb.options[oCmb.selectedIndex].value;
        /*Al evento onreadystatechange se le asigna
          una función anónima; es parte de la 
          configuración de la llamada*/
        request.onreadystatechange = function() {
            /*Si, cuando se ejecute la llamada, queda 
              en estado 4 y status 200, es que todo 
              salió bien y puede procesar la respuesta */
            if (request.readyState === 4 &&
                request.status === 200) {
                procesaBuscaMateriales(request.responseText);
            } else {
                if (request.status != 200 && request.status != 0)
                    alert("Hubo error, status " + request.status);
            }
        };
        request.open("POST", url, true);
        //Se avisa que se envían parámetros que se van a entender como un formulario
        request.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        request.send(sQueryString);
    }
}

//Procesa la respuesta parcial del servidor
function procesaBuscaMateriales(textoRespuesta) {
    var oNodoFrm = document.getElementById("frmBuscaMateriales");
    var oNodoDiv = document.getElementById("resBuscaMateriales");
    var oNodoTbl = document.getElementById("tblMateriales");
    var oTblBody = document.getElementById("tblBodyMateriales");
    var oSpanMulta = document.getElementById("spanMontoMulta");
    var oNodoTblBody = document.createElement("tbody"); //un nodo que NO está ligado a tbl
    var oCelda1, oCelda2, oCelda3;
    var oDatos;
    var sError = "";

    try {
        oDatos = JSON.parse(textoRespuesta);
        /*Si lo pudo convertir a objeto, entonces procesa para pintar tabla*/
        if (oDatos != null) {
            if (oNodoFrm == null || oNodoDiv == null ||
                oSpanMulta == null || oTblBody == null)
                sError = "Error en HTML";
            else {
                if (oDatos.success) { //todo ok
                    //Mostrar monto de la multa
                    oSpanMulta.innerHTML = oDatos.montoMulta;

                    //Llena líneas
                    for (var i = 0; i < oDatos.arrMateriales.length; i++) {
                        oLinea = oNodoTblBody.insertRow(-1);
                        oCelda1 = oLinea.insertCell(0);
                        oCelda2 = oLinea.insertCell(1);
                        oCelda3 = oLinea.insertCell(2);
                        oCelda1.innerHTML = oDatos.arrMateriales[i].id;
                        oCelda2.innerHTML = oDatos.arrMateriales[i].nombre;
                        oCelda3.innerHTML = oDatos.arrMateriales[i].is;
                    }

                    //Sustituye el tBody original por el nuevo ya llenado
                    oNodoTblBody.id = "tblBodyMateriales";
                    oNodoTbl.replaceChild(oNodoTblBody, oTblBody);

                    //Ocultar formulario y mostrar tabla*/
                    oNodoFrm.style.display = "none";
                    oNodoDiv.style.display = "block";

                } else {
                    sError = oDatos.situacion;
                }
            }
        } else {
            sError = "JSON no convertido"
        }
        console.log("Mensaje a consola");
    } catch (error) {
        console.log(error.message);
        sError = "Error de conversiones";
    }
    if (sError != "")
        alert(sError);
}