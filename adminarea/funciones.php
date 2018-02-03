<?php
include_once('conexion.php');
function idtemp($idserie, $numtemp){
$quetemp="SELECT * FROM `temporada` WHERE `numtemp` = ".$numtemp." AND `Series_idSeries` = ".$idserie;
$mantemp=mysql_query($quetemp);
$renglon=mysql_fetch_row($mantemp);
$idtemp=$renglon[0];
//echo($quetemp);
return($idtemp);
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

?>