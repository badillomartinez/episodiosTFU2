<?php
include('funciones.php');

/*print_r($_POST);
echo (ultimoidtemp()."<br>");
echo ("id serie ".idserie($_POST["nombreserie"]));*/
//$idtemp=ultimoidtemp()+1;
//print_r($_POST);
set_time_limit(300);


if(isset($_GET['serie'])){
	$idserie=$_GET['serie'];
}
else{
	$idserie=$_POST["nombreserie"];
}
$numtemp=$_POST["numtemp"];

$tmpform=$_FILES["imgtemp"]["tmp_name"];
$nombreserie=datosserie($idserie)[1];
$nombreimagen=$nombreserie."_t".$numtemp.".jpg";
$destino="../imagenes/".$nombreimagen;
move_uploaded_file($tmpform,$destino);

$anio=$_POST["anio"];
$syn=$_POST["syn"];
$quetemp="INSERT INTO `temporada` ( `descripcion`, `anio`, `numtemp`, `imagentemp`, `Series_idSeries`) VALUES ('".$syn."', '".$anio."', '".$numtemp."', '".$nombreimagen."', '".$idserie."')";
if($consulta=mysql_query($quetemp)){
    echo ("Temporada agregada");
    echo("Será redirigido en 5 segundos");

sleep(5);

header ("Location: index.php");
}
else{
    echo("Error");
}

//echo($quetemp);
?>