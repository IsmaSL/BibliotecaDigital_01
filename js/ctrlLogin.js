/*
Archivo:  ctrlLogin.js
Objetivo: código de JavaScript para realizar login mediante llamada a PHP
Autor:    ISL
*/

//Configura y lanza la llamada parcial al servidor
function llamaLogin(sCve, sPwd) {
    var request = new XMLHttpRequest();
    var url = "ctrlPhp/ctrlLogin.php";
    var sQueryString = "";
    if (sCve == "" || sPwd == "") {
        alert("Faltan datos para el ingreso");
    } else {
        //Arma los parámetros a enviar al servidor (se reciben como $_REQUEST)
        sQueryString = "txtCuenta=" + sCve + "&txtPwd=" + sPwd;
        /*Al evento onreadystatechange se le asigna
          una función anónima; es parte de la 
          configuración de la llamada*/
        request.onreadystatechange = function() {
            /*Si, cuando se ejecute la llamada, queda 
              en estado 4 y status 200, es que todo 
              salió bien y puede procesar la respuesta */
            if (request.readyState === 4 &&
                request.status === 200) {
                procesaLogin(request.responseText);
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
function procesaLogin(textoRespuesta) {
    var oNodoFrm = document.getElementById("frmLogin");
    var oNodoDiv = document.getElementById("bienvenido");
    var oNodoNombre = document.getElementById("paraNombre");
    var oNodoTipo = document.getElementById("paraTipo");
    var oLigaInicio = document.getElementById("menuInicio");
    var oLigaUsu = document.getElementById("menuUsuarios");
    var oLigaSalir = document.getElementById("menuSalir");
    var oDatos;
    var sError = "";

    try {
        oDatos = JSON.parse(textoRespuesta);
        /*Si lo pudo convertir a objeto, entonces presenta bienvenida*/
        if (oDatos != null) {
            if (oNodoFrm == null || oNodoDiv == null ||
                oNodoNombre == null || oNodoTipo == null ||
                oLigaInicio == null || oLigaSalir == null ||
                oLigaUsu == null)
                sError = "Error en HTML desde CtrlLogin.js";
            else {
                if (oDatos.nTipo == -1) { //Se trata de un error
                    sError = oDatos.sNombreCompleto;
                } else {
                    //Colocar nombre y tipo
                    oNodoNombre.innerHTML = oDatos.sNombreCompleto;
                    oNodoTipo.innerHTML = oDatos.sDescTipo;
                    //Cambiar menús
                    oLigaInicio.href = "resulLogin.php";
                    oLigaUsu.innerHTML = "Consultar usuarios";
                    oLigaUsu.href = "buscaUsuarios.php";
                    oLigaSalir.innerHTML = "Salir";
                    oLigaSalir.href = "ctrlPhp/ctrlLogout.php";
                    //Ocultar formulario y mostrar bienvenida*/
                    oNodoFrm.style.display = "none";
                    oNodoDiv.style.display = "block";
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