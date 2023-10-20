<?php    require_once('../connexion.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Bootstrap/CSS/bootstrap.css"/>
    <link rel="stylesheet" href="../navbar and footer/footer.css"/>
    <link rel="stylesheet" href="../navbar and footer/navbar.css"/>
    <link rel="icon" href="../Logo/fplogo.png"/>
    <link rel="stylesheet" href="../Alert/Alert.css">   
    <style>
        body{
            background-color : lightblue;
            
        }
        form{
            /* background-color : rgb(122, 240, 228); */
            background-color : #eee;
        }
        .rounded {
            border-radius: 1.00rem !important;
        }
        button{
            float: right;
            padding: 10px 15px ;
            margin-top: 15px;
            
        }
        #show-eye,#show-eye2{
            display: none;
        }
        span
        {
            cursor:pointer;
        }
        @media screen and (max-width:350px) {
            body
            {
                width: 350px;
            }
            form
            {
                width: 350px !important;
            }
        }
        @media screen and (max-width:650px) {
            h2
            {
                font-size:30pt !important;
            }
            form
            {
                margin:auto 10px;
            }
        }
    </style>
</head>
<body>
    <?php require_once("../navbar and footer/navbar.php")?>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 87.4vh;">
        <form class="needs-validation p-3 rounded shadow" novalidate style="width:30rem; margin:10px auto;" action="#" method="post">
            <h2 class="text-center pb-5 display-4"> Ajouter Admin </h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><b>Prénom Admin :</b></label>
                <input type="text" name="FirstName" id="FirstName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nom d'admin" required/>
                <div class="invalid-feedback">
                    Le prénom d'admin est obligatoir
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Nom Admin :</b></label>
                <input type="text" name="LastName" id="LastName" class="form-control" placeholder="Prénom d'admin" required/>
                <div class="invalid-feedback">
                    Le nom d'admin est obligatoir
                </div>
            </div>
            <div class="mb-3">
                <div class="col-auto">
                    <label for="autoSizingInputGroup"><b>Mot de passe</b></label>
                    <div class="input-group">
                        <input name="Password" type="password" class="form-control" id="Password" placeholder="Mot de passe" required/>
                        <div class="input-group-text">
                            <span onclick="Show('Password','show-eye','hide-eye')">
                                <i id="show-eye" class="fa fa-eye" aria-hidden="true"></i>
                                <i id="hide-eye" class="fa fa-eye-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback">
                            Le mot de passe est obligatoir
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-auto">
                    <label><b>Confirmer le mot de passe</b></label>
                    <div class="input-group">
                        <input name="ConfPassword" type="password" id="ConfPassword" class="form-control" placeholder="Confirmer le mot de passe" required/>
                        <div class="input-group-text">
                            <span onclick="Show('ConfPassword','show-eye2','hide-eye2')">
                                <i id="show-eye2" class="fa fa-eye" aria-hidden="true"></i>
                                <i id="hide-eye2" class="fa fa-eye-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback">
                            La confirmation de mot de passe est obligatoir
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="SignUp" class="btn btn-success" style="padding:5px 20px;">S’inscrire</button>
        </form>
    </div>
    <?php  require('../Alert/Alert.html') ?>
    <?php require_once("../navbar and footer/footer.html");?>
    <script src="../Bootstrap/JS/bootstrap.min.js"></script>
    <script src="../Alert/Alert.js"></script>
    <script>
        
        function Show(btn,show,hide){
            put = document.getElementById(btn);
            show = document.getElementById(show);
            hide = document.getElementById(hide);

            if(put.type === "password"){
                put.type = "text";
                show.style.display = "block";
                hide.style.display = "none";
            } else{
                put.type = "password";
                show.style.display = "none";
                hide.style.display = "block";
            }
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
    <?php
        if(isset($_POST['SignUp'])){
            $FirstName = $_POST['FirstName']; 
            $LastName = $_POST['LastName'];
            $Password = $_POST['Password'];
            $ConfPass = $_POST['ConfPassword'];

            if(strlen($FirstName." ".$LastName)<8 || strlen($FirstName." ".$LastName)>100)
            {
                echo "<script>
                        show_alert(`Le nombre des caractères de Nom et prénom doit étre entre 8 et 100`,'rgba(240,45,45,0.8)','rgb(220,3,3)');
                        document.getElementById('FirstName').value='".$FirstName."';
                        document.getElementById('LastName').value='".$LastName."';
                        document.getElementById('Password').value='".$ConfPass."';
                        document.getElementById('ConfPassword').value='".$ConfPass."';
                    </script>";
                return;
            }
            if($Password!=$ConfPass)
            {
                echo "<script>
                        show_alert(`La confirmation de mot passe incorrect`,'rgba(240,45,45,0.8)','rgb(220,3,3)');
                        document.getElementById('FirstName').value='".$FirstName."';
                        document.getElementById('LastName').value='".$LastName."';
                        document.getElementById('Password').value='".$ConfPass."';
                        document.getElementById('ConfPassword').value='".$ConfPass."';
                    </script>";
                return;
            }
            if(strlen($Password)<8 || strlen($Password)>50)
            {
                echo "<script>
                        show_alert(`Le nombre des caractères de mot de passe doit étre entre 8 et 100`,'rgba(240,45,45,0.8)','rgb(220,3,3)');
                        document.getElementById('FirstName').value='".$FirstName."';
                        document.getElementById('LastName').value='".$LastName."';
                        document.getElementById('Password').value='".$ConfPass."';
                        document.getElementById('ConfPassword').value='".$ConfPass."';
                    </script>";
                return;
            }

            $login=ucfirst($FirstName).' '.strtoupper($LastName);
            $Password=md5($Password);
            $q='SELECT Count(*) FROM login WHERE Upper(login) ="'.strtoupper($login).'" AND password="'.$Password.'"';
            $Sql=mysqli_query($con,$q);
            $Exsist=MySqli_Fetch_Assoc($Sql);

            if($Exsist["Count(*)"]==0 )
            {   
                $sql="INSERT INTO login VALUES('".$login."','".$Password."')";
                $query = mysqli_query($con, $sql);
                if(!$query){
                    echo "error Query " . mysqli_error($con);
                }
                else{
                    echo "<script>
                    show_alert(`L'admin'est ajouter avec succes`,'rgba(95,196,9,0.8)','#79E71C');
                    </script>";
                }
            }
            else
            {
                echo "<script>
                    show_alert(`Cette compte est déja exsist`,'rgba(240,45,45,0.8)','rgb(220,3,3)');
                    document.getElementById('FirstName').value='".$FirstName."';
                    document.getElementById('LastName').value='".$LastName."';
                    document.getElementById('Password').value='".$ConfPass."';
                    document.getElementById('ConfPassword').value='".$ConfPass."';
                </script>";
                return;
            }
        }
    ?>
</body>
</html>