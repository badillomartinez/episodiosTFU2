<?php
include('funciones.php');

$nombreserie=$_POST["nombreserie"];
$anio=$_POST["anioinicio"];
//$tmpimg=$_FILES["imagen"]["tmp_name"];
//$rutaimg="imagenes/".$nombreserie.".png";
//move_uploaded_file($tmpimg,$rutaimg);
//$queid="SELECT idSeries FROM series ORDER BY idSeries DESC";
//$cursid=mysql_query($queid);
//$ultimo=mysql_fetch_row($cursid)[0];
/*$queinserie="INSERT INTO series (nombre, anioserie ) VALUES ('".$nombreserie."', '".$anio."')";
if(mysql_query($queinserie))
{
    
    echo("Serie agregada con exito");
}
else{

    echo("Error");
}*/
if(insertaserie($nombreserie,$anio)){
    echo("Serie agregada con exito");
}
else{
    echo("Error");
}
echo("Será redirigido en 5 segundos");
sleep(5);

header ("Location: index.php");

//echo ($queinserie);


?>