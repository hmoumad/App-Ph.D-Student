<?php  
    include('../connexion.php');

    @ $editer = $_POST['editer'];
    @ $delete = $_POST['delete'];

   // search button to find data
   if(isset($_POST['search'])){
       $value = $_POST['inputsearch'];

       $sql = "SELECT * FROM docteur WHERE CODE_Doc = '$value' ";
       if(!$sql){
           echo "error sql " . mysqli_error($con);
       }
       $query = mysqli_query($con, $sql);
       if(!$sql){
            echo "error query " . mysqli_error($con);
        }
        $nbr_page = 1;

   }else{
       //pagination
        $sql = "SELECT * FROM docteur ";
        $query = mysqli_query($con, $sql);
        if(!$query){
            echo "erreur de la requette " . mysqli_error($con) ;
        }
        $rowcount = mysqli_num_rows($query);
    
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
        $sql = "SELECT * FROM docteur LIMIT $debut, $nbr_elem_par_page" ;
        $query = mysqli_query($con, $sql) ;
        if(!$query){
            echo "erreur de la requette " . mysqli_error($con) ;
        }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docteur</title>
    <link rel="stylesheet" href="Docteur.css">
    <link rel="stylesheet" href="../Bootstrap/CSS/bootstrap.css">
    <link rel="stylesheet" href="../navbar and footer/footer.css"/>
    <link rel="stylesheet" href="../navbar and footer/navbar.css"/>
    <link rel="icon" href="../Logo/fplogo.png"/>
    <link rel="stylesheet" href="../Alert/Alert.css">
</head>
<body>
    <?php require_once("../navbar and footer/navbar.php")?>
    <form action="" method="post">
        <div id="SearchApoge" class="SearchApogee">
            <input name="inputsearch" id="imput"  type="text" placeholder="Search by Apogee">
            <button onclick="PaginationShow()" name="search" >Rechercher</button>
        </div>
    </form>
    <div class="CRUD">
        <!-- ************** Importer **************** -->
        <button onclick="ImportExcelFile();return false;" id="btn1" class="btn btn-primary" style="margin-right: 100px;">
            Importer Excel
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
            </svg>
        </button>
        <!--             Ajouter Doctorant           -->
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" style="margin-right: 100px;">
            Ajouter Doctorant 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
        </button>
        <!-- ************** Exporter **************** -->
        <a class="btn btn-success" target="_blanck" href="php/Exporter.php" style="margin-right: 100px;">
            Exporter Excel
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
            </svg>
        </a>
        <!-- ************** Vider **************** -->
        <a class="btn btn-danger vider" target="_blanck" onclick="ShowModal('Vider','tu veux supprimer tous les doctorants','','Supprimer', 'Annuler'); return false;" >
            Vider
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
               <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
            </svg>
        </a>
    </div>
    <!-- Modal To Add Doctors-->
    
    <div style=" background-color:rgba(0,0,0,0.5);" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog container">
            <div style="width:120%; height:100%; z-index: ; border-raduis:5px;" class="modal-content">
                <div style="background-color: #D9FFFF; color: ; height: 65px;" class="modal-header text-center">
                    <h2 class="modal-title" id="exampleModalLabel">Ajouter</h2>
                    <button style="color:red;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="#" class="needs-validation" novalidate>
                    <div style="background-color: #DEDEDE" class="modal-body">
                        <div style="margin-top:0px;" class="row">
                            <div class="col">
                                <label style="margin-left: 0px;" for="codee" class="form-label">Apogee :</label>
                                <input style="margin-bottom: 20px;" name="code" id="codee" type="text" class="form-control" placeholder="Apogee" aria-label="First name" required autofocus>

                            </div>
                            <div class="col">
                                <label style="margin-left: 0px;" for="cine" class="form-label">CIN :</label>
                                <input style="margin-bottom: 20px;" id="cine" name="CIN" type="text" class="form-control" placeholder="CIN" aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label style="margin-left: 0px;" for="cnee" class="form-label">CNE :</label>
                                <input style="margin-bottom: 20px;" id="cnee" name="CNE" type="text" class="form-control" placeholder="CNE" aria-label="First name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="margin-left: 0px;" for="nomae" class="form-label">Nom Arab :</label>
                                <input style="margin-bottom: 20px;" id="nomae" name="noma" type="text" class="form-control" placeholder="Nom Arab" aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label style="margin-left: 0px;" for="prenomae" class="form-label">Prénom Arab :</label>
                                <input style="margin-bottom: 20px;" id="prenomae" name="prenoma" type="text" class="form-control" placeholder="Prénom Arab" aria-label="Last name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="margin-left: 0px;" for="nf" class="form-label">Nom Français :</label>
                                <input style="margin-bottom: 20px;" name="nomf" type="text" class="form-control" id="nf" placeholder="Nom Francais">
                            </div>
                            <div class="col">
                                <label style="margin-left: 0px;" for="pf" class="form-label">Prénom Français :</label>
                                <input style="margin-bottom: 20px;" name="prenomf" type="text" class="form-control" id="pf"  placeholder="Prénom Francais">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="margin-left: 0px;" for="datenaissance" class="form-label">Date Naissance :</label>
                                <input style="margin-bottom: 20px;" name="datenaiss" type="date" class="form-control" id="datenaissance">
                            </div>
                            <div class="col">
                                <label style="margin-left: 0px;" for="lieufr" class="form-label">lieux Français :</label>
                                <input style="margin-bottom: 20px;"name="liueF" type="text" class="form-control" id="lieufr"  placeholder="lieux Francais ">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="margin-left: 0px;" for="liueA" class="form-label">Lieux Arab :</label>
                                <input style="margin-bottom: 20px;" name="liueA" type="text" class="form-control" id="liueA" placeholder="Lieux Arab">
                            </div>
                            <div class="col">
                                <label style="margin-left: 0px;" for="formationf" class="form-label">Formation :</label>
                                <input style="margin-bottom: 20px;" name="formation" type="text" class="form-control" id="formationf"  placeholder="Formation">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="margin-left: 0px;" for="etablissement" class="form-label">Etablissement :</label>
                                <input style="margin-bottom: 0px;" name="etabliss" type="text" class="form-control" id="etablissement" placeholder="Etablissement">
                            </div>
                            <div class="col">
                                <label style="margin-left: 0px;" for="specialitee" class="form-label">Specialite :</label>
                                <input style="margin-bottom: 20px;" name="specialite" type="text" class="form-control" id="specialitee"  placeholder="Specialite">
                            </div>
                        </div>
                        
                    </div>

                    <div style="background-color: #D9FFFF;padding-bottom: 6px; padding-right: 15px; padding-top: 10px; height: 65px;" class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                        <!-- <button name="insert" type="submit" class="btn btn-success">Add</button> -->
                        <button name="insert" type="submit" class="btn btn-success"><a id="Ajt">Ajouter</a></button>
                    </div>
            </form>
        </div>
        </div>
    </div>
        <div class="container">
            <table id="Grid" class="grid">
                <tr>
                    <th>Apogee</th>
                    <th>CNE</th>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th class="column">Date Naissance</th>
                    <th class="column">Formation</th>
                    <th class="column">Etablissement</th>
                    <th>Actions</th>
                </tr>
                <?php while( $result = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td data-label="Apogee :"><?php echo $result['CODE_Doc'] ?></td>
                        <td data-label="CNE :"><?php echo $result['CNE_Doc'] ?></td>
                        <td data-label="CIN :"><?php echo $result['CIN_Doc'] ?></td>
                        <td data-label="Nom :"><?php echo $result['Nom_fr'] ?></td>
                        <td data-label="Prénom :"><?php echo $result['Prenom_fr'] ?></td>
                        <td class="column"><?php echo $result['Date_Naissance'] ?></td>
                        <td class="column"><?php echo $result['Formation'] ?></td>
                        <td class="column"><?php echo $result['Centre_Etude'] ?></td>
                        <td data-label="Actions">
                            <a onclick="ModalAddDoctor('<?php echo $result['CODE_Doc'] ; ?>',
                                '<?php echo $result['CNE_Doc'] ?>',
                                '<?php echo $result['CIN_Doc'] ?>',
                                '<?php echo $result['Nom_arab'] ?>',
                                '<?php echo $result['Prenom_arab'] ?>',
                                '<?php echo $result['Nom_fr'] ?>',
                                '<?php echo $result['Prenom_fr'] ?>',
                                '<?php echo $result['Date_Naissance'] ?>',
                                '<?php echo $result['Lieu_Naiss_arab'] ?>',
                                '<?php echo $result['Lieu_Naiss_fr'] ?>',
                                '<?php echo $result['Formation'] ?>',
                                '<?php echo $result['Centre_Etude'] ?>',
                                '<?php echo $result['Specialite'] ?>',
                                ); return false;" href="?id=<?php echo $result["CODE_Doc"] ; ?>" id="edite"  name="editer" class="btn btn-success">
                                Modifier
                            </a>
                            <a href="?codedoc=<?php echo $result["CODE_Doc"] ; ?>" onclick="ShowModal('Supprimer','Vous voulez supprimer le doctor de Apogee =', '<?php echo $result['CODE_Doc'] ; ?> ','Supprimer', 'Annuler'); return false;" id="delet"  name="delete" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <nav aria-label="Page navigation example justify-content-center">
            <ul id="pagination" class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="docteur.php?page=<?= $previous ?>">Précédent</a>
                </li>
                <?php
                    for($i=1 ; $i <= $nbr_page ; $i++){ ?>
                        <li class="page-item"><a class="page-link" id="<?= $i ?>" href="docteur.php?page=<?= $i ?>"><?= $i ?></a></li>

                    <?php } ?>
                
                <li class="page-item">
                    <a class="page-link" href="docteur.php?page=<?= $next ?>">Suivant</a>
                </li>
            </ul>
            <?php       
                if(!empty($page)){
                    echo "<script>document.getElementById('".$page."').style.background ='#0d6efd';
                    document.getElementById('".$page."').style.color ='#fff'</script>";
                } ?>
        </nav>

    <!-- Alert -->
    <?php  require('../Alert/Alert.html') ?>
    <?php require_once("../navbar and footer/footer.html");?>
    <script src="../Bootstrap/JS/bootstrap.min.js"></script>
    <script src="JS/Modal_Delete.js"></script>
    <script src="JS/Modal_Update.js"></script>
    <script src="JS/Modal_Import.js"></script>
    <script src="../Alert/Alert.js"></script>

    <script>
        function show_Msg(Err)
        {
            document.getElementById("Details").outerText=": "+Err
        }
        function AddDoctor() {
            modalpere = document.getElementById("modalpere");

            if(modalpere.style.visibility === "hidden"){
                modalpere.style.visibility = "visible" ;
            }
        }
        function PaginationShow() {
            pagination = document.getElementById("pagination");
            if(pagination.style.display === "block"){
                pagination.style.display === "none" ;
            }
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
    </script>
</body>
</html>

<?php 
    //Ajouter 
    if(isset($_POST['insert'])){
        $code = $_POST['code']; 
        $CIN = $_POST['CIN'];
        $CNE = $_POST['CNE'];
        $noma = $_POST['noma'];
        $prenoma = $_POST['prenoma'];
        $nomfr = $_POST['nomf'];
        $prenomf = $_POST['prenomf'];
        $datanaiss = $_POST['datenaiss'];
        $lieuna = $_POST['liueA'];
        $lieunf = $_POST['liueF'];
        $etablissement = $_POST['etabliss'];
        $formation = $_POST['formation'];
        $specialite = $_POST['specialite'];

        if($code=="0")
        {
            echo "<script>show_alert(`L'apojeet doit étre different <i>".$code."</i>`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            return;
        }
        if(!preg_match('/^[0-9]+$/', $code))
        {
            echo "<script>show_alert(`L'apojeet doit étre entier <i>".is_int($code)."</i>`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            exit(0);
        }

        $q='SELECT Count(*) FROM docteur WHERE CODE_Doc="'.$code.'"';
        $Sql=mysqli_query($con,$q);
        $Exsist_CODE_Doc=MySqli_Fetch_Assoc($Sql);

        $q='SELECT Count(*) FROM docteur WHERE CIN_Doc="'.$CIN.'"';
        $Sql=mysqli_query($con,$q);
        $Exsist_CIN_Doc=MySqli_Fetch_Assoc($Sql);

        $q='SELECT Count(*) FROM docteur WHERE CNE_Doc="'.$CNE.'"';
        $Sql=mysqli_query($con,$q);
        $Exsist_CNE_Doc=MySqli_Fetch_Assoc($Sql);

        if($Exsist_CODE_Doc["Count(*)"]==0 && $Exsist_CIN_Doc["Count(*)"]==0 && $Exsist_CNE_Doc["Count(*)"]==0)
        {   
            $sql = 'INSERT INTO `docteur`(`CODE_Doc`, `CIN_Doc`, `CNE_Doc`, `Nom_fr`, `Nom_arab`, `Prenom_fr`, `Prenom_arab`, `Date_Naissance`, `Lieu_Naiss_fr`, `Lieu_Naiss_arab`, `Centre_Etude`, `Formation`, `Specialite`)
                VALUES ("'.$code.'","'.$CIN.'","'.$CNE.'","'.$nomfr.'","'.$noma.'","'.$prenomf.'","'.$prenoma.'","'.$datanaiss.'","'.$lieunf.'","'.$lieuna.'","'.$etablissement.'","'.$formation.'","'.$specialite.'")';
        
            $query = mysqli_query($con, $sql);
            if(!$query){
                echo "error Query " . mysqli_error($con);
            }
            else{
                echo "<script>
                show_alert(`Le docteur est ajouter avec succes`,'rgba(95,196,9,0.8)','#79E71C');
                setTimeout(function(){
                window.location.href='http://localhost/Doctorat/Docteur/Docteur.php';
                }, 5000);
                </script>";
            }
        }else
        {
            if($Exsist_CODE_Doc["Count(*)"]!=0)
            {
                echo "<script>show_alert(`L'apojeet: <i>".$code."</i> est déjà exists`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            }else if($Exsist_CIN_Doc["Count(*)"]!=0)
            {
                echo "<script>show_alert(`Le CIN: <i>".$CIN."</i> est déjà exists`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";

            }else
            {
                echo "<script>show_alert(`Le CNE: <i style='font-weight: bold !important;'>".$CNE."</i> est déjà exists`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            }

        }
    }

    //Modifier
    if(isset($_POST['update'])){
        $code = $_POST['code']; 
        $CIN = $_POST['CIN'];
        $CNE = $_POST['CNE'];
        $noma = $_POST['noma'];
        $prenoma = $_POST['prenoma'];
        $nomfr = $_POST['nomf'];
        $prenomf = $_POST['prenomf'];
        $datanaiss = $_POST['datenaiss'];
        $lieuna = $_POST['liueA'];
        $lieunf = $_POST['liueF'];
        $etablissement = $_POST['etabliss'];
        $formation = $_POST['formation'];
        $specialite = $_POST['specialite'];

        $q='SELECT Count(*) FROM docteur WHERE CIN_Doc="'.$CIN.'" and CODE_Doc !="'.$code.'"';
        $Sql=mysqli_query($con,$q);
        $Exsist_CIN_Doc=MySqli_Fetch_Assoc($Sql);

        $q='SELECT Count(*) FROM docteur WHERE CNE_Doc="'.$CNE.'" and CODE_Doc !="'.$code.'"';
        $Sql=mysqli_query($con,$q);
        $Exsist_CNE_Doc=MySqli_Fetch_Assoc($Sql);

        if($Exsist_CIN_Doc["Count(*)"]==0 && $Exsist_CNE_Doc["Count(*)"]==0)
        {   
            $sql = 'UPDATE docteur SET CIN_Doc = "'.$CIN.'", CNE_Doc = "'.$CNE.'", Nom_fr = "'.$nomfr.'", Nom_arab = "'.$noma.'",
            Prenom_fr = "'.$prenomf.'", Prenom_arab = "'.$prenoma.'", Date_Naissance = "'.$datanaiss.'", Lieu_Naiss_fr = "'.$lieunf.'",
            Lieu_Naiss_arab="'.$lieuna.'", Centre_Etude = "'.$etablissement.'", Formation = "'.$formation.'", Specialite = "'.$specialite.'"
            WHERE  CODE_Doc = "'.$code.'"';
            
            $query = mysqli_query($con, $sql);
            if(!$query){
                echo "error Query " . mysqli_error($con);
            }
            else{
                echo "<script>
                show_alert(`Le docteur est MODIFIER avec succes`,'rgba(95,196,9,0.8)','#79E71C');
                setTimeout(function(){
                window.location.href='http://localhost/Doctorat/Docteur/docteur.php';
                }, 5000);
                </script>";
            }
        }else
        {
            if($Exsist_CIN_Doc["Count(*)"]!=0)
            {
                echo "<script>show_alert(`Le CIN: <i>".$CIN."</i> est déjà exists`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";

            }else
            {
                echo "<script>show_alert(`Le CNE: <i style='font-weight: bold !important;'>".$CNE."</i> est déjà exists`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            }

        }
    }
     //importer excel  
     if(isset($_POST['import'])){
        $EXT=["xlsx"];
        $File = $_FILES['excel']['name'];
        $File_EXT=pathinfo($File,PATHINFO_EXTENSION);
        if(!in_array($File_EXT,$EXT))
        {
            echo "<script>show_alert(`le fichier doit étre excel(xlsx)`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            exit(0);
        }
        $FileName = $_FILES['excel']['tmp_name'];
        include('../excelpackage.php');
        $excelfile = simpleXLSX::parse($FileName);
        $count=0;
        foreach($excelfile->rows() as $key => $row){ // to brows all lines
            if($count>0)
            {
                $value = "";
                foreach($row as $key => $cell){
                    $value .= "'". $cell. "'," ;
                }
                $sql = "INSERT INTO `docteur` VALUES (".rtrim($value,",").");";
                $query = mysqli_query($con, $sql);  
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
            window.location.href='http://localhost/Doctorat/Docteur/docteur.php';
            }, 3000);
            </script>";
        }
    }
?>