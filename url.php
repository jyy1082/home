<?php
$url=$_GET['url'];    
echo shell_exec("sudo bash /home/pi/url_config.sh $url");
?>