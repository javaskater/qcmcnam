<?php
    require_once("../functions/mysql/database.php");
    //var_dump($_GET);
    $libelle = $_GET['libelle'];
    $arrQuestionsIds = explode(' ', $_GET['questions']);
    $maConn = openconnection();
    $sql = "insert into qcm (libelle, publie) values (\"".$libelle."\", 0)";
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("requete qcm en erreur");
    $idNewQcm = mysqli_insert_id($maConn);
    //var_dump($arrQuestionsIds);
    //echo "$idNewQcm";
    //echo $_GET['questions'];
    echo "longueur:".count($arrQuestionsIds);
    for ($i=0; $i < count($arrQuestionsIds); $i++){
        $sql = "insert into questionqcm (idQuestion, idQcm, ordre) values (".$arrQuestionsIds[$i].",".$idNewQcm.", ".$i.")";
        //echo $sql;
        $result = mysqli_query($maConn,$sql) or die("requete qcm/question en erreur");
    }
    fermerConnection($result, $maConn);
    header('Location:http://localhost/qcmcnam/qcm/creerqcm.php');
?>