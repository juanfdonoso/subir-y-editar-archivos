<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivos</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://kit.fontawesome.com/5637dd924f.js" crossorigin="anonymous"></script>
    <script language="javascript" src="scripts.js"></script>
</head>
<body>
    <div class="header">
        <h1>Nuevo Archivo</h1>
    </div>

    <div class="contenedor">
        <div class = "contenedorFormulario">
            Se pueden subir archivos PNG, JPG, JPEG, GIF, PDF de hasta 500Mb de tamaño

            <form id="f1" method="post" action="nuevoArchivo_xt.php" enctype="multipart/form-data" class="formularioSubirArchivo">
            <input type="hidden" name="enviarFormulario">
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
    
</body>
</html>