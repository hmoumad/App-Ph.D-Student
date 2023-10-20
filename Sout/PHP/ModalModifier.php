<?php
    Require("../../connexion.php");

    $q=MySqli_Query($con,"SELECT jury.CIN_J,Nom_J,Prenom_J,Grade_J,Statut_J,Titre_Travail,Date_Soutenance,soutenance.CODE_Doc,concat(Nom_fr,' ',Prenom_fr) as 'nom et prenom',Centre_Etude,Etablissement_J FROM jury inner join soutenance on jury.CIN_J=soutenance.CIN_J INNER JOIN docteur d ON soutenance.CODE_Doc=d.CODE_Doc Where id_soutenance=".$_GET["id"]);
    $Row=MySqli_Fetch_Assoc($q);
    echo'
    <div class="modal-header" style="background:#D9FFFF;">
        <h5 class="modal-title" id="Modifier">Modifier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>  
    <form method="POST" style="margin-top:0;" >
        <div class="modal-body" id="modal">

            <div class="col-auto">
                <label>Date Sautnance:</label>
                <input type="Date" class="form-control Date_sout" name="DateST" id="Date" value="'.$Row["Date_Soutenance"].'"/><br/>
                <label>Titre Travail:</label>
                <input type="Text" class="form-control Titre_Travail" name="TitreTr" id="TitreTravail" value="'.$Row["Titre_Travail"].'"/>
            </div>
            <h3 style="Text-align:center;">Docteur</h3>
            <table  id="Info_Doc" border="5">
                <tr>
                    <td>Apogee</td><td>:</td><td>'.$Row["CODE_Doc"].'</td>
                </tr>
                <tr>
                    <td>Nom et Prenom</td><td>:</td><td>'.$Row['nom et prenom'].'</td>
                </tr>
                <tr>
                    <td>Centre Etude</td><td>:</td><td>'.$Row["Centre_Etude"].'</td></tr>
                </tr>
            </table>
            <div  style="overflow-x:auto; margin-bottom:10px;">
                <table id="Jurys" class="grid">
                    <tr class="ModalJurys">
                        <th>CIN</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>Grade</th>
                        <th>Statut</th>
                        <th>Etablissement</th>
                        </tr>';
                        do
                        {
                            echo '<tr>
                            <td data-label="CIN">'.$Row["CIN_J"].'</td>
                            <td data-label="Nom">'.$Row["Nom_J"].'</td>
                            <td data-label="Prénom">'.$Row["Prenom_J"].'</td>
                            <td data-label="Grade">'.$Row["Grade_J"].'</td>
                            <td data-label="Statut">'.$Row["Statut_J"].'</td>
                            <td data-label="Etablissement">'.$Row["Etablissement_J"].'</td>
                            </tr>';
                        }while($Row=MySqli_Fetch_Assoc($q));
                echo '</table>
            </div>
            <button  type="button" class="btn btn-primary" data-bs-target="#JrModf" data-bs-toggle="modal" style="float:right">Jurys</button>
        </div>
        <div class="modal-footer" style="margin-top:35px;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn AjtSout" name="Modifier" id="BTNModifier">Modifier</button>
        </div>
    </form>';
    MySqli_Free_Result($q);
?>