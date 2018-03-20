<?php
$ssid=$_GET['ssid']; 
$psk=$_GET['psk']; 
shell_exec("sudo bash /home/pi/wifi_config.sh $ssid $psk");
?>