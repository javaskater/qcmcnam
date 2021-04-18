<?php
 require_once("../functions/mysql/database.php");
 //var_dump($_POST);
 $arrLesCases = explode('+',$_POST["cases"]);
 //var_dump($arrLesCases);
 $maConn = openconnection();
 
 foreach ($arrLesCases as $laCase){
     $checkBoxName = 'cb'.$laCase;
     if (isset($_POST[$checkBoxName]) && !empty($_POST[$checkBoxName]) && $_POST[$checkBoxName] == "on"){
         //echo $checkBoxName. " selectionnée <br />";
         $sql = "update qcm set publie = 1 where id=".$laCase;
     } else {
         //echo $checkBoxName. " non selectionnée <br />";
         $sql = "update qcm set publie = 0 where id=".$laCase;
     }
     $result = mysqli_query($maConn,$sql) or die("requete publish QCM en erreur");
     $selectName = 's'.$laCase;
     //$laCase est l'idQcm les données de $POST[]
     $sqldelete = "delete from qcmclasse where idQcm = ".$laCase;
     $result = mysqli_query($maConn,$sqldelete) or die("requete supprimer QcmClasse en erreur");
     $arrLesClasses = $_POST[$selectName];
     foreach($arrLesClasses as $uneClasse){
        $sqlinsert = "insert into qcmclasse (idQcm, idClasse) values (".$laCase.",".$uneClasse.")";
        $result = mysqli_query($maConn,$sqlinsert) or die("requete insérer QcmClasse en erreur");
     }//var_dump($_POST[$selectName]);
 }
 
 mysqli_close($maConn);
 header('Location:http://localhost/qcmcnam/qcm/publishqcm.php');
 
 