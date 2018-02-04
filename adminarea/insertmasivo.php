<?php
include('funciones.php');
$lista=fopen('supergirl.csv','r');
$lineas=fgetcsv($lista);


while($lineas=fgetcsv($lista)){
    $nombreserie=$lineas[0];
    $idserie=idseriebynombreserie($nombreserie);
    if($idserie==0){
        insertaserie($nombreserie,"0000");//Si no existe la serie la creamos
        $idserie=idseriebynombreserie($nombreserie);
    }
    $temporada=$lineas[1];
    $idtemporada=idtemp($idserie, $temporada);
    if($idtemporada==0){
        insertatemp($temporada, $idserie );//si no existe la temporada la creamos
        $idtemporada=idtemp($idserie, $temporada);
    }
    $numeroepisodio=$lineas[2];
    $tituloepisodio=mysql_escape_string(utf8_encode($lineas[3]));
    $sinopsis=mysql_escape_string(utf8_encode($lineas[4]));
    $idepisodio=idepisodiobynumepisodio($idtemporada, $idserie, $numeroepisodio);
    if($idepisodio==0){
        insertaepisodio($sinopsis, $numeroepisodio, $tituloepisodio, $idtemporada, $idserie);
        $idepisodio=idepisodiobynumepisodio($idtemporada, $idserie, $numeroepisodio);

    }
    if($lineas[5]!=NULL ){
        insertalink($lineas[5], "Openload Subtitulado SD", $idepisodio, $idtemporada, $idserie );
        
    }
    if($lineas[6]!=NULL ){
        insertalink($lineas[6], "Openload Latino SD", $idepisodio, $idtemporada, $idserie );
        
    }
    


    echo("Nombre:$nombreserie, Id:$idserie, Temporada:$temporada, idTemporada:$idtemporada, Numepisodio: $numeroepisodio, Tituloepisodio: $tituloepisodio, Idepisodio: $idepisodio, Sinopsis: $sinopsis IDlinklatino: $idlink </br></br>");
}
?>