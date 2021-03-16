<?php
require_once("functions/mysql/database.php");
require_once("functions/presentation/html.php");
require_once("functions/presentation/navbar.php");
if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])){
    $email=$_POST["email"];
    $password=$_POST["password"];
    $conn=openconnection();
    $sql = "select id, nom, motdepasse, email,statut from personne where email='$email' and motdepasse='$password'";
    //echo $sql;
    $result = mysqli_query($conn,$sql) or die("Query failed");
    if ($line = mysqli_fetch_assoc($result)){
        $utilisateur = array('id' => $line[id], 'nom' => $line[nom],
    'email' => $line[email], 'statut' => $line[statut]);
        //on met l'utilisateur authentifié en session
        session_start();
        $_SESSION['utilisateur'] = $utilisateur;

        afficheEntete($line[nom]);
        if ($line[statut] == "professeur"){
            headerProfesseur($utilisateur);
        } else { // c'est un élève
            headerEleve($utilisateur);
        }
        afficheFin();
    } else {
        header('Location:http://localhost/qcmcnam/index.php?error=incorrect');
    }
    fermerConnection($result, $conn);
} else {
    header('Location:http://localhost/qcmcnam/index.php?error=vide');
}

?>