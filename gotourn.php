<?php

// skal motta lenke, bilde, tittel
// dynamisk lage og-data
// så videresende til lenke
// params: 0: tittel og forfatter 1: Delt via bla blab la 2: lenke 3: bilde

$param = urldecode(base64_decode($_REQUEST['params']));
// echo $param;
$params = explode ("|x|", $param);

// Lagrer bilde til disk

$datestamp = date ("Ymd") . time();
$url = $params[3];

$img = dirname(__FILE__) . "/cache/" . $datestamp . ".jpg";

$actual_link = "http://" . $_SERVER[HTTP_HOST] . $_SERVER[SCRIPT_NAME];
$ferdigbildeurl = str_replace ("gotourn.php" , "cache/" . $datestamp . ".jpg" , $actual_link);

file_put_contents($img, file_get_contents($url));

// lagre bilde til disk med datostempel først
// slette bilder som ikke har dagens dato
// finne url til bilde

/*
echo "<pre>";
print_r($params);
echo "</pre>";
*/


?>
<html>
<head>

<?php
echo "<!--";
echo $url . " * " . $img;
echo "-->";
?>

<title>Du blir straks sendt videre <?php echo dirname(__FILE__); ?></title>

<meta property="og:title" content="<?=strip_tags(stripslashes($params[0]));?>">
<meta property="og:description" content="<?=strip_tags(stripslashes($params[1]));?>">
<meta property="og:image" content="<?=urldecode($ferdigbildeurl);?>">
<meta property="og:image:type" content="image/jpeg">

<!--
<meta http-equiv="refresh" content="5;<?=strip_tags(stripslashes($params[2]));?>" /> 
-->
</head>
<body><!-- <img src="<?php echo $ferdigbildeurl; ?>" />--></body>
</html>
