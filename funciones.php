<?php
include('conexion.php');

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
function agregavimeo($link, $etiqueta, $i){
   $activo=null;
   $lineavideo="<div class='tab-pane ".$activo."' id='".$i."a'>".vimeoembed($link)."</div>".PHP_EOL;
   return($lineavideo);
}
function agregaetiqueta($etiqueta, $i){
   $activo=null;
   if($i==1){$activo="class='active'"; }
   $lineaetiqueta="<li ".$activo.">
               <a  href='#".$i."a' data-toggle='tab'>".$etiqueta."</a>
            </li>".PHP_EOL;
    return($lineaetiqueta);
}

function agregavideo($link, $etiqueta, $i){
   $activo=null;
   if($i==1){$activo="active"; }
   $lineavideo="<div class='tab-pane ".$activo."' id='".$i."a'>".openloadembed($link)."</div>".PHP_EOL;     
               
   return($lineavideo);
}
function agregadescarga($link, $etiqueta){
   $taglink="<a href='".$link."' target='_blank' >".$etiqueta."</a></br>".PHP_EOL;
   return($taglink);
}
function buscaserver($link){
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
function agregaadfly($link, $etiqueta){
   $link=adfly($link);
   $taglink="<a href='".$link."' target='_blank' >".$etiqueta."</a></br>".PHP_EOL;
   return($taglink);
}
function activo($episodio){
    $queactivo="SELECT * FROM `links` WHERE `activo` = 1 AND `Episodios_idEpisodios` = ".$episodio;
    $manactivo=mysql_query($queactivo);
    if(!mysql_fetch_row($manactivo)){
    	return("1");
    }
    return("2");
}
function elementocarruselchico($cadenalink, $rutaimagen, $titulo ){
  echo('<div class="item">
              <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                                  <a href="episodio.php?'.$cadenalink.'" class="hvr-shutter-out-horizontal"><img src="'.$rutaimagen.'" title="album-name" class="img-responsive" alt=" " />
                                    <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                  </a>
                                  <div class="mid-1 agileits_w3layouts_mid_1_home">
                                    <div class="w3l-movie-text">
                                      <h6><a href="episodio.php?'.$cadenalink.'">'.$titulo.'</a></h6>              
                                    </div>
                                    <div class="mid-2 agile_mid_2_home">
                                      <p>2016</p>
                                      <div class="block-stars">
                                        <ul class="w3l-ratings">
                                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                          <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>
                                  <div class="ribben">
                                    <p>NUEVO</p>
                                  </div>
                                </div>
                              </div>');
}
function datosserie($idserie){
  $queserie=("SELECT * FROM `series` WHERE `idSeries` = ".$idserie);
  $manserie=mysql_query($queserie);
  $datosserie=mysql_fetch_row($manserie);
  return($datosserie);
}
function datostempbyid($idtemp){
  $quetemp="SELECT * FROM `temporada` WHERE `idTemporada` = ".$idtemp;
  $mantemp=mysql_query($quetemp);
  $renglontemp=mysql_fetch_row($mantemp);
  return($renglontemp);
}
function carouselchico($numeroepis){
  $queepis="SELECT * FROM `episodios` ORDER BY idEpisodios DESC ";
  $manepis=mysql_query($queepis);
  $lineas=mysql_num_rows($manepis);
  $tope=min($numeroepis, $lineas);

  for($i=0; $i<$tope; $i++){
    $renglon=mysql_fetch_row($manepis);
    $datostemp=datostempbyid($renglon[5]);
    if($renglon[7]==null){
      $rutaimagen="imagenes/".$datostemp[5];
    }
    else{
      $rutaimagen="imagenes/".$renglon[7];
    }    
    $cadenalink="episodio=".$renglon[0];
    $datosserie=datosserie($renglon[6]);
    $titulo="$datosserie[1] $datostemp[4]x$renglon[3] $renglon[4]";
    elementocarruselchico($cadenalink, $rutaimagen, $titulo);
  }
}
function cabecera($title){
  echo("<head>
  <title>$title</title>
  <!-- for-mobile-apps -->
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <meta name=\"keywords\" content=\"One Movies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design\" />
  <script type=\"application/x-javascript\"> addEventListener(\"load\", function() { setTimeout(hideURLbar, 0); }, false);
      function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!-- //for-mobile-apps -->
  <link href=\"css/bootstrap.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
  <link href=\"css/style.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
  <link rel=\"stylesheet\" href=\"css/contactstyle.css\" type=\"text/css\" media=\"all\" />
  <link rel=\"stylesheet\" href=\"css/faqstyle.css\" type=\"text/css\" media=\"all\" />
  <link href=\"css/single.css\" rel='stylesheet' type='text/css' />
  <link href=\"css/medile.css\" rel='stylesheet' type='text/css' />
  <!-- banner-slider -->
  <link href=\"css/jquery.slidey.min.css\" rel=\"stylesheet\">
  <!-- //banner-slider -->
  <!-- pop-up -->
  <link href=\"css/popuo-box.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
  <!-- //pop-up -->
  <!-- font-awesome icons -->
  <link rel=\"stylesheet\" href=\"css/font-awesome.min.css\" />
  <!-- //font-awesome icons -->
  <!-- js -->
  <script type=\"text/javascript\" src=\"js/jquery-2.1.4.min.js\"></script>
  <!-- //js -->
  <!-- banner-bottom-plugin -->
  <link href=\"css/owl.carousel.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\">
  <script src=\"js/owl.carousel.js\"></script>
  <script>
    $(document).ready(function() { 
      $(\"#owl-demo\").owlCarousel({
     
        autoPlay: 3000, //Set AutoPlay to 3 seconds
     
        items : 5,
        itemsDesktop : [640,4],
        itemsDesktopSmall : [414,3]
     
      });
     
    }); 
  </script> 
  <!-- //banner-bottom-plugin -->
  <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
  <!-- start-smoth-scrolling -->
  <script type=\"text/javascript\" src=\"js/move-top.js\"></script>
  <script type=\"text/javascript\" src=\"js/easing.js\"></script>
  <script type=\"text/javascript\">
    jQuery(document).ready(function($) {
      $(\".scroll\").click(function(event){   
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
      });
    });
  </script>
  <!-- start-smoth-scrolling -->
  </head>");
}
function bannergrande(){
  echo("<!-- banner -->
  <div id=\"slidey\" style=\"display:none;\">
    <ul>
      <li><img src=\"images/5.jpg\" alt=\" \"><p class='title'>Tarzan</p><p class='description'> Tarzan, having acclimated to life in London, is called back to his former home in the jungle to investigate the activities at a mining encampment.</p></li>
      <li><img src=\"images/2.jpg\" alt=\" \"><p class='title'>Maximum Ride</p><p class='description'>Six children, genetically cross-bred with avian DNA, take flight around the country to discover their origins. Along the way, their mysterious past is ...</p></li>
      <li><img src=\"images/3.jpg\" alt=\" \"><p class='title'>Independence</p><p class='description'>The fate of humanity hangs in the balance as the U.S. President and citizens decide if these aliens are to be trusted ...or feared.</p></li>
      <li><img src=\"images/4.jpg\" alt=\" \"><p class='title'>Central Intelligence</p><p class='description'>Bullied as a teen for being overweight, Bob Stone (Dwayne Johnson) shows up to his high school reunion looking fit and muscular. Claiming to be on a top-secret ...</p></li>
      <li><img src=\"images/6.jpg\" alt=\" \"><p class='title'>Ice Age</p><p class='description'>In the film's epilogue, Scrat keeps struggling to control the alien ship until it crashes on Mars, destroying all life on the planet.</p></li>
      <li><img src=\"images/7.jpg\" alt=\" \"><p class='title'>X - Man</p><p class='description'>In 1977, paranormal investigators Ed (Patrick Wilson) and Lorraine Warren come out of a self-imposed sabbatical to travel to Enfield, a borough in north ...</p></li>
    </ul>     
    </div>
    <script src=\"js/jquery.slidey.js\"></script>
    <script src=\"js/jquery.dotdotdot.min.js\"></script>
     <script type=\"text/javascript\">
      $(\"#slidey\").slidey({
        interval: 8000,
        listCount: 5,
        autoplay: false,
        showList: true
      });
      $(\".slidey-list-description\").dotdotdot();
    </script>
<!-- //banner -->");
}
?>