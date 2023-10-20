<?php
    include('../connexion.php');
    $reussit = "";
    $error = "";
    $errorexcel = "";

    if(isset($_POST['searchjury'])){
        @ $valuesearch = $_POST['inputsearchjury'];

       $sql = "SELECT * FROM `soutenance` right JOIN jury on jury.CIN_J = soutenance.CIN_J WHERE jury.CIN_J = '$valuesearch' ";
       if(!$sql){
           echo "error sql " . mysqli_error($con);
       }
       $query = mysqli_query($con, $sql);
       if(!$sql){
            echo "error query " . mysqli_error($con);
        }

    }else{
    /****************** Pagination ************** */
        $sql = "SELECT * FROM jury" ;
        $query = mysqli_query($con, $sql);
        if(!$query){
            echo "error execute query " . mysqli_error($con);
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
        $sql = "SELECT * FROM jury LIMIT $debut, $nbr_elem_par_page" ;
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
    <title>Jury</title>
    <link rel="stylesheet" href="../navbar and footer/navbar.css">
    <link rel="stylesheet" href="../navbar and footer/footer.css">
    <link rel="stylesheet" href="../Bootstrap/CSS/bootstrap.css">
    <link rel="icon" href="../Logo/fplogo.png">
    <link rel="stylesheet" href="jury.css">
    <link rel="stylesheet" href="../Alert/Alert.css">
</head>
<body>
    <?php require('../navbar and footer/navbar.php') ?>
    <div style="margin-top:20px" class="container">
        <div class="card shadow my-auto">
            <div style="height: 45px;" class="card-header shadow bg-secondary text-white text-center">
                <h4>Ajouter Jury</h4>
            </div>
            <form action="#" method="post" class="needs-validation" novalidate>
                <div style="padding: 10px;" class="row">
                    <div class="col">
                        <label for="cine" class="form-label">CIN :</label>
                        <input id="cine" name="CIN" type="text" class="form-control" placeholder="CIN" aria-label="First name" required />
                        <div class="invalid-feedback">
                            le CIN est obligatoir
                        </div>
                    </div>
                    <div class="col">
                        <label for="nomfrancaise" class="form-label">Nom Français :</label>
                        <input name="nomfrancais" id="nomfrancaise" type="text" class="form-control" placeholder="Ex: Moumad" aria-label="First name" required />
                        <div class="invalid-feedback">
                            le prénom est obligatoir
                        </div>
                    </div>
                    
                    <div class="col">
                        <label for="premonfrancais" class="form-label">Prénom Français :</label>
                        <input id="premonfrancais" name="prenomfr" type="text" class="form-control" placeholder="Ex: Hamza" aria-label="First name" required>
                        <div class="invalid-feedback">
                            le Nom est obligatoir
                        </div>
                    </div>
                </div>
                <div style="padding: 10px;" class="row">
                    <div class="col">
                        <label for="nomarabi" class="form-label">Nom Arab :</label>
                        <input id="nomarabi" name="nomarab" type="text" class="form-control" placeholder="Ex: موماد" aria-label="First name">
                    </div>
                    <div class="col">
                        <label for="prenomarabic" class="form-label">Prénom Arab :</label>
                        <input name="prenomarab" id="prenomarabic" type="text" class="form-control" placeholder="Ex: حمزة" aria-label="First name">
                    </div>
                    <div class="col">
                        <button name="ajouterjury" style="margin-top: 25px;margin-right: 15px; float: right;" type="submit" class="AjoutJury">Ajouter</button>
                    </div>
                    <?php if($reussit != "") { ?>
                        <div id="reussite" class="alert alert-success" role="alert">
                            <?php echo $reussit ; ?>
                        </div>
                    <?php } ?>
                    <?php if($error != "") { ?>
                        <div id="errore" class="alert alert-danger" role="alert">
                            <?php echo $error ; ?>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div style="width:120%; height:100%; z-index: ; border-raduis:5px;" class="modal-content">
                <div class="modal-header" style="background-color: #D9FFFF; color: ; height: 65px;">
                    <h3 class="modal-title" id="staticBackdropLabel">Importer</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label"><b>choisissez le fichier excel(.xlsx) :</b></label>
                            <input name="ExcelJr" style="background-color: #FFB2DC;" class="form-control" type="file" id="formFile" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button name="importjury" type="submit" class="btn btn-primary">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <form action="" method="post" class="search">
        <div id="SearchApoge" class="SearchApogee">
            <input name="inputsearchjury" id="imput"  type="text" placeholder="Search by Apogee">
            <button name="searchjury">Search</button>
        </div>
    </form>
    <div class="CRUD">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-right: 100px;">
            Import Excel File  
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
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
        <a class="btn btn-danger vider" href="php/delete_jury.php" onclick="ModalDelete('Vous voulez vider la table jury',''); return false;" >
            Vider
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
               <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
            </svg>
        </a>
        <?php if($errorexcel != "") { ?>
            <div id="erreurexcel" class="alert alert-danger" role="alert">
                <?php echo $errorexcel ; ?>
            </div>
        <?php } ?>
    </div>
    </div>
    </div>
    <table id="Grid" class="grid">
            <tr>
                <th>CIN</th>
                <!-- <th>Soutenace</th> -->
                <th>Nom Français</th>
                <th class="ColAdd">Nom Arab</th>
                <th>Prénom Français</th>
                <th class="ColAdd">Prénom Arab</th>
                <!-- <th>Grade</th>
                <th>Statut</th>
                <th>Eteblissement</th> -->
                <th>Actions</th>
            </tr>
            <?php while( $result = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $result['CIN_J'] ?></td>
                    <td><?php echo $result['Nom_J'] ?></td>
                    <td class="ColAdd"><?php echo $result['Nom_J_arab'] ?></td>
                    <td><?php echo $result['Prenom_J'] ?></td>
                    <td class="ColAdd"><?php echo $result['Prenom_J_arab'] ?></td>
                    <td>
                        <a href="" onclick="AddJury(
                            '<?php echo $result['CIN_J'] ?>', '<?php echo $result['Nom_J'] ?>',
                            '<?php echo $result['Prenom_J'] ?>','<?php echo $result['Nom_J_arab'] ?>',
                            '<?php echo $result['Prenom_J_arab'] ?>'
                        ); return false ;" id="edite"  name="editer" class="btn btn-success">
                            Modifier
                        </a>
                        <a href="" onclick="ModalDelete('tu veux supprimer le jury de CIN:','<?php echo $result['CIN_J'] ?>'); return false;"  id="delete"  name="delete" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
          <!-- Pagination -->
        <nav aria-label="Page navigation example justify-content-center">
            <ul id="pagination" class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="jury.php?page=<?= $previous ?>">Précédent</a>
                </li>
                <?php
                    if(empty($nbr_page))
                    {
                        $nbr_page=1;
                    }
                    for($i=1 ; $i <= $nbr_page ; $i++){ ?>
                        <li class="page-item"><a class="page-link" id="<?= $i ?>" href="jury.php?page=<?= $i ?>"><?= $i ?></a></li>

                    <?php } ?>
                
                <li class="page-item">
                    <a class="page-link" href="jury.php?page=<?= $next ?>">Suivant</a>
                </li>
            </ul>
            <?php       
                if(!empty($page)){echo "<script>document.getElementById('".$page."').style.background ='#0d6efd';
                    document.getElementById('".$page."').style.color ='#fff'</script>";
                } 
            ?>
        </nav>
        <!-- Alert -->
    <?php  require('../Alert/Alert.html') ?>

    <?php  require('../navbar and footer/footer.html') ?>
    <script src="JS/delete_jury.js"></script>
    <script src="../Bootstrap/JS/bootstrap.bundle.min.js"></script>
    <script src="../Bootstrap/JS/bootstrap.min.js"></script>
    <script src="../Bootstrap/JS/bootstrap.js"></script>
    <script type="text/javascript" src="JS/edite_jury.js"></script>
    <!-- <script src="import_jury.js"></script> -->
    <script src="../Alert/Alert.js"></script>
    <script>
        function show_Msg(Err)
        {
            document.getElementById("Details").outerText=": "+Err
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
    </script>
</body>
</html>
<?php
    if(isset($_POST['ajouterjury'])){
        $CIN = $_POST['CIN'];
        $nomfrancais = $_POST['nomfrancais'];
        $prenomfr = $_POST['prenomfr']; 
        $nomarab = $_POST['nomarab'];
        $prenomarab = $_POST['prenomarab'];

        $q="SELECT Count(*) FROM jury WHERE CIN_J='".$CIN."'";
        $Sql=mysqli_query($con,$q);
        $Exsist=MySqli_Fetch_Assoc($Sql);
        if($Exsist["Count(*)"]==0)
        {
            $sql1 = 'INSERT INTO `jury`(`CIN_J`, `Nom_J`, `Nom_J_arab`, `Prenom_J`, `Prenom_J_arab`)
                    VALUES ("'.$CIN.'","'.$nomfrancais.' ","'.$nomarab.'","'.$prenomfr.'","'.$prenomarab.'")' ;
        
            $query1 = mysqli_query($con, $sql1);
            if(!$query1){
                $error = "Error : " . mysqli_error($con);
            }else{
                $reussit = "Data was uploaded successfully" ;
                echo "<script>show_alert(`le jury est ajouter avec succes`,'rgba(21, 250, 143,.8)','rgba(4, 170, 109,.8)')
                 setTimeout(function(){
                    window.location.href='http://localhost/Doctorat/Jury/jury.php';
                    }, 3000);
                </script>";
            }
        }else
        {
           echo "<script>show_alert(`le jury de CIN <strong><i>".$CIN."</i></strong> ç'est déjà exists`,'rgba(220, 53, 69, .8)')</script>";
        }
    }

    //import excel file 
    if(isset($_POST['importjury'])){
        $EXT=["xlsx"];
        $File = $_FILES['ExcelJr']['name'];
        $File_EXT=pathinfo($File,PATHINFO_EXTENSION);
        if(!in_array($File_EXT,$EXT))
        {
            echo "<script>show_alert(`le fichier doit étre excel(xlsx)`,'rgba(240,45,45,0.8)','rgb(220,3,3)')</script>";
            exit(0);
        }
        $FileName = $_FILES['ExcelJr']['tmp_name'];
        include('../excelpackage.php');
        $excelfile = SimpleXLSX::parse($_FILES['ExcelJr']['tmp_name']);
        $count=0;
        foreach($excelfile->rows() as $key => $row){ 
            if($count>0)
            {
                $value = "";
                foreach($row as $key => $cell){
                    $value .= "'". $cell. "'," ;
                }
                $sql = "INSERT INTO `jury` VALUES (".rtrim($value,",").");";
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
            window.location.href='http://localhost/Doctorat/Jury/jury.php';
            }, 7000);
            </script>";
        } 
    }
?>