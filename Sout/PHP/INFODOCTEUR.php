<?php
Require("../../connexion.php");
    $query="SELECT CODE_Doc,CIN_Doc,CNE_Doc,Nom_fr,Prenom_fr,Formation,Specialite,Centre_Etude FROM `docteur` where CODE_Doc='".$_GET["id"]."' or CIN_Doc='".$_GET["id"]."' or CNE_Doc='".$_GET["id"]."'";
    $Res=MySqli_Query($con,$query);
    while($Rw=MySqli_Fetch_Assoc($Res)){
        $CodeD=$Rw["CIN_Doc"];
?>
<?php 
    echo '
    <table border="5" id="Info_Doc">
        <tr>
            <td>Code Docteur </td><td>:</td><td><span id="CodeD">'.$Rw["CODE_Doc"].'</span></label></td>
        </tr>
        <tr>
            <td>CIN </td><td>:</td><td>'. $Rw["CIN_Doc"].'</td>
        </tr>
        <tr>
            <td>Nom </td><td>:</td><td>'. $Rw["Nom_fr"].'</td>
        </tr>
        <tr>
            <td>Prenom </td><td>:</td><td>'. $Rw["Prenom_fr"].'</td>
        </tr>
        <tr>
            <td>Centre Etude </td><td>:</td><td>'. $Rw["Centre_Etude"].'</td>
        </tr>
        <tr>
            <td>Formation </td><td>:</td><td>'. $Rw["Formation"].'</td>
        </tr>
        <tr>
            <td>Specialite </td><td>:</td><td>'. $Rw["Specialite"].'</td>
        </tr>
    </table>';
} MySqli_Free_Result($Res); 
?>
