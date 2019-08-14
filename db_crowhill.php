<?php
/*
Configurasi setting database disini
*/

$mySQLserver = "localhost";
$mySQLuser = "root";
$mySQLpassword = "";
$mySQLdefaultdb = "crowhill";


$link = mysqli_connect($mySQLserver, $mySQLuser, $mySQLpassword,$mySQLdefaultdb) or die ("Could not connect to MySQL");

//================EOF=========================
?>