<?php
//$url="http://www.verdragonballsuper.tv/2017/06/dragon-ball-super-1-espanol-sub.html";
$urlContent = file_get_contents('http://www.verdragonballsuper.tv/2017/06/dragon-ball-super-1-espanol-sub.html');

$dom = new DOMDocument();
@$dom->loadHTML($urlContent);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");

for($i = 0; $i < $hrefs->length; $i++){
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    // validate url
    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
        echo '<a href="'.$url.'">'.$url.'</a><br />';
    }
}
?>