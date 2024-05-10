<?php

$conn = mysqli_query("localhost","root","","phptutorial");

if(!$conn){
    die("connection failed" . mysqli_connect_error());
}


?>