function buscarProv(combo){	
	if(combo.value=='-1'){
		limpiarCombo('cmbProv');
		limpiarCombo('cmbDist');		
	}else if(combo.value=='00'){
		limpiarCombo('cmbProv');		
		limpiarCombo('cmbDist');
	}
	else{
		limpiarCombo('cmbDist');
		var anio = '';
		buscarUbigeo(anio,combo.value);
	}
}

function buscarDist(combo){
	if(combo.value=='-1'){
		limpiarCombo('cmbDist');		
	}else if(combo.value=='00'){		
			limpiarCombo('cmbDist');
	}
	else{
		var anio = '';
		buscarUbigeo(anio,combo.value);
	}
}

function buscarUbigeo(anio,ubigeo){
	ajax=http_request();	
	var valores;
	url="ubigeo.asp";
	valores="anio="+anio+"&ubigeo="+ubigeo;
	ajax.open ('POST', url, true);
    ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
         }
         else if (ajax.readyState==4){
            if(ajax.status==200){					
					cargarCombo(ajax.responseXML,ubigeo);
            }
            else if(ajax.status==404){                    
            }
            else{                    
            }
        }
    }
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.send(valores);
   return;	
}

function cargarCombo(objXml,ubigeo){	
	var combo;	
	switch(ubigeo.length){
		case 0: combo = document.getElementById('cmbDpto'); break;
		case 2: combo = document.getElementById('cmbProv'); break;
		case 4: combo = document.getElementById('cmbDist'); break;
	}
	combo.options.length=0;
	combo.options[0]=new Option("Seleccione ...","-1");
	//combo.options[1]=new Option("TODOS","00");
	var dato = objXml.getElementsByTagName('dato');
	for(var i=0;i<dato.length;i++){
		codigo=nodoCadena(dato[i],"cod");
		nombre=nodoCadena(dato[i],"nom");
		combo.options[i+1] = new Option(nombre,codigo); // texto, valor
	}
}

function limpiarCombo(id){
	var combo;
	combo = document.getElementById(id);
	combo.options.length=0;
	combo.options[0]=new Option("Seleccione ...","-1");
	
}