# subir-y-editar-archivos
En este respositorio se encuentran ejemplos para subir, editar y borrar archivos en el servidor usando PHP.
El código permite subir archivos de las siguientes características:

* Que sean imágenes GIF, JPG o PNG
* Que sean archivos PDF
* Que sean videos mp4
* Que los archivos pesen menos de 500Mb(1)

 El código impide subir archivos de cualquier otro formato
 Cuando se suba una imagen PNG, GIF o JPG, el código checa que se suba también el texto alternativo para dicha imagen.
 
 El código permite visualizar, editar (reemplazar) y borrar los archivos subidos al servidor.
 Los nombres de los archivos se guardan en una tabla de la Base de Datos, llamada **juanf_A_archivos** que tiene los siguientes campos:

* idArchivo (int, primary key, auto_increment)
* archivo (vachar(100)) - campo para almacenar el nombre del archivo
* texto (varchar(1000)) - campo para almacenar el texto alternativo de la imagen
* tipo (varchar(10)) - campo para almacenear el tipo de archivo: foto, pdf, video
* orientacion (varchar(5)) - campo para almacenar la orientación de la imagen: H o V
* fecha (timestamp) - campo con valor por defecto del current time stamp</li>


 (1) PHP.ini debe estar configurado para aceptar carga de archivos de hasta 500MB
  
