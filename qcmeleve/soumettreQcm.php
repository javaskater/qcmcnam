<?php
require_once("../functions/mysql/database.php");
session_start();
//var_dump($_SESSION);
//var_dump($_POST);
$note = 0;
$nbQuestions = 0;
if (isset($_POST['reponses']) && !empty($_POST['reponses'])){
    $reponses = explode(";",$_POST['reponses']);
    $nbQuestions = count($reponses);
    for ($i=0; $i < count($reponses); $i++){
        $reponseArr = explode('=', $reponses[$i]);
        //var_dump($reponseArr );
        $radioButton = $reponseArr[0];
        $bonneReponse = $reponseArr[1];
        $reponseDonnee = $_POST[$radioButton];
        if (isset($reponseDonnee) && !empty($reponseDonnee)){
            if($reponseDonnee == $bonneReponse){
                $note += 1;
            }
        }
    }
}
$maConn = openconnection();
//TODO verifier qu'il n'y a pas déjà une note pour ce QCM et cet élève
$sql = "insert into notes (idPersonne, idQcm, note, publie) values (".$_SESSION['utilisateur']['id'].",".$_POST['idQcm'].",".$note.",0)";
//echo $sql;
$result = mysqli_query($maConn,$sql) or die("requete  Ajout d'une note en erreur");
fermerConnection($result, $maConn);
?>