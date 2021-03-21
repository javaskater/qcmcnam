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
 }
 fermerConnection($result, $maConn);
 header('Location:http://localhost/qcmcnam/qcm/publishqcm.php');
 
 