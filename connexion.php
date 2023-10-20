<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "doctorat";

    $con = mysqli_connect($server, $user, $password, $database);
    if(!$con){
        echo "erreur de connexion ". mysqli_error($con);
    }
    

?>