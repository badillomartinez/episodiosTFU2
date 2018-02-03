<?php
include('funciones.php');
include('header.php');
head("Agregar Serie");
?>

<body >
<div class="container">
<form class="form-signin" action="insertaserie.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">
<h2 class="form-signing-heading">Datos de la serie</h2>
<h3 class="form-signing-heading">Nombre de la serie</h3>
<input type="text" class="form-control" name="nombreserie" id="desc" required />
<h3 class="form-signing-heading">Año de inicio</h3>
<input type="text" class="form-control" name="anioinicio" id="desc" required />
<br />
<br />
<br />
<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="añadir serie"/>
</form>
</div>
</body>
</html>