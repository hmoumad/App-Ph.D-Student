<?php
//nombre Soutnance
function NBSoutnance()
{
    require("../connexion.php");
    $query=MySqli_Query($con,"SELECT COUNT(DISTINCT id_soutenance) AS 'AllSoutnance'FROM soutenance");
    $row =MySqli_fetch_assoc($query);
    MySqli_free_result($query);
    return $row["AllSoutnance"];
}


function NBLTable($table)
{
    require("../connexion.php");
    $query=MySqli_Query($con,"SELECT count(*) FROM ".$table);
    $row =MySqli_fetch_assoc($query);
    MySqli_free_result($query);
    return $row["count(*)"];
}
function NBLINSOUT($id)
{
    require("../connexion.php");
    $query=MySqli_query($con,"SELECT COUNT(DISTINCT ".$id.") FROM soutenance WHERE Date_Soutenance >= CURRENT_DATE");
    $row=MySqli_fetch_assoc($query);
    MySqli_free_Result($query);
    return $row["COUNT(DISTINCT ".$id.")"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="../Logo/fplogo.png">
    <link rel="stylesheet" href="../Bootstrap/CSS/bootstrap.css">
    <link rel="stylesheet" href="../navbar and footer/navbar.css" />
    <link rel="stylesheet" href="Style.css" />
</head>
<body>
    <?php require_once("../navbar and footer/navbar.php")?>
    <article>
        <div class="content ">
            <div class="STDOC">
                <div class="Sous-Content">
                    <p class="Tit1"><?php echo NBLTable("docteur");?><br>Docteur</p>
                    <p class="Tit2"><?php echo NBLINSOUT("CODE_Doc")?><br> Soutenir</p>
                </div>
                <div class="dsp"><img src="img/KEY0.CC-Registration-For-Under-Graduate-Student-Icon-Png.png"></div>
            </div>
            <div class="STJURY">
                <div class="Sous-Content">
                    <p class="Tit1"><?php echo NBLTable("jury") ?> <br/>Jury</p>
                    <p class="Tit2"><?php echo NBLINSOUT("CIN_J")?><br> juger</p>
                </div>
                <div class="dsp"><img src="img/bloco-de-anotacoes.png"></div>
            </div>
            <div class="STSOUT" >
                <div class="Sous-Content">
                    <p class="Tit1"><?php echo NBSoutnance(); ?> <br>Soutenance</p>
                    <p class="Tit2"><?php echo NBLINSOUT("id_soutenance")?><br> Maintenant</p>
                </div>
                <div class="dsp"><img src="img/presentation (1).png"></div>
            </div>
        </div>
    </article>
    <div class="div2">
            <p style="margin-bottom: 0;">Bienvenue</p>
            <a href="../Admin/Admin.php" class="AjtAdm">Créer nouveau compte</a>
    </div>
    <?php require_once("../navbar and footer/footer.html")?>
 </body>
 <script>
        function PaginationShow() {
            pagination = document.getElementById("pagination");
            if(pagination.style.display === "block"){
                pagination.style.display === "none" ;
            }
        }
    </script>
</html>
<?php
require("../connexion.php");
MySqli_close($con);
?>