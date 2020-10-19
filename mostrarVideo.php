<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir archivos</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://kit.fontawesome.com/5637dd924f.js" crossorigin="anonymous"></script>
    <script language="javascript" src="scripts.js"></script>
</head>
<body>
    <?php include "../conexion.php";?>
    
    <div class="header">
        <h1>Subir Archivos</h1>
        <button type="button" onClick="regresarAIndex()">Regresar</button>
    </div>
    <?php
    // checamos si se ha enviado el id de la foto que hay que desplegar
    if (isset($_REQUEST["id"])){
        $idArchivo = $_REQUEST["id"];
        // buscamos la foto que hay que desplegar
        $sql = "select * from juanf_A_archivos where idArchivo = ".$idArchivo;
        $rs = ejecutar($sql);
        $datos = mysqli_fetch_array($rs);
    ?>

    <div class="contenedor">
        <video controls>
            <source src="<?php echo $rutaVideo.$datos["archivo"];?>" type="video/mp4">
            Su navegador no soporta desplegar videos.
        </video> 
    </div>

    <?php
    }else{
        echo '<script language="javascript">';
        echo 'window.location.assign("index.php");';
        echo '</script>';
    }

    ?>
</body>
</html>