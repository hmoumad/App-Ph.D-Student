<?php
    Require_once "../../connexion.php";
    $Res=MySqli_Query($con,"SELECT * FROM docteur inner join soutenance on soutenance.CODE_Doc=docteur.CODE_Doc inner join jury on `jury`.`CIN_J`=`soutenance`.`CIN_J`  where id_soutenance=".$_GET["id"]);
    $Row=MySqli_Fetch_ASSOC($Res);  
    ob_start();
?>
<style>
    h3,h4
    {
        text-align: center;
    }
    h4
    {
        margin-top:10px;
    }
    .Docteur
    {
        width:100%;
        font-size:16px;
        margin-top:15px;
    }
    .Quistion
    {
        padding-left:60pt;
        vertical-align:top;
        padding-right:30pt;
        margin-bottom: 25px;
    }
    .Reponse
    {
        padding-bottom:15px;
        vertical-align:top;
        width:300pt;
        line-height: 1.6;
    }
    .Jurys
    {
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        margin-left:10pt;
        font-size:16px;
        border-collapse: collapse;
    }
    .jurys th
    {   
        border-top:1px solid black;
    }
    .jurys th,.jurys td
    {   
        border-bottom:1px solid black;
        width:133pt;
        padding: 10px 0;
        text-align:center;
    }
    .LieuDate
    {
        font-size:16px;
        text-align: right;
        width:500pt;
        margin-top:50px;
    }
</style>
<page backtop="3mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <h3>ATTESTATION DE REUSSITE<br/><br/>AU<Br/><Br/>DIPLÔME DE DOCTORAT</h3>
    <h4>le doyen de la faculté Polydisciplinaire Béni Mellal atteste que le<br>
        <p style="margin-top:10px">diplôme en Doctorat a été décerné à</p>
        <p style="margin-top:8px">Mr/Mme <?php echo $Row['Nom_fr'].'  '.$Row['Prenom_fr']; ?></p>
    </h4>
    <table class="Docteur">
        <tr>
            <td class="Quistion">Né(e) Le :</td>
            <td class="Reponse"><?php echo date("d-m-Y", strtotime($Row['Date_Naissance'])); ?><span style="margin-left:30px;"> à &nbsp; &nbsp; &nbsp; &nbsp;</span><?php echo $Row['Lieu_Naiss_fr'] ?></td>
        </tr>
        <tr>
            <td class="Quistion">Titre Des Travaux:</td>
            <td class="Reponse"><?php echo $Row["Titre_Travail"]; ?></td>
        </tr>
        <tr>
            <td class="Quistion">Date De Soutenance :</td>
            <td class="Reponse"><?php echo date("d-m-Y", strtotime($Row["Date_Soutenance"]))?></td>
        </tr>
        <tr>
            <td class="Quistion">Centre d'Etudes Doctorales :</td>
            <td class="Reponse"><?php echo $Row['Centre_Etude']?></td>
        </tr>
        <tr>
            <td class="Quistion">Formation Doctorale :</td>
            <td class="Reponse"><?php echo $Row['Formation']?></td>
        </tr>
        <tr>
            <td class="Quistion">Spécialité :</td>
            <td class="Reponse"><?php echo $Row['Specialite']?></td>
        </tr>
    </table>
    <div style="width:100pt"><h4>Jury :</h4></div>
    <table class="Jurys" style="width: 100%">
            <tr>
                <th><em>Nom et Prénom</em></th>
                <th><em>Grade</em></th>
                <th><em>Statut</em></th>
                <th><em>Etablissement</em></th>
            </tr>
            <?php do { ?>
                <tr>
                    <td style="text-align: left; padding-left:5pt;"><?php echo $Row["Nom_J"].' '.$Row["Prenom_J"]; ?></td>
                    <td><?php echo $Row["Grade_J"]; ?></td>
                    <td><?php echo $Row["Statut_J"]; ?></td>
                    <td><?php echo $Row["Etablissement_J"]; ?></td>
                </tr>
            <?php }while($Row=MySqli_Fetch_ASSOC($Res));?>
    </table>
    <div class="LieuDate">Fait à Béni Mellal, Le <?php echo date("d/m/Y")?></div>
    <page_footer>
        <div style="text-align:center">Avis Important :il ne peut être délivré qu'un seul exemplaire de cette attestation. Aucun duplicata ne sera fourni</div>
    </page_footer>
</page>
<?php     
    require __DIR__.'/vendor/autoload.php';
    $HTML=ob_get_clean();
    use Spipu\Html2Pdf\Html2Pdf;
    try{
    $pdf = new Html2Pdf();
    $pdf->pdf->SetDisplayMode('fullpage');
    $pdf->writeHTML($HTML);
    $pdf->output("ATTESTATION DE REUSSITE DOCTORAT.pdf","i");
    }catch(HTML2PDF_exception $e)
    {
        die($e);
    }
?>