<?php
    require("../../connexion.php");
    header("Content-type: application/vnd-ms-excel");
    header('Content-disposition:attachemnt;Filename="Soutnances.xls"');
    $sql="SELECT * FROM soutenance";
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
        <th style="Background:yellow;">Apoojet </th>
        <th style="Background:yellow;">CIN Jury</th>
        <th style="Background:yellow;">Titre Travail</th>
        <th style="Background:yellow;">Date Soutenance</th>
        <th style="Background:yellow;">Grade Jury</th>
        <th style="Background:yellow;">Statut Jury</th>
        <th style="Background:yellow;">Etablissement Jury</th>
    </tr>
    <?php
    while($Row=mysqli_fetch_array($query))
        {?>
            <tr>
                <td><?php echo $Row["CODE_Doc"] ?></td>
                <td><?php echo $Row["CIN_J"] ?></td>
                <td><?php echo $Row["Titre_Travail"] ?></td>
                <td><?php echo $Row["Date_Soutenance"] ?></td>
                <td><?php echo $Row["Grade_J"] ?></td>
                <td><?php echo $Row["Statut_J"] ?></td>
                <td><?php echo $Row["Etablissement_J"] ?></td>
            </tr>
        <?php } ?>
</table>