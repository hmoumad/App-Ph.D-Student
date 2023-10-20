<?php
    Require("../../connexion.php");

    $searchid = $_GET['code'];
    $sql = "SELECT * FROM `soutenance` WHERE `CIN_J` LIKE '$searchid%' OR `CODE_Doc` LIKE '$searchid%'";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        echo "error execute query " . mysqli_error($con);
    }
    if (strlen($searchid)>0) {
    while($result = mysqli_fetch_assoc($query)) {
        echo "<div class='content2'>";
            echo "<div class='idsout'>
                    <span>Id Soutenance : </span>" . $result['id_soutenance'] . "
                </div>";
            echo "<div class='code'>
                   <span>Code Doctorant : </span>" . $result['CODE_Doc'] . "
                </div>";
            echo "<div class='cinj'>
                   <span>CIN juru : </span>" . $result['CIN_J'] . "
                </div>";
            echo " <div class='date'>
                   <span>Date Soutenace : </span>" . $result['Date_Soutenance'] . "
                </div>";
            echo "<div class='titre'>
                   <span>Titre Travail : </span> " . $result['Titre_Travail'] . "
                </div>";
            echo "<div class='grad'>
                   <span>Grad : </span>" . $result['Grade_J'] . "
                </div>" ;
            echo "<div class='statut'>
                   <span>Statut : </span>" . $result['Statut_J'] . "
                </div>" ;
                echo "<div class='etabliss'>
               <span>Etablissement : </span>" . $result['Etablissement_J'] . "
            </div>" ;
        echo "</div>";
        // if($result['id_soutenance']!=$result['id_soutenance'])
        // {
            echo "<hr/>";
        // }
    }
}
    
?>