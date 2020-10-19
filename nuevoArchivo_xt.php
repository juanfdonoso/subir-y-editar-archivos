<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir archivos</title>
</head>
<body>
    <?php
    //checamos si se ha enviado un formulario para subir un archivo al servidor
    if (isset($_POST["enviarFormulario"])){
        include "../conexion.php";


        //recuperamos los datos del archivo enviado
        $nombre = $_FILES["archivo"]["name"];
        $tipo = $_FILES["archivo"]["type"];
        $tamano = round($_FILES["archivo"]["size"]/1024);
        $textoFoto = $_POST["textoFoto"]; //texto alternativo para las fotos que se suban

        $tempName = $_FILES["archivo"]["tmp_name"];
        $datosFotos = getimagesize($tempName);
        $w = $datosFotos[0];  // dato del ancho de la foto
        $h = $datosFotos[1]; //dato del alto de la foto

        //vamos a checar que el archivo cumpla con las condiciones que sea una imagen, un pdf o un video y que pese menos de 500Mb para
        //poder subirlo al servidor
        $error = 0;

        //checamos que cumpla con el tipo de archivo
        if ($tipo != "image/png" && $tipo != "image/gif" && $tipo != "image/jpeg" && $tipo != "image/jpg" && $tipo != "application/pdf" && $tipo != "video/mp4"){
            $error = 1;
        }else{
            //checamos si es una foto la enviada para revisar que el texto alternativo de la foto se haya ingresado
            if (($tipo == "image/png" || $tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/gif") && $textoFoto == "") $error = 2;
        }

        //checamos el tamaño que sea menor a 500Mb
        if ($tamano >= 499999 || $tamano == 0){
            $error = 3;
        }

        //checamos si hay errores
        if ($error != 0){
            //redireccionamos a nuevoArchivo.php con un querystring con el error producido
            echo '<script language="javascript">';
            echo 'window.location.assign("nuevoArchivo.php?error='.$error.'");';
            echo '</script>';
        }else{
            //proceso de subir el archivo al servidor

            //checamos cuál es el último id registrado en la BD, para conocer el nuevo id que tendrá el archivo que vamos a registrar (que será 1 más)
            $sql = "select MAX(idArchivo) as id from juanf_A_archivos";
            $rs = ejecutar($sql);
            $dato = mysqli_fetch_array($rs);
            $id = $dato["id"];

            if ($id == null){
                $id = 1;
            }else{
                $id++;
            }

            $nombreArchivo = $id."_".$nombre;

            //checamos nuevamente el tipo de archivo para colocar la ruta correcta
            if ($tipo == "application/pdf"){
                $archivoParaSubir = $rutaPDF.$nombreArchivo;
                $tipoArchivo = "pdf";
                $orientacionFoto = null;

            }else if ($tipo == "video/mp4"){
                $archivoParaSubir = $rutaVideo.$nombreArchivo;
                $tipoArchivo = "video";
                $orientacionFoto = null;

            }else if ($tipo == "image/png" || $tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/gif"){
                 $archivoParaSubir = $rutaFoto.$nombreArchivo;
                 $tipoArchivo = "foto";
                 if ($w > $h){
                     $orientacionFoto = "H";
                 }else{
                     $orientacionFoto = "V";
                 }
            }

            //subimos el archivo al servidor
            if (move_uploaded_file($tempName, $archivoParaSubir)){
                //insertamos los datos del archivo en la BD
                $sql = "insert into juanf_A_archivos (archivo, texto, tipo, orientacion) values('$nombreArchivo', '$textoFoto', '$tipoArchivo', '$orientacionFoto')";
                $nada = ejecutar($sql);

                //redireccionamos a index.php
                echo '<script language="javascript">';
                echo 'window.location.assign("index.php");';
                echo '</script>';

            }else{
                //redireccionamos a nuevoArchivo.php con un querystring de error
                echo '<script language="javascript">';
                echo 'window.location.assign("nuevoArchivo.php?error=4");';
                echo '</script>';
            }
        }

    }else{
        echo '<script language="javascript">';
        echo 'window.location.assign("index.php");';
        echo '</script>';
    }



    ?>

</body>
</html>