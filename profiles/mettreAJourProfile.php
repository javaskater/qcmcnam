<?php
    require_once("../functions/mysql/database.php");
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //var_dump($_FILES);
    $uploaddir = "./images/";
    //nom du fichier telecharge
    $uploadfile = $uploaddir . $_FILES["userfile"]["name"];
    //nom du fichier temporaire uploade
    $tmp_file=$_FILES["userfile"]["tmp_name"];//verifions qu’il a ete uploade
    if( !is_uploaded_file($tmp_file) ){ 
        //exit("Le fichier est introuvable");
        $error = "upfvide";
        header('Location:http://localhost/qcmcnam/profiles/gererProfile.php?error='.$error);

    }
    $type=$_FILES["userfile"]["type"];
    //echo "le type est:".$type;
    if ($type != "image/png"){
        //exit("Le fichier n'est pas du bon type");
        $error = "upftype";
        if (file_exists ( $uploadfile ) ){
            echo $uploadfile;
            chmod($uploadfile,0777);
            if (!unlink($uploadfile)){
                echo "impossible de supprimer le fichier";
            } else {
                echo "fichier edffectivement supprime";
            }
            echo "j'ai supprime le fichier";
        }
        header('Location:http://localhost/qcmcnam/profiles/gererProfile.php?error='.$error);
    }
    //deplacons le fichier image dans sa destionation finale
    else if (move_uploaded_file($tmp_file, $uploadfile)) {
        session_start();
        //var_dump($_SESSION);
        $utilisateurId = $_SESSION['utilisateur']['id'];
        $utilisateurClasseId = $_POST['classe'];
        $maConn = openconnection();
        //TODO verifier qu'il n'y a pas déjà une note pour ce QCM et cet élève
        $sql = "update personne set urlImage='".$uploadfile."', idClasse=".$utilisateurClasseId." where id=".$utilisateurId;
        //echo $sql;
        $result = mysqli_query($maConn,$sql) or die("mis à jour de l'avatar en erreur");
        mysqli_close($maConn);
        header('Location:http://localhost/qcmcnam/profiles/gererProfile.php?succes=1');
    } else {
        $error = "upfvide";
        header('Location:http://localhost/qcmcnam/profiles/gererProfile.php?error='.$error);
    }
?>