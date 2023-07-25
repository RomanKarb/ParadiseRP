<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="serverbar.css" type="text/css" media="screen, projection, tv" />
<script type='text/javascript' src='serverbar.js'></script>
<style type="text/css">
* {margin: 0px; padding: 0px;}
body {
font-size: 16px;
font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
color: #ededed;
-webkit-font-smoothing: antialiased;
-moz-font-smoothing: antialiased;
font-smoothing: antialiased;
}
</style>
<script type="text/javascript">
window.onload = function () { ProgressBarManager('progressbar_meter',true).Live() }
</script>
</head>
<body>
<?php 
$hostt=$_GET['ip'];
$hosttt=$_GET['p'];
$motdd=$_GET['m'];
if($_GET['p']!='') {} else {$hosttt = '25565';}
$holder_width=$_GET['l'];
if($_GET['l']='') {$holder_width = '250';}
$host = "{$hostt}";

function writeCache($content, $filename) { 
    $fp = fopen('./cache/' . $filename, 'w'); 
    fwrite($fp, $content); 
    fclose($fp); 
  }
function readCache($filename, $expiry) { 
    if (file_exists('./cache/' . $filename)) { 
      if ((time() - $expiry) > filemtime('./cache/' . $filename)) 
        return FALSE; 
      $cache = file('./cache/' . $filename); 
      return implode('', $cache); 
    } 
    return FALSE; 
  }

ob_start(); 
if (!$header = readCache("$host..$hosttt.cache", 60)) {

$socket = @fsockopen($host, $hosttt);
if ($socket == false) {
?>
<div class="server-info-holder" style="width:<?php echo $holder_width; ?>px">
	<div class="server-info-name" style="width:<?php echo ($holder_width-10); ?>px"></div>
	<div class="server-info-state" style="width:<?php echo ($holder_width-20); ?>px">	
		<div class="progressbar_overlay">Технические работы</div>
			<div class="redbar" style="width:<?php echo ($holder_width-20); ?>px">
		<div class="progressbar_meter" style="width:100%"></div>	
		</div>
	</div>
</div>
<?php
return;
}
@fwrite($socket, "\xFE");
$data = "";
$data = @fread($socket, 1024);
@fclose($socket);
if ($data == false or substr($data, 0, 1) != "\xFF") return;
$info = explode("\xA7", mb_convert_encoding(substr($data,1), "iso-8859-1", "utf-16be"));
$playersOnline = $info[1];
$playersMax = $info[2];
if($playersOnline >= $playersMax) {$sdd = "full";} else {$sdd = "greenbar";}
$holder_width10 = $holder_width-10;
$holder_width20 = $holder_width-20;
$px = "px";
$nnn = ($playersOnline/$playersMax)*100;
if($_GET['m']!='') {$motd = "";} else {$motd = $info[0].' - ';}
$vvvv = <<<HTML
<?php
\$asdddd = '<div class="server-info-holder" style="width:$holder_width$px">
	<div class="server-info-name" style="width:$holder_widthh10$px"></div>
	<div class="server-info-state" style="width:$holder_width20$px">
		<div class=$sdd style="width:$holder_width20$px">
			<div class="progressbar_meter" style="width:$nnn%">$motd$playersOnline/$playersMax</div>	
		</div>	
	</div>
 </div>
</div>
</body>
</html>'
?>
HTML;
$con_file = fopen("cache/$host..$hosttt.cache", "w+");
fwrite($con_file, $vvvv);
fclose($con_file);	
$header = ob_get_contents(); 
ob_clean(); 
writeCache($header,"cache/$host..$hosttt.cache");
}
include "cache/$host..$hosttt.cache";
echo "$asdddd";
?>
