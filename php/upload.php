<?php
//echo "Esto es el archivo upload.php:";

$dir_subida = '/Applications/MAMP/htdocs/servicioImages/images/upload/';

$nombre_imagen=$_FILES['imagen']['name'];
$nombre_marcagua=$_FILES['marcagua']['name'];


$fichero_imagen= $dir_subida . basename($_FILES['imagen']['name']);
$fichero_marcagua= $dir_subida . basename($_FILES['marcagua']['name']);

//echo '<pre>';
if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_imagen)){
   
// } else {
//     echo "¡Posible ataque de subida de ficheros!\n";
//     echo "No es posible subir el fichero ".$_FILES['imagen']['name']."\n";
//     echo "\n";
}
if (move_uploaded_file($_FILES['marcagua']['tmp_name'], $fichero_marcagua)){

// } else {
//     echo "¡Posible ataque de subida de ficheros!\n";
//     echo "No es posible subir el fichero ".$_FILES['marcagua']['name']."\n";
//     echo "\n";
 }


//echo 'Más información de depuración:';
//print_r($_FILES);
//print "</pre>";
// echo json_encode($_POST);
// echo json_encode($respuesta);
 

// ====================================================
//======== PARTE DE MEZCLA ============================
//=====================================================


//Directorio donde están las imagenes subidas
$dir='/Applications/MAMP/htdocs/servicioImages/images/mezclas/';

//recogemos los nombres de los archivos que vamos a usar
$imagen=$nombre_imagen;
$marcagua=$nombre_marcagua;
$mezcla=$_POST['mezcla'];
$ruta_mezcla =$dir.$imagen;

//Variable en la que se almacena la ruta de la marca de agua y su nombre
$watermark = imagecreatefrompng($dir_subida.$marcagua); 

//desactivamos la mezcla
imagealphablending($watermark,false);

//eh indicamos a GD que guarde la info de alfa
imagesavealpha($watermark,true);

//obtenemos el ancho y largo de la marca de agua 
$watermark_width = imagesx($watermark); 
$watermark_height = imagesy($watermark);
$image = imagecreatetruecolor($watermark_width, $watermark_height); 

//variable para almacenar la ruta de la imagen
$image = imagecreatefromjpeg($dir_subida.$imagen); 

//obtenemos el tamaño
$size = getimagesize($dir_subida.$imagen); 

//variables donde se localizará la marca de agua
$dest_x = $size[0] - $watermark_width - 5; 
$dest_y = $size[1] - $watermark_height - 5; 

//se crea la imagen mezclada
imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 100); 

//se guarda en la carpeta y le damos el nombre con la variable $mezcla
imagejpeg($image,$ruta_mezcla,70); 

imagedestroy($image); 
imagedestroy($watermark); 

//enviamos la ruta a la imagen mezclada
$ruta_imagen = $dir_subida.$nombre_imagen;
$ruta_marcagua = $dir_subida.$nombre_marcagua;

$respuesta =  [
    "imagen" => "$ruta_imagen",
    "marcagua" => "$ruta_marcagua",
    "mezcla" => "$ruta_mezcla"
    ];
echo json_encode($respuesta);
?>
