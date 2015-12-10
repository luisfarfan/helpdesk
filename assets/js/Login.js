function enviarLogin(){
	//alert("hola");
	var usr = getValor("usuario");
	var pass = getValor("pass");
	if(validarUsrPass(usr,pass)){
		var param = "usr="+escape(usr)+"&pass="+escape(pass);
		loginServ(param);
	}
}

function validarUsrPass(usr,pass){
	var cad="";
	var sw = true;
	if(usr==""){
		cad = "<br>Ingrese usuario."
		sw=false;
	}
	if(pass==""){
		cad += "<br>Ingrese contraseña.";
		sw=false;
	}
	getCampo("divEstado").innerHTML = "<font color='#FF0000'>"+cad+"</font>";
	return sw;
}

function loginServ(param){
	ajax=http_request();	
	var valores;
	url="ValidarUsuario.asp";
	valores = param;	
	ajax.open ('POST', url, true);
    ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
                 document.getElementById('divEstado').innerHTML ="<center><img src='images/cargando.gif' /> Verificando ... </center>";
         }
         else if (ajax.readyState==4){
            if(ajax.status==200){
					document.getElementById('divEstado').innerHTML ="";					
					if(ajax.responseText=="ok"){
						getCampo("divEstado").innerHTML= " <font color='#3333FF'>Validación exitosa.</font>";
						location.replace("http://proyectos.inei.gob.pe/encuesta_cap/");
						//location.replace("http://desarrollo/Extr/enaho/web_enaho/enei_2012/");
					}else{
						getCampo("divEstado").innerHTML= " <font color='#FF0000'>Usuario y/o contraseña incorrecto.</font> ";
					}
            }
            else if(ajax.status==404){
                    document.getElementById('divEstado').innerHTML = "La direccion buscada no existe o no esta disponible temporalmente";
            }
            else{
                    document.getElementById('divEstado').innerHTML = "El servicio no esta disponible temporalmente, intentelo nuevemente.";
            }
        }
    }
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');	
    ajax.send(valores);
   return;
}