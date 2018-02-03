<?php
include('header.php');
include('funciones.php');
head("Episodios TFU--Area de administración");
echo('<body >
<div class="container">');
?>
<h3>Subida masiva de episodios</h3>
<h2>Los archivos masivos deben estar en formato CSV, puedes descargar el formato para llenar <a href='formato.csv'>Aquí</a></h2>
<div class="container"><form class="form-signin" action="insertamasivo.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data"><h2 class="form-signing-heading">Seleccionar Archivo</h2>

<input type="file" class="btn btn-default" accept=".csv" name="imgtemp" id="imgtemp"/>
<br />
<br />
<br />
<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="añadir temporada"/>
</form>
</div>
</body>
</html>