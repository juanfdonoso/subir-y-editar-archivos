# subir-y-editar-archivos
En este respositorio se encuentran ejemplos para subir, editar y borrar archivos en el servidor usando PHP.
El código permite subir archivos de las siguientes características:
<ul>
<li>Que sean imágenes GIF, JPG o PNG</li>
<li>Que sean archivos PDF</li>
<li>Que sean videos mp4</li>
<li>Que los archivos pesen menos de 500Mb(*)</li>
</ul>
 El código impide subir archivos de cualquier otro formato
 Cuando se suba una imagen PNG, GIF o JPG, el código checa que se suba también el texto alternativo para dicha imagen.
 <br><br>
 El código permite visualizar, editar (reemplazar) y borrar los archivos subidos al servidor.
 Los nombres de los archivos se guardan en una tabla de la Base de Datos, llamada **juanf_A_archivos** que tiene los siguientes campos:
 <br>
 <ul>
  <li>idArchivo (int, primary key, auto_increment)</li>
  <li>archivo (vachar(100)) - campo para almacenar el nombre del archivo</li>
  <li>texto (varchar(1000)) - campo para almacenar el texto alternativo de la imagen</li>
  <li>tipo (varchar(10)) - campo para almacenear el tipo de archivo: foto, pdf, video</li>
  <li>orientacion (varchar(5)) - campo para almacenar la orientación de la imagen: H o V</li>
  <li>fecha (timestamp) - campo con valor por defecto del current time stamp</li>
 </ul>
 <br><br>
 (*) PHP.ini debe estar configurado para aceptar carga de archivos de hasta 500MB
  
