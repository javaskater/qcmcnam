<?php
require_once("../functions/mysql/database.php");
function retourneEleves(){
    $resultat = array();
    $maConn = openconnection();
    $sql = "select id, nom, email from personne where statut='eleve' order by nom";
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("Query failed");
    while ($line = mysqli_fetch_assoc($result)){
        $resultat[] = $line;
    }
    fermerConnection($result, $maConn);
    return $resultat;
}
?>