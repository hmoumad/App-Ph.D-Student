<?php 
    require_once('../../connexion.php');

    @ $cin_jury = $_GET['idjury'];

    if(!empty($cin_jury))
    {
        $sql = "DELETE FROM jury WHERE CIN_J = '$cin_jury'";
    }else
    {
        $sql = "DELETE FROM jury";
    }
    if(!$sql){
        echo "erreur de la requet " . mysqli_error($con);
    }
    $query = mysqli_query($con, $sql);
    if(!$query){
        echo "erreur de l'execution " . mysqli_error($con);
    }
    else{
        header('location:../jury.php');
    }

?>