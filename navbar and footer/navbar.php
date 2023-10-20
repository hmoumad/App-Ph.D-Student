<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header("location:../login and logOut/login.php");
}
?>
<nav class="navbar">
    <div id="tittle" class="logo">
        <h3><?php echo $_SESSION["username"];?></h3>
        <!-- <h3>LES DOCTORANT</h3> -->
    </div>
    <a href="#" onclick="ShowList();" class="toggl">
        <span class="add"></span>
        <span class="add"></span>
        <span class="add"></span>
    </a>
    <div id="items" class="element dsp">
        <ul>
            <li><a href="../Home/Home.php">Accueil</a></li>
            <!-- <li><a href="../Docteur/Docteur.php">Doctorant</a></li> -->
            <li><a href="../Docteur/Docteur.php">Doctorant</a></li>
            <li><a href="../Jury/jury.php">Jury</a></li>
            <li><a href="../Sout/Soutnance.php">Soutenance</a></li>
            <li><a href="../login and logOut/LogOut.php">Se Déconnecter</a></li>
            
        </ul>
    </div>
</nav>
<script>
    function ShowList(){

        // tittle = document.getElementById("tittle");
        items = document.getElementById("items");
        items.classList.toggle("dsp");
        
        // if(items.style.display === "none"){
        // // tittle.style.display = "none" ;
        // items.style.display = "block" ;

        // }else
        // {
        //     // tittle.style.display = "block" ;
        //     items.style.display = "none" ;
        // }
    }
    </script>