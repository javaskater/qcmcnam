<?php
require_once("../functions/mysql/database.php");
function rechercheQuestionsPourQcm($idQcm=null){
    $resultat = array();
    $maConn = openconnection();
    $sql = "";
    if ($idQcm == null){
        $sql = "select id, texte from question order by id";
    } else {
        $sql = "select id, texte from question where id not in (select idQuestion from questionqcm where idQcm = ".$idQcm.") order by id";
    }
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("Query failed");
    while ($line = mysqli_fetch_assoc($result)){
        $resultat[] = $line;
    }
    fermerConnection($result, $maConn);
    return $resultat;
}
?>