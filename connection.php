<?php
$servername = "localhost";

$username   = "root";
$password   = "";
$dbname     = "gvtrack";

// $username   = "id19853606_9vtr4ck";
// $password   = "$+Df4Pmv9k]3I@[f";
// $dbname     = "id19853606_gvtrack";


$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn->connect_error)
{
    die("Connection Failed : ".mysqli_connect_error());
}

?>