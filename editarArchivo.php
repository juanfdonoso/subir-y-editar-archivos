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
        <h1>Editar Archivos</h1>
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
        <div class="contenedorArchivosEditar">
            <?php
            if ($datos["tipo"] == "foto"){
                echo '<img src="'.$rutaFoto.$datos["archivo"].'" class="fotoEditar" alt="'.$datos["texto"].'">';

            }else if ($datos["tipo"] == "pdf"){
                echo '<div class="archivo">';
                    echo '<a href="'.$rutaPDF.$datos["archivo"].'" target="_blank"><img src="images/pdfIcon.png" class="imagenPDF"></a>';
                    echo '<div class="textoArchivo">';
                        echo $datos["archivo"];
                    echo '</div>';
                echo '</div>';

            }else if ($datos["tipo" == "video"]){
                echo '<video controls>';
                    echo '<source src="'.$rutaVideo.$datos["archivo"].'" type="video/mp4">';
                    echo 'Su navegador no soporta desplegar videos.';
                echo' </video>';
            }
        
            ?>
        </div>

        <div class = "contenedorFormulario">
            Se pueden subir archivos PNG, JPG, JPEG, GIF, PDF de hasta 500Mb de tamaño

            <form id="f1" method="post" action="editarArchivo_xt.php" enctype="multipart/form-data" class="formularioSubirArchivo">
            <input type="hidden" name="id" value="<?php echo $idArchivo; ?>">
            <input type="file" name="archivo" class="botonSubirFoto" id="c1">
            <br><br>
            <input type="text" class="textoFoto" maxlength="1000" name="textoFoto" placeholder="texto alternativo de la imagen" id="c2"/> 
            <span class="asterisco">*</span>
            <br>
            <span class="mensajeObligatorio">(*) Campo obligatorio cuando se suben imágenes</span>
            <br><br>
            <button type="button" class="botonSubirFoto" onClick="validarSubirFoto()">Subir Archivo</button>
            <button type="button" class="botonCancelar" onClick="regresarAIndex()">Cancelar</button>
            </form>
            <?php
            //checamos si se ha enviado un querystring con error
            if (isset($_REQUEST["error"])){
                $error = $_REQUEST["error"];

                if ($error == 1){
                    echo '<div class="error">El archivo que intenta subir no es una imagen (jpg, png o gif), no es un pdf y tampoco es un video mp4</div>';

                }else if($error == 2){
                    echo '<div class="error">No ha subido el texto alternativo para la imagen</div>';

                }else if($error == 3){
                    echo '<div class="error">El archivo pesa más de 500MB y no puede subirse al servidor</div>';

                }else if($error == 4){
                    echo '<div class="error">El archivo no pudo subirse al servidor. Contacte al administrador del sistema</div>';
                }
            }


            ?>
        </div>


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