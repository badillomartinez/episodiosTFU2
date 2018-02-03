<?php 
include('funciones.php');
//print_r($_POST);
if(isset($_GET['temporada'])){
	$idtemp=$_GET['temporada'];
	$idserie=idseriebyidtemp($idtemp);
}
else{
	$idtemp=idtemp($_POST['nombreserie'], $_POST['temp']);
	$idserie=$_POST['nombreserie'];
}
$syn=$_POST['syn'];
$numepi=$_POST['numepi'];
$titue=$_POST['titue'];
echo("La temporada elegida es ".$idtemp);
$numtemp=numerotemp($idtemp);
$nombreimagen=null;


if($_FILES["imgepi"]["size"]!=0){$tmpform=$_FILES["imgepi"]["tmp_name"];
$nombreserie=datosserie($idserie)[1];
$nombreimagen=$nombreserie."_t".$numtemp."_e".$numepi.".jpg";
$destino="../imagenes/".$nombreimagen;
move_uploaded_file($tmpform,$destino);
}

$queepisodio="INSERT INTO `episodios` (`sinopsis`, `numeroepi`, `tituloepi`, `Temporada_idTemporada`, `Temporada_Series_idSeries`, `imgepi`) VALUES ('".$syn."', '".$numepi."', '".$titue."', '".$idtemp."', '".$idserie."', '".$nombreimagen."')";

if(mysql_query($queepisodio)){
	echo("Agregada la info del episodio");
}
else{
	echo("Error </br>");
	
}
$idepisodio=idepi($idserie, $idtemp, $titue);
echo("<br>id episodio: $idepisodio<br>");
for($i=1;$i<=5;$i++){	
                      if(!empty($_POST['link'.$i])){
                      	$etiqueta=$_POST['lab'.$i];
                      	$link=$_POST['link'.$i];
                        $tipo=$_POST['optradio'.$i];
                        if(buscaserver($link)=='otro'){
                        	$link=adfly($link);
                        	$tipo=2;
                        }
                        if(buscaserver($link)=='vimeo'){
                        	$tipo=1;
                        }
                        $quelink="INSERT INTO `links` (`enlace`, `etiqueta`, `tipo`, `Episodios_idEpisodios`, `Episodios_Temporada_idTemporada`, `Episodios_Temporada_Series_idSeries`) VALUES ('".$link."', '".$etiqueta."', '".$tipo."', '".$idepisodio."', '".$idtemp."', '".$idserie."')";

                        if(mysql_query($quelink)){
                        	echo("Agregado el link para ".$etiqueta);
                        	echo("Será redirigido en 5 segundos");
                            sleep(5);
                            header ("Location: index.php");
                        }
                        else{
                        	echo("Error en el link para ".$etiqueta);
                        	echo ($quelink);
                        }
                      }
                  }
?>