<?php
include('funciones.php');

?>

<body >
<div class="container">
<form class="form-signin" action="insertatemp.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">
<h2 class="form-signing-heading">Datos de la Temporada</h2>
<h3 class="form-signing-heading">Nombre de la serie</h3>
<select class="form-control" name="nombreserie" id="desc" required />
<?php
$quelist="SELECT idSeries, NombreSerie FROM series";
$manlist=mysql_query($quelist);
while($renglon=mysql_fetch_row($manlist)){
    echo("<option>".$renglon[1]."</option>");
}
?>
</select>
<h3 class="form-signing-heading">Numero de Temporada</h3>
<select class="form-control" name="numtemp" id="desc" required />
<?php
for($i=1;$i<=15;$i++){
    echo("<option>".$i."</option>");
}
?>
</select>
<h3 class="form-signing-heading">Año</h3>
<input type="text" class="form-control" name="anio" id="desc" required />
<h3 class="form-signing-heading">Número de episodios</h3>
<input type="text" class="form-control" name="numeps" id="desc" required />
<br />
<br />
<br />
<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="añadir temporada"/>
</form>
</div>
</body>
</html>