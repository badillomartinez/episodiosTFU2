<?php
include('funciones.php');
include('header.php');
if (isset($_GET["serie"])){
$serie=$_GET["serie"];
head("Agregar Temporada a ".datosserie($serie)[1]);
}
else{head('Agregar temporada');}


echo('<body >
<div class="container">');
if(!isset($serie)){
	echo('<form class="form-signin" action="insertatemp.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">');
}
else{
		echo('<form class="form-signin" action="insertatemp.php?serie='.$serie.'" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">');

}
echo('<h2 class="form-signing-heading">Datos de la Temporada</h2>
<h3 class="form-signing-heading">Nombre de la serie</h3>');



if(!isset($serie)){
echo('<select class="form-control" name="nombreserie" id="desc" required />'.PHP_EOL);
	$quelist="SELECT * FROM series";
$manlist=mysql_query($quelist);
while($renglon=mysql_fetch_row($manlist)){
    echo("<option value='".$renglon[0]."'>".$renglon[1]."</option>".PHP_EOL);}
echo('</select>');
}
else{
 	echo("Serie=".datosserie($serie)[1]);
 } 
?>

<h3 class="form-signing-heading">Numero de Temporada</h3>
<select class="form-control" name="numtemp" id="desc" required />
<?php
if(isset($serie)){
$quetemps="SELECT * FROM `temporada` WHERE `Series_idSeries` = ".$serie." ORDER BY `numtemp` DESC ";
$manserie=mysql_query($quetemps);
$mintemp=mysql_fetch_row($manserie)[4]+1;
if($mintemp==null | !isset($mintemp)){
	$mintemp=1;
}
for($i=$mintemp;$i<=15;$i++){
    echo("<option>".$i."</option>".PHP_EOL);
}

}
else{for($i=1;$i<=15;$i++){
    echo("<option>".$i."</option>".PHP_EOL);
}
}

echo('</select>');

?>
<h3 class="form-signing-heading">Imagen de la Temporada</h3>
<input type="file" class="btn btn-default" name="imgtemp" id="imgtemp"/>
<h3 class="form-signing-heading">Año</h3>
<input type="text" class="form-control" name="anio" id="desc" required />
<h3 class="form-signing-heading">Sinopsis</h3>
<textarea class="form-control" rows="10" placeholder="Sinopsis" name="syn" id="syn"  required /></textarea>
<br />
<br />
<br />
<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="añadir temporada"/>
</form>
</div>
</body>
</html>