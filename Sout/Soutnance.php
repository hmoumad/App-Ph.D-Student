<?php Require("../connexion.php"); ?>
<?php
    if(IsSet($_POST["BTNsearch"]))
    {
        $date=$_POST["DateRch"];
        $query="SELECT id_soutenance,s.CODE_Doc,CIN_Doc,s.CIN_J,Grade_J,Statut_J,Titre_Travail,Date_Soutenance  FROM soutenance s INNER JOIN docteur d ON s.CODE_Doc=d.CODE_Doc INNER JOIN jury j on s.CIN_J=j.CIN_J where Date_Soutenance='$date' ORDER BY Date_Soutenance Desc,id_soutenance,s.CIN_J";
        $Res=MySqli_Query($con,$query);
        $nbr_page=1;
        $page=1;
    }else
    {
    /*************    Pagination     *****************/ 
        $sql = "SELECT * FROM soutenance ";
        $q = mysqli_query($con, $sql);
        if(!$q){
            echo "erreur de la requette " . mysqli_error($con) ;
        }
        $rowcount = mysqli_num_rows($q);
        $nbr_page=$rowcount/5;
        @$page = $_GET['page'];
        if(empty($page)){
            $page = 1;
        }
        $nbr_elem_par_page = 20;
        $nbr_page = ceil($rowcount / $nbr_elem_par_page);
        $debut = ($page - 1) * $nbr_elem_par_page ;
        $previous = $page - 1 ;
        $next = $page + 1 ;
        if($next>$nbr_page)
        {
            $next = 1 ;
        }
            // Grid Soutnance
        $query="SELECT id_soutenance,s.CODE_Doc,CIN_Doc,s.CIN_J,Grade_J,Statut_J,Titre_Travail,Date_Soutenance  FROM soutenance s INNER JOIN docteur d ON s.CODE_Doc=d.CODE_Doc INNER JOIN jury j on s.CIN_J=j.CIN_J ORDER BY Date_Soutenance Desc,id_soutenance,s.CIN_J limit $debut,$nbr_elem_par_page";
        $Res=MySqli_Query($con,$query);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Soutnance</title>
    <link rel="icon" href="../Logo/fplogo.png">
    <link rel="stylesheet" href="../navbar and footer/navbar.css"/>
    <link rel="stylesheet" href="../navbar and footer/footer.css"/>
    <script src="../jQuery.3.3.1/Content/Scripts/jquery-3.3.1.min.js"></script>
    <link href="../Bootstrap/CSS/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/style.css"/>
    <link rel="stylesheet" href="../Alert/Alert.css">
    <style>
    </style>
</head>
<body>
    <?php Require_once("../navbar and footer/navbar.php") ?>
    <div class="container-fluid raw">
        <form method="POST" class="search">
            <input type="Date" class="form-control txtrch" name="DateRch" value="2022-06-29"/>
            <input type="text" class="form-control txtrch" placeholder="CIN JURY OU APOGEE" id="code" onkeyup="cherche()"/>
            <button class="btn btn-primary searchbutton" type="submit" name="BTNsearch">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                Chercher par date
            </button>
        </form>
        <div class="Insert">
            <!-- ************** Imporyer **************** -->
            <a data-bs-toggle="modal" data-bs-target="#ModalIMPORTER" id="btn1" class="btn btn-primary col-2" style="margin-right: 100px;">
                Import Excel File
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                </svg>
            </a>
            <!-- ************** Ajouter **************** -->
            <a class="btn btn-primary col-2" data-bs-toggle="modal" href="#exampleModalToggle" role="button" onclick="Vider()" style="margin-right: 100px;">
                Ajouter
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                 <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
            </a>
            <!-- ************** Exporter **************** -->
            <a class="btn btn-success" target="_blanck" href="php/ExporterSout.php" style="margin-right: 100px;">
                Exporter Excel
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
            <!-- ************** Vider **************** -->
            <a class="btn btn-danger vider" onclick="SupprimerSout('Supprimer','Vous voulez vider la table soutnance','','supprimer','Annuler')" >
                Vider
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg>
            </a>
        </div>
        <div id="container">
            <table id="Grid" class="grid">
                <tr>
                    <th>id</th>
                    <th>Apogee</th>
                    <th>CIN Jury</th>
                    <th>Grad Jury</th>
                    <th>Statut Jury</th>
                    <th style="width:350px">Titre Travail</th>
                    <th style="width:100px">Date</th>
                    <th style="width:200px">Actions</th>
                </tr>
                <?php while( $Row = Mysqli_fetch_assoc($Res)) { ?>
                    <tr>
                        <td data-label="id :"><?php echo $Row['id_soutenance'] ?></td>
                        <td data-label="Apogee :"><?php echo $Row['CODE_Doc'] ?></td>
                        <td data-label="CIN Jury :"><?php echo $Row['CIN_J'] ?></td>
                        <td data-label="Grad Jury :"><?php echo $Row['Grade_J'] ?></td>
                        <td data-label="Statut Jury :"><?php echo $Row['Statut_J']; ?></td>
                        <td data-label="Titre Travail :" class ="Titre_TravailGrid" style="width:200px"><?php echo $Row['Titre_Travail']; ?></td>
                        <td data-label="Date Soutenance :"><?php echo $Row['Date_Soutenance']; ?></td>
                        <td data-label="Actions :" class ="Actions" style="width:300px">
                            <a id="<?php echo  $Row["id_soutenance"] ?>" name="editer" onclick="Vider()" data-toggle="modal" class="btn btn-success Mod">Modifier</a>
                            <a href="#" id="delete" class="btn btn-danger" onclick="SupprimerSout('Supprimer','Vous voulez supprimer la soutnance de l\'id :','<?php echo $Row['id_soutenance'] ?>','supprimer','Annuler')">Supprimer</a>
                            <a class="btn btn-secondary Print" name="Print" onclick="ModalImprimer(<?php echo $Row['id_soutenance'] ?>)">Imprimer</a>
                        </td>
                        <?php } ?>
                    </tr>   
            </table>
            <!--           Pagination         -->
            <nav aria-label="Page navigation example justify-content-center">
                <ul id="pagination" class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" id="Previous" href="?page=<?= $previous ?>">Précédent</a>
                    </li>
                    <?php
                        for($i=1 ; $i <= $nbr_page ; $i++){ ?>
                            <li class="page-item"><a class="page-link"  id="<?= $i ?>p" href="?page=<?= $i ?>"><?= $i ?></a></li>
        
                        <?php } ?>
                    
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $next ?>">Suivant</a>
                    </li>
                </ul>
                <?php             
                    echo "<script>document.getElementById('".$page."p').style.background ='#0d6efd';
                    document.getElementById('".$page."p').style.color ='#fff'</script>"; 
                ?>
            </nav>
        </div>
    </div>


    <!-- Ajouter -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog"  style="max-width: 800px !important;">
            <div class="modal-content">
                <div class="modal-header" style="background:#D9FFFF;">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Ajouter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" class="row g-3 needs-validation" novalidate style="margin-top:0;margin-right: 0px;margin-left: 0px;">
                    <div class="modal-body">
                        <div class="col-auto">
                            <label>Date Sautnance:</label>
                            <input type="Date" class="form-control Date_sout" name="Date" id="Date" value="2022-01-18"/>
                            <label>Titre Travail:</label>
                            <input type="Text" class="form-control Titre_Travail" name="Titre_Travail" id="TitreTravail" required/>
                            <div class="invalid-feedback">le titre de travail est obligatoir</div>
                        </div>
                            <div style="Text-align:center;">   
                                <h3>Docteur</h3>
                                <div>
                                    <input type="text" class="form-control Apj" placeholder="Code Apojet CIN ou CNE" id="id"/>
                                    <input type="button" class="btn btn-primary valider" value="valider" name="val"  onclick="InfoDoc()"/>
                                </div>
                            </div>
                        <div id="Doc">
                        </div>    
                        <div  style="overflow-x:auto; margin-bottom:10px;">
                            <table id="aff" class="grid">
                            </table>
                        </div>
                        <button  type="button" class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" style="float:right">Jurys</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn AjtSout" name="Ajouter">Ajouter</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
        <!-- Modal 2 des jurys -->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog" style="max-width: 800px">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Jurys</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="Grid" class="grid">
                    <tr>
                        <th>cheak</th>
                        <th>CIN</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                    </tr>
                    <tbody id="TabJury">
                    <?php 
                    //Grid Jury
                    $i=0;
                    $Res=MySqli_Query($con,"Select CIN_J,Nom_J,Prenom_J from jury order By Nom_J,Prenom_J");
                    while($Row=MySqli_Fetch_Assoc($Res)){
                    ?>
                    <tr>
                        <td data-label="Cheak"><input type="checkBox" id="check<?php echo $i ?>"/></td>
                        <td data-label="CIN" data-label="Cheak" id="Cin_<?php echo $i ?>"><?php echo $Row["CIN_J"];?></td>
                        <td data-label="Nom" id="Nom_<?php echo $i ?>"><?php echo $Row["Nom_J"];?></td>
                        <td data-label="Prénom" id="Prenom_<?php echo $i ?>"><?php echo $Row["Prenom_J"];$i++;}?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" onclick="JurysChoisies('aff','check')">Confirmer</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Alert -->
<?php  require('../Alert/Alert.html') ?>
<?php require_once("../navbar and footer/footer.html");?>
<script src="../Bootstrap/JS/bootstrap.min.js"></script>
<script src="Js/ModalImprimer.js"></script>
<script src="Js/Modal_Delete.js"></script>
<script src="../Alert/Alert.js"></script>

</body>
</html>
    <!-- Modal Modifier -->
<div class="modal fade" id="ModalModfier" aria-hidden="true" aria-labelledby="Modifier" tabindex="-1">
    <div class="modal-dialog "  style="max-width: 800px !important;">
        <div class="modal-content" id="modal">
                
        </div>
    </div>
</div>

    <!-- Modal 2 des jurys -->

<div class="modal fade" id="JrModf" aria-hidden="true" aria-labelledby="Modifier" tabindex="-1">
    <div class="modal-dialog" style="max-width: 800px">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="Modifier2">Jurys</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
        </div>
        <div class="modal-body">
            <table id="Grid" class="grid">
                <tr>
                    <th>Cheak</th>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                </tr>
                <?php 
                //Grid Jury
                $i=0;
                $Res=MySqli_Query($con,"Select CIN_J,Nom_J,Prenom_J from jury order By Nom_J,Prenom_J");
                while($Row=MySqli_Fetch_Assoc($Res)){
                ?>
                <tr>
                    <td data-label="Cheak :"><input type="checkBox" id="ch<?php echo $i ?>"/></td>
                    <td data-label="Cin :" id="Cin_<?php echo $i ?>"><?php echo $Row["CIN_J"];?></td>
                    <td data-label="Nom :" id="Nom_<?php echo $i ?>"><?php echo $Row["Nom_J"];?></td>
                    <td data-label="Prénom :" id="Prenom_<?php echo $i ?>"><?php echo $Row["Prenom_J"];$i++;}?></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-bs-target="#ModalModfier" data-bs-toggle="modal" onclick="JurysChoisies('Jurys','ch')">Confirmer</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" style="background-color:rgba(0,0,0,0.5);" id="ModalIMPORTER" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:120%;">
        <div style="height:100%; z-index: ; border-raduis:5px;" class="modal-content">
            <div class="modal-header" style="background-color: #D9FFFF; color: ; height: 65px;">
                <h3 class="modal-title" id="staticBackdropLabel">Importer</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data" class="needs-validation" novalidate style="margin-top:0;">
                <div style="background-color: #DEDEDE" class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label"><b>Choisissez le fichier excel(.xlsx) :<span style="color:red;">Rq:séparer les jury par ,</span></b></label>
                        <input name="FileExcel" style="background-color: #FFB2DC;" class="form-control" type="file" id="formFile" required/>
                    </div>
                </div>
                <div style="background-color: #D9FFFF;padding-bottom: 6px; padding-right: 15px; padding-top: 10px; height: 65px;" class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button name="importEXCEL" type="submit" class="btn btn-primary">Importer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function show_Msg(Err)
    {
        document.getElementById("Details").outerText=": "+Err
    }
    //Les information de docteur
    function InfoDoc()
    {
        var xhttp = new XMLHttpRequest();
        //x=id de soutnance choiser
        var x=document.getElementById("id").value
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // le document est charger avec succes
            document.getElementById("Doc").innerHTML = xhttp.responseText;
            document.cookie="CodeD="+document.getElementById("CodeD").innerText;
            }
        };
        xhttp.open("GET", "PHP/INFODOCTEUR.php?id="+x, true);
        xhttp.send();
    }
    //Afficher Modal Modifier
    window.addEventListener("load",function(){
    
        function fetch_post_data(post_id)
        {

            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $('#ModalModfier').modal('show');
                        document.getElementById("modal").innerHTML = xhttp.response;
                    }
                };
                xhttp.open("Post", "PHP/ModalModifier.php?id="+post_id,true);
                xhttp.send();

        }

        $(document).on('click', '.Mod', function(){
        var post_id = $(this).attr("id");
        fetch_post_data( post_id);
        document.cookie="id="+post_id;
    });
    });
        /**
        afficher le tablue des jurys choises est remplier */
    function JurysChoisies(tbl,ch) {
        var a=[];
        var nbJ=0;
        document.getElementById(tbl).innerHTML=""
        document.getElementById(tbl).innerHTML+="<tr class='ModalJurys'>"+
                "<th>CIN</th>"+
                "<th>NOM</th>"+
                "<th>PRENOM</th>"+
                "<th>Grade</th>"+
                "<th>Statut</th>"+
                "<th>Etablissement</th>"+
                "</tr>";
        var nb=<?php echo $i?>;
        for (var i = 0; i <nb ; i++) {
            if(document.getElementById(ch+i).checked==true)
            {
                document.getElementById(tbl).innerHTML+="<tr>"+
                "<td id='CINJ"+i+"'>"+document.getElementById("Cin_"+i).innerText+"</td>"+
                "<td>"+document.getElementById("Nom_"+i).innerText+"</td>"+
                "<td>"+document.getElementById("Prenom_"+i).innerText+"</td>"+
                "<td>"+
                    "<select name='Statut"+nbJ+"' id='ST"+i+"'>"+
                        "<option value='Rapporteur'>Rapporteur</option>"+
                        "<option value='Examinateur'>Examinateur</option>"+
                        "<option value='Directeur de thése'>Directeur de thése</option>"+
                        "<option value='Co-Directeur de thése'>Co-Directeur de thése</option>"+
                        "<option value='Invité'>Invité</option>"+
                    "</select>"+
                "</td>"+
                "<td>"+
                    "<select name='Gr"+nbJ+"' id='Gr"+i+"'>"+
                        "<option value='PA'>PA</option>"+
                        "<option value='PH'>PH</option>"+
                        "<option value='PES'>PES</option>"+
                        "<option value='Docteur'>Docteur</option>"+
                    "</select>"+
                "</td>"+
                "<td><input type='Text' value='FPBM' name='ETB"+nbJ+"' id='ETB"+i+"'/></td>"+
                "</tr>"
                /**
                    * vider les checkbox
                    * Fermer model
                    */
                document.getElementById("check"+i).checked=false;
                a[nbJ]=i;
                nbJ++;
            }
        }
        if(nbJ==0)
        {
            document.getElementById(tbl).innerHTML=""
        }
        for (let i = 0; i < nbJ; i++) {
            document.cookie="CINJ"+i+"="+document.getElementById("Cin_"+a[i]).innerText;
        }
        document.cookie="nb="+nbJ;
    }
    function Vider()
    {
        document.getElementById('aff').innerHTML='';
        document.cookie="nb=0";
    }
    
    // valider ci les inputs est vide
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
        }

        form.classList.add('was-validated')
    }, false)
    })
    })()

    //search
    var code=document.getElementById("code");
    var container=document.getElementById("container").innerHTML
    function cherche(){
        var xhttp = new XMLHttpRequest();
        //x=id de soutnance choiser
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(code.value!="")
                {
                    document.getElementById("container").innerHTML ="";
                    document.getElementById("container").innerHTML = xhttp.responseText;
                }else
                {
                    document.getElementById("container").innerHTML = container;
                }
            }
        };
        xhttp.open("GET", "PHP/search.php?code="+code.value, true);
        xhttp.send();
    }

