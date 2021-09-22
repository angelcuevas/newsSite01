window.onload = function(){
	iniciardesplegables();
	iniciarEditarImagenes();
	iniciarFecha();
	iniciarAutoResize();
	/*
	table = document.getElementsByTagName("table");
		try{
			for (var i = 0; i < table[0].rows.length; i++) {
			   for (var j = 0; j < table[0].rows[i].cells.length; j++) {
			     table[0].rows[i].cells[j].innerHTML = i + " " + j;
			   }  
			}
		}catch(e){
			alert(e);
		}*/
}

function iniciarFecha(){
	fecha = document.getElementsByClassName("fecha");
	for (var i = 0; i < fecha.length; i++) {
	    //fecha[i].value = obtenerFecha();
	    fecha[i].setAttribute("id","fecha" + i);
	    fecha[i].setAttribute("onclick","javascript:NewCssCal('fecha" + i +"','yyyyMMdd','arrow','true','24',false);");
	}
	sfecha = document.getElementsByClassName("sfecha");
	for (var i = 0; i < sfecha.length; i++) {
	    //sfecha[i].value = obtenerFecha();
   	    sfecha[i].setAttribute("id","sfecha" + i);
	    sfecha[i].setAttribute("onclick","javascript:NewCssCal('sfecha" + i +"','yyyyMMdd','arrow');");
	}
}

function iniciarEditarImagenes(){
	editar_imagen_iframe = document.getElementsByClassName("editar_imagen_iframe");
	for (var i = 0; i < editar_imagen_iframe.length; i++) {
		//editar_imagen_iframe[i].setAttribute('onclick',"cargarPagina(this.href,document.getElementById('ifotos'));");
		//editar_imagen_iframe[i].setAttribute('onclick',"window.open(this.href,'','width=600,height=300');");
	};
}

function iniciardesplegables(){

	agregar_atributos("h1");
	agregar_atributos("h2");
	for (x=0; x<=localStorage.length-1; x++)
	{
		clave = localStorage.key(x);
		if(document.getElementById(clave) != null) {
			ocultar = document.getElementById(clave).nextSibling;
			while (ocultar.nodeType!=1)
			{
				ocultar=ocultar.nextSibling;
			}
			ocultar.style.display = localStorage.getItem(clave);
		}
	}
	claseAsk = document.getElementsByClassName("ask");
	for (var i = 0; i < claseAsk.length; i++) {
		claseAsk[i].setAttribute('onclick','if(!confirm("¿Eliminar?")){return false;};');
	};
}


function agregar_atributos(tag){
	capas=document.getElementsByTagName(tag);
	for (i=0;i<capas.length;i++){
		capas[i].setAttribute('onclick','expandir(this);');
		capas[i].setAttribute('id', modulo_actual() + "_" + tag + "_" + i);
		capas[i].style.cursor = "pointer";
	}
}

function get_nextsibling(n)
{
	x=n.nextSibling;
	while (x.nodeType!=1)
	{
		x=x.nextSibling;
	}
	return x;
}

function expandir(id){

	nodo = get_nextsibling(id);

	if(nodo.style.display == "inline-table") {
		nodo.style.display = "none";
	}else{ 
		nodo.style.display = "inline-table";
	}
	guardar_datos(id.getAttribute("id"),nodo.style.display)
}

function cargar_datos(index){
	return localStorage.getItem(index);
}

function guardar_datos(index,value){
	localStorage.setItem(index, value);
}

function modulo_actual(){
	var sPath = window.location.pathname;
	var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
	return sPage;
}

function borrar_datos(){
	x = confirm("¿Borrar datos locales?")
	if (x) {
		if(localStorage.clear()){
			alert("Datos locales borrados");
		}else{
			alert("Error al borrar");
		}
	};
}

function obtenerFecha(){
	var currentDate = new Date()
	var day = currentDate.getDate()
	var month = currentDate.getMonth() + 1
	var year = currentDate.getFullYear()
	var currentTime = new Date()
	var hours = currentTime.getHours()
	var minutes = currentTime.getMinutes()

	if (day < 10) day = "0" + day;
	if (month < 10) month = "0" + month;
	if (hours < 10) hours = "0" + hours;
	if (minutes < 10) minutes = "0" + minutes;

	return year + "-" + month + "-" + day + " " + hours + "-" + minutes;
}


function iniciarAutoResize(){
	iframes = document.getElementsByTagName("iframe");
	for (var i = 0; i < iframes.length; i++) {
	    iframes[i].setAttribute('onload',"autoResize(this);");
	    autoResize(iframes[i]);
	}
}

function autoResize(iframe){
    var newheight;
    var newwidth;
    newheight = iframe.contentWindow.document.body.scrollHeight;
    newwidth = iframe.contentWindow.document.body.scrollWidth;
    iframe.height = (newheight) + "px";
    iframe.width = (newwidth) + "px";
}