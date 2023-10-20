<?php
    require_once('../../connexion.php');

    @ $codedoc = $_GET['codedoc'];
    if(!empty($codedoc))
    {
        $sql = "DELETE FROM docteur WHERE CODE_Doc = $codedoc";
    }else
    {
        $sql = "DELETE FROM docteur";
    }
    if(!$sql){
        echo "erreur de la requet " . mysqli_error($con);
    }
    $query = mysqli_query($con, $sql);
    if(!$query){
        echo "erreur de l'execution " . mysqli_error($con);
    }
    else{
        header('location:../Docteur.php');
    }
    
   
?>