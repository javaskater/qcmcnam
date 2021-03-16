<?php
require_once("../functions/mysql/database.php");
if (isset($_POST[labelTheme]) && !empty($_POST[labelTheme])){
    $themeAAjouter = $_POST[labelTheme];
    $description = $_POST[textTheme];
    $maConn = openconnection();
    $sql = "insert into themes (label, description) values ('".$themeAAjouter."', '".$description."')";
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("Query failed");
    fermerConnection($result, $conn);
    header('Location:http://localhost/qcmcnam/themes/gererThemes.php');
} else {
    header('Location:http://localhost/qcmcnam/themes/gererThemes.php?error=vide');
}
?>