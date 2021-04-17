<?php
$host = "localhost";
$dbuser = 'admin';
$dbpass = '12345';
$dbname = "eshop";

@$con = mysqli_connect($host,$dbuser,$dbpass,$dbname);
if (!$con) {
  die("nooo connect");
}
