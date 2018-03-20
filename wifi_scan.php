<?php
echo shell_exec("sudo iwlist wlan0 scan | awk -F ':' '/ESSID:/ {print $2;}'")
?>