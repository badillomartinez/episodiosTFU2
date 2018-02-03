<?php
include('header.php');
include('funciones.php');
head("Episodios TFU--Area de administración");
?>
<body>
	<h1>Bienvenido a la zona temporal de administración</h1>
	<h2>Las funciones temporales de la app para admins son:</h2>
	<?php 
	if(isset($_GET["serie"])){
		$datos=datosserie($_GET["serie"]);
		echo("<h4>Id de serie: </h4>".$datos[0]."</br>
              <h4>Título: </h4>".$datos[1]."</br>
              <h4>Año: </h4>".$datos[2]."</br>		
			");
		echo('<div class="panel-primary">
					<div class="panel-heading">Temporadas</div>
					<div class="panel-body"><p>Las Temporadas de '.$datos[1].' agregadas hasta el momento son(Click en el título para gestionar los episodios):</p>');
	          
	           $quelist="SELECT * FROM `temporada` WHERE `Series_idSeries` = ".$datos[0];
	           $manlist=mysql_query($quelist);
	           echo("<table class='table-bordered'>
	           	<thead>
	           	<tr>
	           	<td>ID Temporada</td>
	           	<td>Numero Temporada</td>
	           	<td>Descripción</td>
	           	<td>Año</td>
	           	<td>Portada</td>
	           	</tr>
	           	</thead>
	           	");
	           while($renglon=mysql_fetch_row($manlist)){
	           echo("<tr><td><a href='index.php?temporada=".$renglon[0]."'>".$renglon[0]."</a></td><td><a href='index.php?temporada=".$renglon[0]."'>".$renglon[4]."</a></td><td>".$renglon[1]."</td><td>".$renglon[3]."</td><td><a href='index.php?temporada=".$renglon[0]."'><img src='../imagenes/".$renglon[5]."'></a></td></tr>".PHP_EOL);
	           }
	           echo("</table>");
	          
	          echo('<p><a class="btn btn-primary btn-lg" role="button" href="createmp.php?serie='.$_GET["serie"].'">Agregar Temporada a esta serie</a></p>
	                    		</div>
	                    	</div>');
	}
	else if(isset($_GET["temporada"])){
				
			/*echo("<h4>Id de serie: </h4>".$datos[0]."</br>
              <h4>Título: </h4>".$datos[1]."</br>
              <h4>Año: </h4>".$datos[2]."</br>	
              <h4>Número de temporada:</h4>
			      ");*/
		      echo('<div class="panel-primary">
					<div class="panel-heading">Episodios</div>
					<div class="panel-body"><p>Los episodios disponibles de esta temporada son:(Click en el título para gestionar los episodios):</p>');
	          
	           $quelist="SELECT * FROM `episodios` WHERE `Temporada_idTemporada` = ".$_GET['temporada'];
	           $manlist=mysql_query($quelist);
	           echo("<table class='table-bordered'>
	           	<thead>
	           	<tr>
	           	<td>ID Episodio</td>
	           	<td>Numero de Episodio en la temporada</td>
	           	<td>Título</td>
	           	<td>Portada</td>
	           	</tr>
	           	</thead>
	           	");
	           while($renglon=mysql_fetch_row($manlist)){
	           echo("<tr ><td>".$renglon[0]."</td><td><a href='index.php?temporada=".$renglon[0]."'>".$renglon[3]."</a></td><td><a href='index.php?temporada=".$renglon[0]."'>".$renglon[4]."</a></td><td><a href='index.php?temporada=".$renglon[0]."'><img src='../imagenes/".$renglon[7]."'></a></td></tr>".PHP_EOL);
	           }
	           echo("</table>");
	          
	          echo('<p><a class="btn btn-primary btn-lg" role="button" href="generaepilinks.php?temporada='.$_GET["temporada"].'">Agregar episodio a la temporada</a></p>
	                    		</div>
	                    	</div>');
	}
	else{echo('<div class="panel-primary">
					<div class="panel-heading">Series</div>
					<div class="panel-body"><p>Las series agregadas hasta el momento son(Click en el título para gestionar las temporadas):</p>');
	           $quelist="SELECT * FROM series";
	           $manlist=mysql_query($quelist);
	           echo("<table class='table-bordered'>
	           	<thead>
	           	<tr>
	           	<td>ID serie</td>
	           	<td>Nombre</td>
	           	</tr>
	           	</thead>
	           	");
	           while($renglon=mysql_fetch_row($manlist)){
	           echo("<tr ><td>".$renglon[0]."</td><td><a href='index.php?serie=".$renglon[0]."'>".$renglon[1]."</a></td>".PHP_EOL);
	           }
	           echo("</table>");
	          
	          echo('<p><a class="btn btn-primary btn-lg" role="button" href="creaserie.php">Agregar serie</a></p>			
			  </div>
			        <p><a class="btn btn-primary btn-lg" role="button" href="masivo.php">Agregado masivo</a></p>
			  </div>');
						
						}
	?>
</body>