</script>

<?php
    // ********************** Ajouter ***************************
    if(IsSet($_POST["Ajouter"]))
    {    
        $q=MySqli_Query($con,"SELECT MAX(id_soutenance)+1 as 'New id' FROM soutenance");
        $id=MySqli_Fetch_Assoc($q);
        if($id["New id"]==0)
        {
            $id["New id"]=1;
        }
        $nb=$_COOKIE["nb"];
        if($nb!=0)
        {
            for ($i=0; $i <$nb ; $i++) {
                $q="insert into soutenance values('".$id["New id"]."','".$_COOKIE["CodeD"]."','".$_COOKIE["CINJ".$i]."','".$_POST["Titre_Travail"]."','".$_POST["Date"]."','".$_POST["Gr".$i]."','".$_POST["Statut".$i]."','".$_POST["ETB".$i]."')";
                $Res=MySqli_Query($con,$q);
            }
            echo "<script>show_alert(`La Soutnance est ajouter avec succes`,'rgba(21, 250, 143,.8)','rgba(4, 170, 109,.8)')
            console.log('".$_COOKIE["CodeD"]."')
            setTimeout(function(){
               window.location.href='http://localhost/Doctorat/Sout/Soutnance.php';
               }, 3000);
           </script>";
        }else if($nb==0)
        {
            echo "<script>show_alert(`doit étre choiser un jury au moin`,'rgba(220, 53, 69, .8)')</script>";
        }
        else if($_COOKIE["CodeD"]==0)
        {
            echo "<script>show_alert(`doit étre choiser un Docteur`,'rgba(220, 53, 69, .8)')</script>";
        }else
        {
            echo "<script>show_alert(`doit étre choiser un Docteur`,'rgba(220, 53, 69, .8)')</script>";
        }
    }

    // ********************** Modifier ***************************
    if(IsSet($_POST["Modifier"]))
    {    
        $nb=$_COOKIE["nb"];
        $id=$_COOKIE["id"];
        if($nb>0) {
            $GETID='SELECT DISTINCT CODE_Doc FROM soutenance WHERE id_soutenance='.$id;
            $Res=MySqli_Query($con,$GETID);
            $CodeDocteur=MySqli_Fetch_Assoc($Res);
            $qS="Delete from soutenance where id_soutenance=".$id;
            $Res=MySqli_Query($con,$qS);
            for ($i=0; $i <$nb ; $i++) {
                $q="insert into soutenance values(".$id.",'".$CodeDocteur["CODE_Doc"]."','".$_COOKIE["CINJ".$i]."','".$_POST["TitreTr"]."','".$_POST["DateST"]."','".$_POST["Gr".$i]."','".$_POST["Statut".$i]."','".$_POST["ETB".$i]."')";
                $R=MySqli_Query($con,$q);
            }
            echo "<script>show_alert(`La Soutnance est Modifier avec succes`,'rgba(21, 250, 143,.8)','rgba(4, 170, 109,.8)')
            console.log('".$_COOKIE["CodeD"]."')
            setTimeout(function(){
               window.location.href='Soutnance.php';
               }, 3000);
           </script>";
        }
        else
        {
            $q='UPDATE soutenance SET Titre_Travail="'.$_POST["TitreTr"].'", Date_Soutenance="'.$_POST["DateST"].'" WHERE id_soutenance='.$id;
            $Res=MySqli_Query($con,$q);
            echo "<script>show_alert(`La Soutnance est Modifier avec succes`,'rgba(21, 250, 143,.8)','rgba(4, 170, 109,.8)')
            console.log('".$_COOKIE["CodeD"]."')
            setTimeout(function(){
               window.location.href='Soutnance.php';
               }, 3000);
           </script>";
        }

        if(!empty($_COOKIE["CodeD"]) && !empty($_COOKIE["nb"]))
        {
            setcookie($_COOKIE["nb"], 0, time() + (86400 * 30), "/");
            setcookie($_COOKIE["CodeD"], 0, time() + (86400 * 30), "/");
        }
    }
    //********************** import excel file ******************* 
    if(isset($_POST['importEXCEL'])){
        $EXT=["xlsx"];
        $File = $_FILES['FileExcel']['name'];
        $File_EXT=pathinfo($File,PATHINFO_EXTENSION);
        if(!in_array($File_EXT,$EXT))
        {
            echo "<script>show_alert(`le fichier doit étre excel(xlsx)`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            exit(0);
        }
        $FileName = $_FILES['FileExcel']['tmp_name'];
        include('../excelpackage.php');
        $excelfile = simpleXLSX::parse($FileName);
        $count=0;
        foreach($excelfile->rows() as $key => $row){ // to brows all lines
            $value = "";
            if($count>0)
            {
                $q=MySqli_Query($con,"SELECT MAX(id_soutenance)+1 as 'New id' FROM soutenance");
                $id=MySqli_Fetch_Assoc($q);
                if($id["New id"]==0)
                {
                    $id["New id"]=1;
                }
                $value = "";
                $i=0;
                $Jury=explode(",",$row[1]);
                for($x = 0; $x < count($Jury); $x++) {
                    $value ='"'.$id["New id"].'","'.$row[0].'","'.$Jury[$x].'","'.$row[2].'","'.$row[3].'","'.$row[4].'","'.$row[5].'","'.$row[6].'"'; 
                    $sql = "INSERT INTO `soutenance` VALUES (".rtrim($value,",").");";
                    $query = mysqli_query($con, $sql);
                }
                  
            }
            $count=1;       
        }
        if(!$query){
            $err=str_replace("'","",Mysqli_error($con));
            echo "<script>show_alert(`Echec de l'importation de fichier <a href='#' id='Details' onclick=\"show_Msg('".$err."')\">Details(Eng)...</a>`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            exit(0);
        }
        else{
            echo "<script>
            show_alert(`Les donnes est importer avec succes`,'rgba(95,196,9,0.8)','#79E71C');
            setTimeout(function(){
            window.location.href='http://localhost/Doctorat/Sout/Soutnance.php';
            }, 3000);
            </script>";
        }
    }
?>