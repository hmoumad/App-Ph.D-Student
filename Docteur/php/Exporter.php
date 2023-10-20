<?php
    include('../../connexion.php');
    header("Content-Type: application/vnd-ms-excel");
    header('Content-Disposition: attachment; filename="Docteur.xls"');
    $sql="SELECT * FROM docteur";
    $query=Mysqli_query($con,$sql);
?>
<head>
    <meta charset="UTF-8">
    <style>
    table
    {
        font-size:14pt;
        font-family:Helvetica, sans-serif;
    }
    </style>
<head>

<table border='1'>
    <tr>
        <th style="Background:yellow;">APOGEE</th>
        <th style="Background:yellow;">CIN</th>
        <th style="Background:yellow;">CNE</th>
        <th style="Background:yellow;">Nom Fr</th>
        <th style="Background:yellow;">Nom Ar</th>
        <th style="Background:yellow;">Prénom Fr</th>
        <th style="Background:yellow;">Prénom Ar</th>
        <th style="Background:yellow;">Date Naissance</th>
        <th style="Background:yellow;">Lieu Naissance Fr</th>
        <th style="Background:yellow;">Lieu Naissance Ar</th>
        <th style="Background:yellow;">Centre d'études</th>
        <th style="Background:yellow;">Formation</th>
        <th style="Background:yellow;">Specialite</th>
    </tr>
    <?php
    while($Row=mysqli_fetch_array($query))
        {?>
            <tr>
                <td><?php echo $Row["CODE_Doc"] ?></td>
                <td><?php echo $Row["CIN_Doc"] ?></td>
                <td><?php echo $Row["CNE_Doc"] ?></td>
                <td><?php echo $Row["Nom_fr"] ?></td>
                <td><?php echo $Row["Nom_arab"] ?></td>
                <td><?php echo $Row["Prenom_fr"] ?></td>
                <td><?php echo $Row["Prenom_arab"] ?></td>
                <td><?php echo $Row["Date_Naissance"] ?></td>
                <td><?php echo $Row["Lieu_Naiss_fr"] ?></td>
                <td><?php echo $Row["Lieu_Naiss_arab"] ?></td>
                <td><?php echo $Row["Centre_Etude"] ?></td>
                <td><?php echo $Row["Formation"] ?></td>
                <td><?php echo $Row["Specialite"] ?></td>
            </tr>
        <?php } ?>
</table>