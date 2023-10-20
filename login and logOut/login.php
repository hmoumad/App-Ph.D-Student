<?php
    require_once('../connexion.php');
    @ $error = $_GET['erreur'];
    session_start();
    if(isset($_SESSION["username"]))
    {
        header("location:../Home/Home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Bootstrap/CSS/bootstrap.css">
    <link rel="icon" href="../Logo/fplogo.png"/>    
    <style>
        body{
            background-color : lightblue;
            
        }
        form{
            background-color : #eee;
        }
        .rounded {
            border-radius: 1.00rem !important;
        }
        button{
            float: right;
            padding: 10px 15px ;
            margin-top: 20px;
            
        }
        #show-eye{
            display: none;
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
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form class="p-5 rounded shadow" style="width:40rem;" action="Login_Traitement.php" method="post">
            <h2 class="text-center pb-5 display-4"> Connexion </h2>
            <?php if($error !="") { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ; ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><b>Nom d'utilisateur :</b></label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nom d'utilisateur">
            </div>
            <div class="mb-3">
                <div class="col-auto">
                <label for="autoSizingInputGroup"><b>Mot de passe</b></label>
                <div class="input-group">
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
                    <div class="input-group-text">
                    <span onclick="Show()">
                        <i id="show-eye" class="fa fa-eye" aria-hidden="true"></i>
                        <i id="hide-eye" class="fa fa-eye-slash" aria-hidden="true"></i>
                     </span>
                    </div>
                    </div>
                </div>
            </div>
            

            <button type="submit" name="envoi" class="btn btn-success" style="padding:5px 15px;">Se Connecter</button>
        </form>
    </div>

    <script>
        
        function Show(){
            put = document.getElementById("exampleInputPassword1");
            show = document.getElementById("show-eye");
            hide = document.getElementById("hide-eye");

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
    </script>
        <script src="../Bootstrap/JS/bootstrap.min.js"></script>
</body>
</html>