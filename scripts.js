function nuevoArchivo(){
    window.location.assign("nuevoArchivo.php");
}

function regresarAIndex(){
    window.location.assign("index.php");
}

function validarSubirFoto(){
    var c1 = document.getElementById("c1").value;
    if (c1 == ""){
        alert ("Debe seleccionar un archivo para enviar el formulario");
    }else{
        document.getElementById("f1").submit();
    } 
}

function borrarArchivo(id){
    var r = confirm("Desea realmente borrar este archivo?");
    if (r) window.location.assign("borrarArchivo_xt.php?id="+id);
    
}

function editarArchivo(id){
    window.location.assign("editarArchivo.php?id="+id);
}