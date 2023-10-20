<?php
    require_once('../../connexion.php');
    if(isset($_POST['update'])){
    $CIN = $_POST['CIN'];
    $nomfrancais = $_POST['nomF'];
    $prenomfr = $_POST['prenomF']; 
    $nomarab = $_POST['nomA'];
    $prenomarab = $_POST['prenomA'];

    $sql1 = "UPDATE jury SET Nom_J='".$nomfrancais."',Nom_J_arab ='".$nomarab."',Prenom_J ='".$prenomfr."',Prenom_J_arab ='".$prenomarab."' WHERE CIN_J='".$CIN."'";
    $query1 = mysqli_query($con, $sql1);
    if(!$query1){
        $error = "Error : " . mysqli_error($con);
    }else{
        $reussit = "Data was uploaded successfully" ;
        header('location:../jury.php');
    }
}
?>