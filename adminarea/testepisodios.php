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
function agregavimeo($i){
   $link=$_POST['link'.$i];
   $etiqueta=$_POST['lab'.$i];
   $activo=null;
   $lineavideo="<div class='tab-pane ".$activo."' id='".$i."a'>".vimeoembed($link)."</div>".PHP_EOL;
   return($lineavideo);
}
function agregaetiqueta($i){
   $etiqueta=$_POST['lab'.$i];
   $activo=null;
   if($i==1){$activo="class='active'"; }
   $lineaetiqueta="<li ".$activo.">
               <a  href='#".$i."a' data-toggle='tab'>".$etiqueta."</a>
            </li>".PHP_EOL;
    return($lineaetiqueta);
}

function agregavideo($i){
   $link=$_POST['link'.$i];
   $etiqueta=$_POST['lab'.$i];
   $activo=null;
   if($i==1){$activo="active"; }
   $lineavideo="<div class='tab-pane ".$activo."' id='".$i."a'>".openloadembed($link)."</div>".PHP_EOL;     
               
   return($lineavideo);
}
function agregadescarga($i){
   $link=$_POST['link'.$i];
   $etiqueta=$_POST['lab'.$i];
   $taglink="<a href='".$link."' target='_blank' >".$etiqueta."</a></br>".PHP_EOL;
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
   $taglink="<a href='".$link."' target='_blank' >".$etiqueta."</a></br>".PHP_EOL;
   return($taglink);
}
//print_r($_POST);

if(!empty($_POST['syn'])){
   $cadenatabs=null;
   $cadenalinks="<h2>Si algún archivo les pide contraseña la contraseña es <b>TheFlashUniverse</b></h2></br>";
   $cadenaetiquetas=null;
for($i=1; $i<=5; $i++){
   //$link=;
   if(!empty($_POST['link'.$i])){
      
   $server=buscaserver($i);
   if ($server=="openload"){
    $tipo=$_POST['optradio'.$i];
   if($tipo==1){
      $cadenatabs=$cadenatabs.agregavideo($i);
      $cadenaetiquetas=$cadenaetiquetas.agregaetiqueta($i);
   }
   if($tipo==2){
      $cadenalinks=$cadenalinks.agregadescarga($i);
      
   }
   if($tipo==3){
      $cadenatabs=$cadenatabs.agregavideo($i);
      $cadenalinks=$cadenalinks.agregadescarga($i);
      $cadenaetiquetas=$cadenaetiquetas.agregaetiqueta($i);
   }
   }
   if($server=="otro"){
    $cadenalinks=$cadenalinks.agregaadfly($i);
       }
   if($server=="vimeo"){
    $cadenatabs=$cadenatabs.agregavimeo($i);
    $cadenaetiquetas=$cadenaetiquetas.agregaetiqueta($i);
   }

  }
}
$cuerpodelpost="<div class='container'><h1>Episodio</h1></div>
<h2>".nl2br($_POST['syn'])."</h2>
<div id='exTab1' class='container'> 
<ul  class='nav nav-pills'>
         ".$cadenaetiquetas."
          <li><a href='#6a' data-toggle='tab'>Descargas</a>
         </li>
      </ul>

         <div class='tab-content clearfix'>
          ".$cadenatabs."
          <div class='tab-pane' id='6a'>
          ".$cadenalinks."
            </div>
         </div>
  </div>



<hr></hr>
<!-- Bootstrap core JavaScript
    ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
   <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>";
echo($cuerpodelpost);
}

?>
<body>



<div class="container">
<form class="form-signin" action="testepisodios.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">
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