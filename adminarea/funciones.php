<?php
include_once('conexion.php');
function idtemp($idserie, $numtemp){
$quetemp="SELECT * FROM `temporada` WHERE `numtemp` = ".$numtemp." AND `Series_idSeries` = ".$idserie;
$mantemp=mysql_query($quetemp);
if(mysql_num_rows($mantemp)>0){
  $renglon=mysql_fetch_row($mantemp);
$idtemp=$renglon[0];
//echo($quetemp);
return($idtemp);
}
return(0);
}
function idepi($idserie, $idtemp, $titulo){
	$queepi="SELECT * FROM `episodios` WHERE `tituloepi` = '".$titulo."' AND `Temporada_idTemporada` = ".$idtemp." AND `Temporada_Series_idSeries` = ".$idserie;
	$mantemp=mysql_query($queepi);
	$renglon=mysql_fetch_row($mantemp);
	$idepi=$renglon[0];
  	return($idepi);
}
function adfly($url){
    $key ="4988d3cd9b64a346a3baec68c345613a"; // API de adfly
    $uid ="14765683";                           // ID de Referido
    $domain = 'adf.ly';                       // Dominio
    $advert_type = 'int';                     // Tipo
    $api = 'http://api.adf.ly/api.php?';
    $query = array('key' => $key,'uid' => $uid,'advert_type' => $advert_type,'domain' => $domain,'url' => $url);
    $api = $api . http_build_query($query);
    if ($data = file_get_contents($api))
    return $data;
}
function buscaserver($link){
 // $link=$_POST['link'.$i];
  $vimeo=strpos($link, "vimeo");
  $openload=strpos($link, "openload");
  if($vimeo!=false){
    return("vimeo");
      }
  if($openload!=false){
    return("openload");
  }    
  return("otro");
}    
function datosserie($idserie){
	$queserie=("SELECT * FROM `series` WHERE `idSeries` = ".$idserie);
	$manserie=mysql_query($queserie);
	$datosserie=mysql_fetch_row($manserie);
	return($datosserie);
}
function idseriebyidtemp($idtemp){
	$quetemp="SELECT * FROM `temporada` WHERE `idTemporada` = ".$idtemp;
	$mantemp=mysql_query($quetemp);
	$temporada=mysql_fetch_row($mantemp);
	return($temporada[6]);
}
function numerotemp($idtemp){
	$quetmp="SELECT * FROM `temporada` WHERE `idTemporada` =".$idtemp;
	$mantmp=mysql_query($quetmp);
	$temporada=mysql_fetch_row($mantmp); 
	return($temporada[4]);
}
function idseriebynombreserie($nombreserie){
  $quetemp="SELECT `idseries` FROM `series` WHERE `nombre` = '".$nombreserie."'";
  $mantemp=mysql_query($quetemp);
  if(mysql_num_rows($mantemp)>0){
    $lineas=mysql_fetch_row($mantemp);
    return($lineas[0]);
  }
  
  return(0);
 
}
function insertaserie($nombre, $anio){
  $queinserie="INSERT INTO series (nombre, anioserie ) VALUES ('".$nombre."', '".$anio."')";
if(mysql_query($queinserie))
{
    
    return(TRUE);
}
else{

    return(FALSE);
}
}
function insertatemp($numtemp, $idserie){
  $quetemp="INSERT INTO `temporada` ( `anio`, `numtemp`, `Series_idSeries`) VALUES ('0000', '".$numtemp."', '".$idserie."')";
  if(mysql_query($quetemp)){
    return(TRUE);
  }
  else{
    return(FALSE);
  }
}
function idepisodiobynumepisodio($idtemp, $idserie, $numepi){
  $quetemp="SELECT * FROM `episodios` WHERE Temporada_idTemporada=$idtemp AND Temporada_Series_idSeries=$idserie AND numeroepi=$numepi";
  $mantemp=mysql_query($quetemp);
  if(mysql_num_rows($mantemp)>0){
    $lineas=mysql_fetch_row($mantemp);
    return($lineas[0]);
  }
  return(0);
}
function insertaepisodio($syn, $numepi, $titue, $idtemp, $idserie){
  $quetemp="INSERT INTO `episodios` (`sinopsis`, `numeroepi`, `tituloepi`, `Temporada_idTemporada`, `Temporada_Series_idSeries`) VALUES ('".$syn."', '".$numepi."', '".$titue."', '".$idtemp."', '".$idserie."')";
  if(mysql_query($quetemp)){
    return(TRUE);
  }
  else{return(FALSE);}
   
}
function idlink($idepi, $idtemp, $idserie){
  $quetemp=("SELECT * FROM `links` WHERE Episodios_idEpisodios = $idepi AND Episodios_Temporada_idTemporada = $idtemp AND Episodios_Temporada_Series_idSeries = $idserie  ");
  $mantemp=mysql_query($quetemp);
  if(mysql_num_rows($mantemp)>0){
    $lineas=mysql_fetch_row($mantemp);
    return($lineas[0]);
  }
  else{return(0);}
}
function insertalink($link, $etiqueta, $idepi, $idtemp, $idserie ){
  $quelink="INSERT INTO `links` (`enlace`, `tipo`, `etiqueta`, `Episodios_idEpisodios`, `Episodios_Temporada_idTemporada`, `Episodios_Temporada_Series_idSeries`) VALUES ('".$link."', 3, '".$etiqueta."', '".$idepi."', '".$idtemp."', '".$idserie."')";
  if(mysql_query($quelink)){
    return(TRUE);
  }
  else{return(FALSE);}
}
function remplazalink($idlink, $link, $etiqueta, $idepi, $idtemp, $idserie){
  $quelink="REPLACE INTO `links` (`idLinks`, `enlace`, `tipo`, `etiqueta`, `Episodios_idEpisodios`, `Episodios_Temporada_idTemporada`, `Episodios_Temporada_Series_idSeries`) VALUES ('".$link."', 3, '".$etiqueta."', '".$idepi."', '".$idtemp."', '".$idserie."')";
  if(mysql_query($quelink)){
    return(TRUE);
  }
  else{return(FALSE);}
}
?>