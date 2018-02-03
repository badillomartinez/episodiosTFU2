<?php
function head($title)
{echo('<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<style>
.overflow-hidden{
    overflow:hidden;
}
 
.left-margin-10px{
    margin:0 1em 0 0;
}
 
.margin-right-1em{
    margin-right:1em;
}
 
.margin-right-2em{
    margin-right:2em;
}
 
.text-align-center{
    text-align:center;
}
 
.margin-top-4px{
    margin-top:4px;
}
 
.color-gray{
    color:#999;
}
 
.tweet-image{
    float:left; width:15%;
    margin-right:1em;
}
 
.tweet-image img{
    width:100%;
}
 
.tweet-text{
    float:left; width:80%;
}
 
.margin-zero{
    margin:0;
}
 
.font-size-20px{
    font-size:20px;
}
 
.float-left{
    float:left;
}
</style>
<title>'.$title.'</title>
</head>');

}
?>