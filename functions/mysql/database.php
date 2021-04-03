<?php
    function openconnection(){
        // Connexion et sélection de la base
        $Macon = mysqli_connect("localhost", "qcmcnam", "qcmcnam") or die("Impossible de se connecter");
        //echo "Connexion réussie";
        //selectionner la base courrante
        mysqli_select_db($Macon,"qcmcnam") or die("Impossible de sélectionner qcmcnam");
        return $Macon;
    }

    function fermerConnection($res, $Macon){
        mysqli_free_result($res); 
        mysqli_close($Macon); 
    }
?>