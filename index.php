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
    <?php include "../conexion.php";?>
    
    <div class="header">
        <h1>Subir Archivos</h1>
        <button type="button" onClick="nuevoArchivo()">Nuevo Archivo</button>
    </div>

    <div class="contenedor">
        <?php
        // hacemos un query a la BD para buscar todos los archivos que se han subido
        $sql = "select * from juanf_A_archivos";
        $rs = ejecutar($sql);

        if (mysqli_num_rows($rs) == 0){
            echo "No hay archivos subidos a la base de datos";

        }else{
            echo "<div class='texto'>Se encontraron los siguientes archivos en la base de datos:</div>";

            while ($datos = mysqli_fetch_array($rs)){
                
                //para fotos
                if ($datos["tipo"] == "foto"){            
                    echo '<div class="archivo">';
                        echo '<div class="iconos">';
                            echo '<button type="button" onClick="editarArchivo('.$datos["idArchivo"].')"><i class="fas fa-edit"></i></button>';
                            echo '<button type="button" onClick="borrarArchivo('.$datos["idArchivo"].')"><i class="fas fa-trash"></i></button>';
                        echo '</div>';
                        if ($datos["orientacion"] == "H"){
                            echo '<a href="mostrarFoto.php?id='.$datos["idArchivo"].'"><img src="'.$rutaFoto.$datos["archivo"].'" class="imagenH" ALT="'.$datos["texto"].'"></a>';
                        }else{
                            echo '<a href="mostrarFoto.php?id='.$datos["idArchivo"].'"><img src="'.$rutaFoto.$datos["archivo"].'" class="imagenV" alt="'.$datos["texto"].'"></a>';

                        }
                    echo '</div>';

                //para pdfs    
                }else if ($datos["tipo"] == "pdf"){
                    echo '<div class="archivo">';
                        echo '<div class="iconos">';
                            echo '<button type="button" onClick="editarArchivo('.$datos["idArchivo"].')"><i class="fas fa-edit"></i></button>';
                            echo '<button type="button" onClick="borrarArchivo('.$datos["idArchivo"].')"><i class="fas fa-trash"></i></button>';
                        echo '</div>';
                        echo '<a href="'.$rutaPDF.$datos["archivo"].'" target="_blank"><img src="images/pdfIcon.png" class="imagenPDF"></a>';
                        echo '<div class="textoArchivo">';
                            echo $datos["archivo"];
                        echo '</div>';
                    echo '</div>';
                    

                //para videos
                }else if ($datos["tipo"] == "video"){
                    echo '<div class="archivo">';
                        echo '<div class="iconos">';
                            echo '<button type="button" onClick="editarArchivo('.$datos["idArchivo"].')"><i class="fas fa-edit"></i></button>';
                            echo '<button type="button" onClick="borrarArchivo('.$datos["idArchivo"].')"><i class="fas fa-trash"></i></button>';
                        echo '</div>';
                        echo '<a href="mostrarVideo.php?id='.$datos["idArchivo"].'"><img src="images/movieIcon.png" class="imagenPDF"></a>';
                        echo '<div class="textoArchivo">';
                            echo $datos["archivo"];
                        echo '</div>';
                    echo '</div>';

                }
            }
        }

        ?>
        
        <!--
        NOTA: *** ESTE CODIGO COMENTADO  HAY QUE BORRAR LUEGO DE GENERAR EL PHP ****
        <div class="archivo">
            <div class="iconos">
                <button type="button" onClick=""><i class="fas fa-edit"></i></button>
                <button type="button" onClick=""><i class="fas fa-trash"></i></button>
            </div>
            <img src="images/foto1.jpg" class="imagenH">
        </div>

        <div class="archivo">
            <div class="iconos">
                <button type="button" onClick=""><i class="fas fa-edit"></i></button>
                <button type="button" onClick=""><i class="fas fa-trash"></i></button>
            </div>
            <img src="images/foto2.jpg" class="imagenV">
        </div>

        <div class="archivo">
            <div class="iconos">
                <button type="button" onClick=""><i class="fas fa-edit"></i></button>
                <button type="button" onClick=""><i class="fas fa-trash"></i></button>
            </div>
            <img src="images/pdfIcon.png" class="imagenPDF">
        </div>
        -->
    
    </div>

    
</body>
</html>