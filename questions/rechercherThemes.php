<?php
require_once("../functions/mysql/database.php");
function retourneThemes(){
    $resultat = array();
    $maConn = openconnection();
    $sql = "select id, label, description from themes order by id";
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("Query failed");
    while ($line = mysqli_fetch_assoc($result)){
        $resultat[] = $line;
    }
    fermerConnection($result, $maConn);
    return $resultat;
}
?>