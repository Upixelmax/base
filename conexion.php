<?php
    $username = "proyecto";
    $password = "123";
    $connection_string="localhost/XE";

    $connection = oci_connect(
        $username,
        $password,
        $connection_string
    );
    if($connection){
        echo "funciono la wea";
    }else{
        echo "no prendio";
    }
?>
