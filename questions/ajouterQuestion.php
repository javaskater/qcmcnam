<?php
require_once("../functions/mysql/database.php");
//var_dump($_POST);
$enErreur = false;
$error = "";
if(empty($_POST['texteQuestion'])){
    $error = $error. "qvide";
    $enErreur = true;
}
$nombreReponses = $_POST['choixNombreReponses'];
for ($i=0; $i < $nombreReponses; $i++){
    $indexReponse = "r".$i;
    if(empty($_POST[$indexReponse])){
        if (!empty($error)){
            $error = $error. ";";
        }
        $error = $error. "rvide";
        $enErreur = true;
        break;
    }
}
if(!isset($_POST['bonneReponse']) || empty($_POST['bonneReponse'])){ 
    if (!empty($error)){
        $error = $error. ";";
    }
    $error = $error. "rbvide";
    $enErreur = true;
}
if ($enErreur){
    setcookie("postValues", json_encode($_POST));//on renvoie les valeurs POST au formulaire
    header('Location:http://localhost/qcmcnam/questions/gererQuestions.php?error='.$error);
} else {
    unset($_COOKIE['postValues']);
    setcookie('postValues', '', time() - 3600, '/'); // empty value and old timestamp
    $idTheme = $_POST['selectTheme'];
    session_start();
    $idAuteur = $_SESSION['utilisateur']['id'];
    $texte = $_POST['texteQuestion'];
    $maConn = openconnection();
    $sql = "insert into question (idTheme, idAuteur, texte) values ('".$idTheme."', '".$idAuteur."','".$texte."')";
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("requete question en erreur");
    $idNewQuestion = mysqli_insert_id ($maConn);
    for ($i=0; $i < $nombreReponses; $i++){
        $indexReponse = "r".$i;
        $texteReponse = $_POST[$indexReponse];
        $indexBonneReponse = "rb".$i;
        $bonneReponse = 0;
        if ($_POST['bonneReponse'] == $indexBonneReponse){
            $bonneReponse = 1;
        }
        $sql = "insert into Reponse (idQuestion, texte, bonneReponse) values (".$idNewQuestion.",'".$texteReponse."',".$bonneReponse.")";
        $result = mysqli_query($maConn,$sql) or die("requete réponse en erreur");
    }
    fermerConnection($result, $maConn);
    header('Location:http://localhost/qcmcnam/questions/gererQuestions.php');
}
?>