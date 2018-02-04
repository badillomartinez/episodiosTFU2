<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<form class="form-signin" action="robaopenload.php" method="post" name="f_prof" id="f_prof" enctype="multipart/form-data">    
<h3 class="form-signing-heading">Enlaces</h3>
<textarea class="form-control"  placeholder="Enlaces uno por linea" name="enl" id="enl"  required /></textarea>
<br />
<br />
<br />
<input type="submit" name="ENVIAR" id="ok" class="btn btn-lg btn-primary btn-block" value="Robar enlaces"/>
</form>
</div>
<?php
if (isset($_POST['enl'])){
    $textenlaces=$_POST['enl'];
    $lista=explode(PHP_EOL, $textenlaces);
    //print_r($lista);
    foreach($lista as $enltemp){
        $enlopenload=robaopenload($enltemp);
        echo($enlopenload);
        echo("</br>");
    }

}
?>
</body>
</html>
<?php
//$url="http://www.verdragonballsuper.tv/2017/06/dragon-ball-super-1-espanol-sub.html";



function robaopenload($enlace){
    $urlContent = file_get_contents($enlace);

$dom = new DOMDocument();
@$dom->loadHTML($urlContent);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//iframe");

for($i = 0; $i < $hrefs->length; $i++){
    $href = $hrefs->item($i);
    $url = $href->getAttribute('src');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    // validate url
    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
        
        $openload=strpos($url, "openload");
        if($openload!=FALSE){
            //echo '<a href="'.$url.'">'.$url.'</a><br />';
            return($url);
        }
    }
}
return(0);
}
?>