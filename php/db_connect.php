<?php
$db_host = "uscitp.com";
$db_user = "asrorov_daler";
$db_pass = "usc2015";
$db_name = "asrorov_final_project";

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($mysqli->errno){
    exit($mysqli->error);
}