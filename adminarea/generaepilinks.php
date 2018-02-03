<?php 
include('funciones.php');
include_once('header.php');
if(isset($_GET["temporada"])){
	$idtemp=$_GET["temporada"];
	$idserie=idseriebyidtemp($idtemp);
	$serie=datosserie($idserie)[1];
	$numtemporada=numerotemp($idtemp);

}
head("Agregar episodio");

echo('<BODY>
<div class="container">');
if(!isset($idtemp)){
	echo('<form class="form-signin" action="insertaepilinks.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">');
}
else{
	echo('<form class="form-signin" action="insertaepilinks.php?temporada='.$idtemp.'" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">');

}
if (!isset($serie)){
echo('<h3 class="form-signing-heading">Nombre de la serie</h3>');	
echo('<select class="form-control" name="nombreserie" id="desc" required >');
$quelist="SELECT * FROM series";
$manlist=mysql_query($quelist);
while($renglon=mysql_fetch_row($manlist)){
    echo("<option value='".$renglon[0]."' >".$renglon[1]."</option>".PHP_EOL);
}

echo("</select>");
}
else{
	echo('<h3 class="form-signing-heading">Serie: </h3>
	<h4>'.$serie.' </h4>');
}

if(!isset($numtemporada)){
	echo('<h3 class="form-signing-heading">Numero de Temporada</h3>
<select class="form-control" name="temp" id="temp" required >');

for($i=1; $i<15; $i++)
{
	echo("<option value='".$i."' >".$i."</option>".PHP_EOL);
}
}
else{echo('<h3 class="form-signing-heading">Temporada:</h3>
<h4>'.$numtemporada.'</h4>');

}
?>
</select>
<h3 class="form-signing-heading">Numero del episodio</h3>
<input type="text" class="form-control" name="numepi" id="numepi" required />
<h3 class="form-signing-heading">Titulo del episodio</h3>
<input type="text" class="form-control" name="titue" id="titue" required />
<h3 class="form-signing-heading">Imagen del episodio</h3>
<input type="file" class="btn btn-default" name="imgepi" id="imgepi"/>
<div class="col-xs-11">
<label for="syn" class="sr-only">Sinopsis</label>
<textarea class="form-control" rows="10" placeholder="Sinopsis" name="syn" id="syn"  required /></textarea>
</div>
</br>
<h3 class="col-xs-11">Enlaces episodio</h3>

<?php
for($j=1;$j<=5;$j++){
	echo('<div class="row">
<div class="col-xs-11">
<div class="col-xs-3">
  <input class="form-control" id="lab'.$j.'" name="lab'.$j.'" type="text" placeholder="Etiqueta" >
</div>
<div class="col-xs-4">
  <input class="form-control" id="link'.$j.'" name="link'.$j.'" type="text" placeholder="Link del episodio">
</div>
<div class="col-xs-4">
  <label class="radio-inline"><input type="radio" name="optradio'.$j.'" value="1">Video</label>
  <label class="radio-inline"><input type="radio" name="optradio'.$j.'" value="2">Descarga</label>
  <label class="radio-inline"><input type="radio" name="optradio'.$j.'" value="3">Video y descarga</label>
</div>
</div>
</div>
');
}
?>
<div class="col-xs-11">
<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="Insertar episodio"/>
</div>
</form>
</div>
</BODY>