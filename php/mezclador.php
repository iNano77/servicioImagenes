 <?php 
//header('content-type: image/jpeg'); 

//Directorio donde están las imagenes subidas
$dir='/Applications/MAMP/htdocs/servicioImages/images/upload/';

//recogemos los nombres de los archivos que vamos a usar
$imagen=$_POST['imagen'];
$marcagua=$_POST['marcagua'];
$mezcla=$_POST['mezcla'];
$ruta_subida =$dir.$mezcla;

//Variable en la que se almacena la ruta de la marca de agua y su nombre
$watermark = imagecreatefrompng($dir.$marcagua); 

//desactivamos la mezcla
imagealphablending($watermark,false);

//eh indicamos a GD que guarde la info de alfa
imagesavealpha($watermark,true);

//obtenemos el ancho y largo de la marca de agua 
$watermark_width = imagesx($watermark); 
$watermark_height = imagesy($watermark);
$image = imagecreatetruecolor($watermark_width, $watermark_height); 

//variable para almacenar la ruta de la imagen
$image = imagecreatefromjpeg($dir.$imagen); 

//obtenemos el tamaño
$size = getimagesize($dir.$imagen); 

//variables donde se localizará la marca de agua
$dest_x = $size[0] - $watermark_width - 5; 
$dest_y = $size[1] - $watermark_height - 5; 

//se crea la imagen mezclada
imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 100); 

//se guarda en la carpeta y le damos el nombre con la variable $mezcla
imagejpeg($image,$ruta_subida,70); 

imagedestroy($image); 
imagedestroy($watermark); 

//enviamos la ruta a la imagen mezclada
echo json_encode($ruta_subida);
?> 


