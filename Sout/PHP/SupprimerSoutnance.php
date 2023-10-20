<?php
    Require("../../connexion.php");
    if(!empty($_GET["idS"]))
    {
        $q="Delete from soutenance where id_soutenance='".$_GET["idS"]."'";
    }else
    {
        $q="Delete from soutenance";
    }
    $Res=MySqli_Query($con,$q);
    echo "<script>window.location.href='http://localhost/Doctorat/Sout/Soutnance.php';</script>";
?>