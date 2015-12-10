function clickAceptar(){
	validar();
}

function validar(){
	var b2 = validarBloqueII();
	// Mensaje de error
	if (b2){
		// bloque 2  (OK)
	}else{
		location.replace('#b2');
	}
	
	var b3 = validarBloqueIII();
	
	
	if (b3){
		// bloque 3  (OK)
	}else{
		if(b2){
			location.replace('#b3');
		}
	}
	validarBloqueIV();
	if( b2 && b3 ){
		// Listo para registrar
		registrarForm(getParametros());
	}
}

function getParametros(){
	
	// Bloque 1
	var cad="";
	var arrID = new Array('txtNombre','txtApePat','txtApeMat','txtInstitucion','txtDireccion','txtCorreo','cmbDist','txtTelFijo','txtTelMovil','txtEdad','cmbSexo');
	var arrParam = new Array('nombre','apellPat','apellMat','institucion','direccion','mail','distrito','fonoFijo','fonoMovil','edad','sexo');
	cad = arrParam[0]+"="+escape(getValor(arrID[0]));
	for(var i=1;i<arrID.length;i++){
		cad = cad + "&" + arrParam[i]+"="+escape(getValor(arrID[i]));
	}
	
	// Cursos
//	var arrNum = 	new Array(5,11,7,2,3); // a - e
	var arrNum = 	new Array(9,7,5,4); // a - e
	var arrLetra = new Array('a','c','d','e'); // a - e
//	var arrSubGrupo=new Array('economia','softEstadistico','informatica','administracion', 'especializacion');
	var arrSubGrupo=new Array('estadistica','softEstadistico','informatica','especializacion');
	var swMinUno = false;
	var opSel = ""; 
	for(var i=0;i<arrLetra.length;i++){
		opSel = "";
		for(var j=1;j<=arrNum[i];j++){
			//alert(j);
			if(getCampo(arrLetra[i]+j).checked){
				//alert(arrLetra[i]+j);
				if(opSel==""){ opSel=j; }
				else{ opSel+=","+j; }
			}
		}
		cad = cad + '&' + arrSubGrupo[i] + "=" + escape(opSel);
		;
	}

	// Cursos de PostGrado
	opSel = "";
	for(var j=1;j<=3;j++){
		if(getCampo('n'+j).checked){
			if(opSel==""){ opSel=j; }
			else{ opSel+=","+j; }
		}
	}
	
	
	cad = cad + '&' + "economia=" + escape(opSel);
	cad = cad + '&' + "otroestadistica=" + escape(getValor('at1'));
	cad = cad + '&' + "otroeconomia=" + escape(getValor('bt1'));
	cad = cad + '&' + "otroswestadistico=" + escape(getValor('ct1'));
	cad = cad + '&' + "otroinformatica=" + escape(getValor('dt1'));
	cad = cad + '&' + "otroespecializacion=" + escape(getValor('et1'));
//	cad = cad + '&' + "otroespecializacion=" + escape(getValor('ft1'));

	// Sugerencias
	cad = cad + '&' + "sugerencias=" + escape(getValor('txtSugerencias'));
	return cad;
}

