<?php
include('funciones.php');
$lista=fopen('supergirl.csv','r');
$lineas=fgetcsv($lista);


while($lineas=fgetcsv($lista)){
    $nombreserie=$lineas[0];
    $idserie=idseriebynombreserie($nombreserie);
    if($idserie==0){
        insertaserie($nombreserie,"0000");
        $idserie=idseriebynombreserie($nombreserie);
    }
    $temporada=$lineas[1];
    $idtemporada=idtemp($idserie, $temporada);
    if($idtemporada==0){
        insertatemp($temporada, $idserie );
        $idtemporada=idtemp($idserie, $temporada);
    }
    $numeroepisodio=$lineas[2];
    $tituloepisodio=$lineas[3];
    echo("Nombre:$nombreserie, Id:$idserie, Temporada:$temporada, idTemporada:$idtemporada </br></br>");
}
?>