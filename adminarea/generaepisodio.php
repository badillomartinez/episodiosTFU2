<?php
include("header.php");


function openloadembed($link){
    $parte=explode("/", $link);
    $id=array_pop($parte);
    $id=array_pop($parte).'/'.$id;
    $embed='<iframe src="https://openload.co/embed/'.$id.'" scrolling="no" frameborder="0" width="700" height="430" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
    return($embed);
}
function vimeoembed($link){
    $parte=explode("/", $link);
    $id=array_pop($parte);
    $embed='<iframe src="https://player.vimeo.com/video/'.$id.'?color=ffb01c&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    return($embed);
}
function genera($i){
   $link=$_POST['link'.$i];
   $etiqueta=$_POST['lab'.$i];
   $tipo=$_POST['optradio'.$i];
   if($tipo=1){
      agregavideo($i);
   }
   if($tipo=2){
      agregadescarga($i);
   }
   if($tipo=3){
      agregavideo($i);
      agregadescarga($i);
   }
}

function agregavideo($i){
   $link=$_POST['link'.$i];
   $etiqueta=$_POST['lab'.$i];
   $lineavideo="[wptab name='".$etiqueta."']".openloadembed($link)."[/wptab]".PHP_EOL;
   return($lineavideo);
}
function agregavimeo($i){
   $link=$_POST['link'.$i];
   $etiqueta=$_POST['lab'.$i];
   $lineavideo="[wptab name='".$etiqueta."']".vimeoembed($link)."[/wptab]".PHP_EOL;
   return($lineavideo);
}
function agregadescarga($i){
   $link=$_POST['link'.$i];
   $etiqueta=$_POST['lab'.$i];
   $taglink="<a href='".$link."' target='_blank' >".$etiqueta."</a></br>";
   return($taglink);
}

function buscaserver($i){
  $link=$_POST['link'.$i];
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
function agregaadfly($i){
   $link=$_POST['link'.$i];
   $link=adfly($link);
   $etiqueta=$_POST['lab'.$i];
   $taglink="<a href='".$link."' target='_blank' >".$etiqueta."</a></br>";
   return($taglink);
}
//print_r($_POST);

if(!empty($_POST['syn'])){
   $cadenatabs=null;
$cadenalinks="[wptab name='Descargar']<h2>Si algún archivo les pide contraseña la contraseña es <b>TheFlashUniverse</b></h2></br>";
for($i=1; $i<=5; $i++){
   //$link=;
   if(!empty($_POST['link'.$i])){
   $server=buscaserver($i);
   if ($server=="openload"){
    $tipo=$_POST['optradio'.$i];
   if($tipo==1){
      $cadenatabs=$cadenatabs.agregavideo($i);
   }
   if($tipo==2){
      $cadenalinks=$cadenalinks.agregadescarga($i);
   }
   if($tipo==3){
      $cadenatabs=$cadenatabs.agregavideo($i);
      $cadenalinks=$cadenalinks.agregadescarga($i);
   }
   }
   if($server=="otro"){
    $cadenalinks=$cadenalinks.agregaadfly($i);
   }
   if($server=="vimeo"){
    $cadenatabs=$cadenatabs.agregavimeo($i);
   }
  }
}
$cuerpodelpost=nl2br($_POST['syn'].PHP_EOL).$cadenatabs.$cadenalinks."</br>[/wptab][end_wptabset]";
echo('<div class="container">
  <div class="col-xs-10">
<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Copia este texto en el Area HTML de tu publicación</h3>
            </div>
            <div class="panel-body">
              '.nl2br(htmlspecialchars($cuerpodelpost)).'
            </div>
          </div>
          </div>
          </div>');
}

?>
<body>



<div class="container">
<form class="form-signin" action="index.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">
<h3 class="form-signing-heading">Enlaces episodio</h3>

<div class="col-xs-11">
<label for="syn" class="sr-only">Sinopsis</label>
<textarea class="form-control" rows="10" placeholder="Sinopsis" name="syn" id="syn"  required /></textarea>
</div>
<div class="row">
<div class="col-xs-11">
<div class="col-xs-3">
  <input class="form-control" id="lab1" name="lab1" type="text" placeholder="Etiqueta" >
</div>
<div class="col-xs-4">
  <input class="form-control" id="link1" name="link1" type="text" placeholder="Link del episodio">
</div>
<div class="col-xs-4">
  <label class="radio-inline"><input type="radio" name="optradio1" value="1">Video</label>
  <label class="radio-inline"><input type="radio" name="optradio1" value="2">Descarga</label>
  <label class="radio-inline"><input type="radio" name="optradio1" value="3">Video y descarga</label>
</div>
</div>
</div>

<div class="row">
<div class="col-xs-11">
<div class="col-xs-3">
  <input class="form-control" id="lab2" name="lab2" type="text" placeholder="Etiqueta" >
</div>
<div class="col-xs-4">
  <input class="form-control" id="link2" name="link2" type="text" placeholder="Link del episodio">
</div>
<div class="col-xs-4">
  <label class="radio-inline"><input type="radio" name="optradio2" value="1">Video</label>
  <label class="radio-inline"><input type="radio" name="optradio2" value="2">Descarga</label>
  <label class="radio-inline"><input type="radio" name="optradio2" value="3">Video y descarga</label>
</div>
</div>
</div>

<div class="row">
<div class="col-xs-11">
<div class="col-xs-3">
  <input class="form-control" id="lab3" name="lab3" type="text" placeholder="Etiqueta" >
</div>
<div class="col-xs-4">
  <input class="form-control" id="link3" name="link3" type="text" placeholder="Link del episodio">
</div>
<div class="col-xs-4">
  <label class="radio-inline"><input type="radio" name="optradio3" value="1">Video</label>
  <label class="radio-inline"><input type="radio" name="optradio3" value="2">Descarga</label>
  <label class="radio-inline"><input type="radio" name="optradio3" value="3">Video y descarga</label>
</div>
</div>
</div>

<div class="row">
<div class="col-xs-11">
<div class="col-xs-3">
  <input class="form-control" id="lab4" name="lab4" type="text" placeholder="Etiqueta" >
</div>
<div class="col-xs-4">
  <input class="form-control" id="link4" name="link4" type="text" placeholder="Link del episodio">
</div>
<div class="col-xs-4">
  <label class="radio-inline"><input type="radio" name="optradio4" value="1">Video</label>
  <label class="radio-inline"><input type="radio" name="optradio4" value="2">Descarga</label>
  <label class="radio-inline"><input type="radio" name="optradio4" value="3">Video y descarga</label>
</div>
</div>
</div>

<div class="row">
<div class="col-xs-11">
<div class="col-xs-3">
  <input class="form-control" id="lab5" name="lab5" type="text" placeholder="Etiqueta" >
</div>
<div class="col-xs-4">
  <input class="form-control" id="link5" name="link5" type="text" placeholder="Link del episodio">
</div>
<div class="col-xs-4">
  <label class="radio-inline"><input type="radio" name="optradio5" value="1">Video</label>
  <label class="radio-inline"><input type="radio" name="optradio5" value="2">Descarga</label>
  <label class="radio-inline"><input type="radio" name="optradio5" value="3">Video y descarga</label>
</div>
</div>
</div>




<div class="col-xs-11">
<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="Generar código"/>
</div>
</form>
</div>
</body>
</html>
</body>