function validarBloqueII(){
	
	var cadError='';
	var swError = false;
	// -- Validar Texto obligatorio	
	if(textoVacio('txtNombre')){
		cadError += ',txtNombre'; 
		msgEstado('r1','nok','Ingrese nombre.'); 
		swError=true;}
	else{
		msgEstado('r1','ok','');
	}
	
	if(textoVacio('txtApePat')){
		cadError += ',txtApePat';
		msgEstado('r2','nok','Ingrese Apellido Paterno.'); 
		swError=true;
	}
	else{
		msgEstado('r2','ok','');
	}
	
	if(textoVacio('txtApeMat')){cadError += ',txtApeMat';msgEstado('r3','nok','Ingrese Apellido Materno.'); swError=true;}
	else{msgEstado('r3','ok','');}
	if(textoVacio('txtCorreo')){cadError += ',txtCorreo';msgEstado('r6','nok','Ingrese Correo Electrónico.'); swError=true;}
	else{msgEstado('r6','ok','');}
	if(textoVacio('txtEdad')){cadError += ',txtEdad';msgEstado('r11','nok','Ingrese Edad.'); swError=true;}
	else{msgEstado('r11','ok','');}
	// -- Valida combo obligatorio
	if(cmbVacio('cmbDpto')){cadError += ',cmbDpto';msgEstado('r7','nok','Seleccione Departamento.'); swError=true;}
	else{msgEstado('r7','ok','');}
	if(cmbVacio('cmbProv')){cadError += ',cmbProv';msgEstado('r8','nok','Seleccione Provincia.'); swError=true;}
	else{msgEstado('r8','ok','');}
	if(cmbVacio('cmbDist')){cadError += ',cmbDist';msgEstado('r9','nok','Seleccione Distrito.'); swError=true;}
	else{msgEstado('r9','ok','');}
	if(cmbVacio('cmbSexo')){cadError += ',cmbSexo';msgEstado('r12','nok','Seleccione Sexo.'); swError=true;}
	else{msgEstado('r12','ok','');}	
	
	
	// Formato de correo electronico
	if(getValor('txtCorreo')!=""){
		if( validarEmail(getValor('txtCorreo')) ){
			msgEstado('r6','ok','');			
		}else{
			msgEstado('r6','nok','Dirección de correo no valida.'); swError=true;
		}
	}
	
	// Datos NO Obligatorios
	if(Trim(getValor('txtInstitucion')).replace(' ', '')!=""){
		msgEstado('r4','ok','');
	}else{
		msgEstado('r4','0','');
	}
	
	if(Trim(getValor('txtDireccion')).replace(' ', '')!=""){
		msgEstado('r5','ok','');
	}else{
		msgEstado('r5','0','');
	}
	
	// Fonos
	var swFono1 = false;
	var swFono2 = false;
	if(Trim(getValor('txtTelFijo')).replace(' ', '')!=""){swFono1=true;}
	else{swFono1=false;}
	if(Trim(getValor('txtTelMovil')).replace(' ', '')!=""){swFono2=true;}
	else{swFono2=false;}
	
	if(swFono1 || swFono2){
		msgEstado('r10','ok','');
	}else{
		msgEstado('r10','0','');
	}
	return !swError;
	
} 

function validarBloqueIII(){ // Necesidade de Capacitacion
	var arrNum = new Array(9,7,5,4); // a - e
	var arrLetra = new Array('a','c','d','e'); // a - e
	var swMinUno = false; 
	
	for(var i=0;i<arrLetra.length;i++){//5: a,c,d,e

		for(var j=1;j<=arrNum[i];j++){
			if(getCampo(arrLetra[i]+j).checked){
				swMinUno=true;
				
			}
		}
	}	
	
	for(var j=1;j<=3;j++){
		if(getCampo("n"+j).checked){
			swMinUno=true;
		}
	}
	
/*
	// Opcion III -> F
	for(var j=1;j<=3;j++){
		if(getCampo("f"+j).checked){
			swMinUno=true;
		}
	}
	*/	

		
	if(swMinUno){
		msgEstado('r14','ok','');
	}else{
		msgEstado('r14','nok','Seleccione al menos una opción.');
	}
	
	return swMinUno;
}

function validarBloqueIV(){
	
	var txtSug =Trim(getValor("txtSugerencias")).replace(' ','');
		
	for(var i=0;i<txtSug.length;i++){
		txtSug = txtSug.replace(String.fromCharCode(13,10),'');
		
	}
	
}

function validarEmail(email) {
	var re  = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	if (!re.test(email)) {
	    return false; 
	}else{
		return true;
	}
}


function msgEstado(id,estado,msg){
	if(estado=='ok'){
		getCampo(id).innerHTML="<img src='images/ok.gif' border=0 />"
	}else if(estado=='nok'){
		getCampo(id).innerHTML="<img src='images/nok.png' border=0 title='"+msg+"' />"
	}else{
		getCampo(id).innerHTML="";
	}
}

function textoVacio(id){
	if(Trim(getValor(id)).replace(' ','')=="" ){return true;}
	else{return false;}
}

function cmbVacio(id){
	if(getValor(id)=="-1"){return true;}
	else{return false;}
}

// -------------------------------------

function registrarForm(param){
	ajax=http_request();	
	var valores;
	url="Registro.asp";
	valores = param;
	ajax.open ('POST', url, true);
    ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
                 document.getElementById('divEstado').innerHTML ="<center><img src='images/cargando.gif' /> Guardando ... </center>";
         }
         else if (ajax.readyState==4){
            if(ajax.status==200){
					document.getElementById('divEstado').innerHTML ="";					
					if(ajax.responseText=="ok"){
						getCampo("divEstado").innerHTML= " Formulario registrado satisfactoriamente.";
						getCampo("btnEnviar").disabled=true;
					}else{
						getCampo("divEstado").innerHTML= " El formulario no se pudo registrar satisfactoriamente, intentelo nuevamente. ";
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