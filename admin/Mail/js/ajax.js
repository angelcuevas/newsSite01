
var READY_STATE_UNINITIALIZED=0;
var READY_STATE_LOADING=1;
var READY_STATE_LOADED=2;
var READY_STATE_INTERACTIVE=3;
var READY_STATE_COMPLETE=4;

function nuevoAjax(){
    var xmlhttp=false;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }
    if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function cargarPagina (url, contenedor){
    ajax=nuevoAjax(); 
    ajax.open("GET", url,true); 
    ajax.onreadystatechange=function(){
        if(ajax.readyState==1){
            contenedor.innerHTML = "cargando()";
        }else if(ajax.readyState==READY_STATE_COMPLETE){
            if(ajax.status==200){
                contenedor.innerHTML = ajax.responseText;
                agregar_accion();
            }else if(ajax.status==404){
                contenedor.innerHTML = "La página no existe";
            }else{
                contenedor.innerHTML = "Error:".ajax.status; 
            }
        }
    }
    ajax.send(null);
}