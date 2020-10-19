<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar archivo</title>
</head>
<body>
    <?php
    //checamos si se ha enviado un id del registro que se va a borrar
    if (isset($_REQUEST["id"])){
        $idArchivo = $_REQUEST["id"];

        include "../conexion.php";

        //buscamos el archivo que hay que borrar
        $sql = "select * from juanf_A_archivos where idArchivo = ".$idArchivo;
        $rs = ejecutar($sql);
        $datos = mysqli_fetch_array($rs);

        //dependiendo del tipo de archivo, definimos la ruta para borrarlo
        if ($datos["tipo"] == "foto"){
            $ruta = $rutaFoto;

        }else if ($datos["tipo"] == "pdf"){
            $ruta = $rutaPDF;

        }else if ($datos["tipo"] == "video"){
            $ruta = $rutaVideo;
        }

        $archivoParaBorrar = $datos["archivo"];

        //borramos el archivo
        if (unlink($ruta.$archivoParaBorrar)){
            // borrar el registro del archivo de la BD
            $sql = "delete from juanf_A_archivos where idArchivo = ".$idArchivo;
            $nada = ejecutar($sql);

        }else{
            //generamos una alerta de error
            echo '<script language="javascript">';
            echo 'alert("El archivo no pudo borrarse del servidor. Contacte al administrador del sistema")';
            echo '</script>';
        }

        echo '<script language="javascript">';
        echo 'window.location.assign("index.php");';
        echo '</script>';

    }else{
        echo '<script language="javascript">';
        echo 'window.location.assign("index.php");';
        echo '</script>';
    }



    ?>
    
</body>
</html>