<?php
require_once("../functions/mysql/database.php");
function retourneQcms(){
    $resultat = array();
    $maConn = openconnection();
    $sql = "select id, libelle, publie from qcm where publie=1 order by id";
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("Query failed");
    while ($line = mysqli_fetch_assoc($result)){
        $resultat[] = $line;
    }
    fermerConnection($result, $maConn);
    return $resultat;
}
?>