<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
include('phpseclib/Net/SSH2.php');

$ssh = new Net_SSH2('localhost');
if (!$ssh->login('pi', 'Zhisolution312')) {
    exit('Login Failed');
}

$ssh->exec('/bin/bash /home/pi/scripts/refresh');
?>

