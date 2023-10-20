<?php
    require("../../connexion.php");
    header("Content-type: application/vnd-ms-excel");
    header('Content-disposition:attachemnt;Filename="Jury.xls"');
    $sql="SELECT * FROM jury";
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
        <th style="Background:yellow;">CIN </th>
        <th style="Background:yellow;">Nom Fr</th>
        <th style="Background:yellow;">Nom Ar</th>
        <th style="Background:yellow;">Prénom Fr</th>
        <th style="Background:yellow;">Prénom Ar</th>
    </tr>
    <?php
    while($Row=mysqli_fetch_array($query))
        {?>
            <tr>
                <td><?php echo $Row["CIN_J"] ?></td>
                <td><?php echo $Row["Nom_J"] ?></td>
                <td><?php echo $Row["Nom_J_arab"] ?></td>
                <td><?php echo $Row["Prenom_J"] ?></td>
                <td><?php echo $Row["Prenom_J_arab"] ?></td>
            </tr>
        <?php } ?>
</table>