<?php
    require_once('../connexion.php');

    @ $username = $_POST['username'];
    @ $password = $_POST['password'];
    @ $envoi = $_POST['envoi'];
    $error = "";
    if(isset($username) && isset($password)){

        $a = $_POST['username'];
        $b = md5($_POST['password']);
        session_start();

        if(empty($username)){
            $error = "UserName is required... ";
            header("location:login.php?erreur=$error");
        } else if(empty($password)){
            $error = "PassWord is required... ";
            header("location:login.php?erreur=$error");
        } else{
            $sql = "SELECT * FROM `login` WHERE UPPER(login) = '".strtoupper($a)."' AND password='".$b."';" ;
            if(!$sql){
                echo "error execute sql " . mysqli_error($con) ;
            }
            $query = mysqli_query($con, $sql);
            if(!$query){
                echo "error execute Query " . mysqli_error($con) ;
            }
            $rowcount = mysqli_num_rows($query);
            if($rowcount === 1){
                header("location:../Home/Home.php");
                $username=MySqli_Fetch_Assoc($query);
                $_SESSION["username"]=$username["login"];
            }else{
                $error = "UserName Or PassWord incorrect... ";
                header("location:login.php?erreur=$error");
            }
        }
    }
?>