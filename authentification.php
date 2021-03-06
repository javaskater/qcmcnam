<?php
require_once("functions/mysql/database.php");

if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])){
    $email=$_POST["email"];
    $password=$_POST["password"];
    $conn=openconnection();
    $sql = "select nom, motdepasse, email,statut from personne where email='$email' and motdepasse='$password'";
    echo $sql;
    $result = mysqli_query($conn,$sql) or die("Query failed");
    if ($line = mysqli_fetch_assoc($result)){
        echo "<h1>Bienvenue $line[nom] votre statut est $line[statut] </h1>";
    } else {
        header('Location:http://localhost/qcmcnam/index.php?error=incorrect');
    }
    fermerConnection($result, $conn);
} else {
    header('Location:http://localhost/qcmcnam/index.php?error=vide');
}

?>