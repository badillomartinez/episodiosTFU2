<?php
include("header.php");


function openloadembed($link){
    $parte=explode("/", $link);
    $id=array_pop($parte);
    $id=array_pop($parte).'/'.$id;
    $embed='<iframe src="https://openload.co/embed/'.$id.'" scrolling="no" frameborder="0" width="700" height="430" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
    return($embed);
}

$linksub=$linklat="Proximamente";
$embsub=$emblat=$refsub=$reflat=null;
if(!empty($_POST['sub']) ){
    $linksub=$_POST['sub'];
    $embsub=openloadembed($linksub);
    $refsub="<a href='".$linksub."' target='_blank' >Subtitulado</a>";
    
    
}
if(!empty($_POST['lat']) ){
    $linklat=$_POST['lat'];
    $emblat=openloadembed($linklat);
    $reflat="<a href='".$linklat."' target='_blank' >Audio latino</a>";
    
}
if(!empty($_POST['syn'])){
$cadenaembeed="<p align='justify'><span style='font-family: Arial, serif;'><span style='font-size: small;'>".$_POST['syn']."</span></span></p>".PHP_EOL."


<hr />
<p align='justify'>

[wptab name='Latino SD']".$emblat."[/wptab]".PHP_EOL."

[wptab name='Subtitulado SD']".$embsub."[/wptab]".PHP_EOL."

[wptab name='Descargar']".$refsub."</p>".$reflat."[/wptab]".PHP_EOL."

[end_wptabset]";
echo('<div class="container">
<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Copia este texto en el Area HTML de tu publicación</h3>
            </div>
            <div class="panel-body">
              '.nl2br(htmlspecialchars($cadenaembeed)).'
            </div>
          </div>
          </div>');
          }


?>
<body>



<div class="container">
<form class="form-signin" action="generaepisodiolatino.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">
<h3 class="form-signing-heading">Enlaces episodio</h3>


<label for="syn" class="sr-only">Sinopsis</label>
<input type="text" class="form-control" placeholder="Sinopsis" name="syn" id="syn"  required />
<label for="sub" class="sr-only">Link subtitulado</label>
<input type="text" class="form-control" name="sub" id="sub"  placeholder="Link Subtitulado"  />
<label for="lat" class="sr-only">Link latino</label>
<input type="text" class="form-control" name="lat" id="lat"  placeholder="Link Latino"  />


<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="Generar código"/>
</form>
</div>
</body>
</html>
</body>