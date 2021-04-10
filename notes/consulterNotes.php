<?php
require_once("../functions/mysql/database.php");
require_once("../functions/presentation/html.php");
require_once("../functions/presentation/navbar.php");

session_start();
$utilisateur = $_SESSION['utilisateur'];
//var_dump($_SESSION);
if (isset($utilisateur) && !empty($utilisateur) && $utilisateur['statut'] == "eleve"){
    afficheEntete($utilisateur['nom']);
    headerEleve($utilisateur);
    $idEleve = $utilisateur['id'];
    $maConn = openconnection();
    $sql = "select n.note as note, q.libelle as libelle, q.id as qid from notes n, qcm q where n.idQcm = q.id and n.idPersonne = '".$idEleve."' order by libelle";
    $result = mysqli_query($maConn,$sql) or die("requete lecture notes en erreur");
    echo "<ul class=\"list-group\">";
    while ($line = mysqli_fetch_assoc($result)){
        $sqlc = "select count(*) as nbq from questionqcm where idQcm=".$line['qid'];
        $resultc = mysqli_query($maConn,$sqlc) or die("requete nbe questions en erreur");
        $nbeQuestions = 0;
        if ($linec = mysqli_fetch_assoc($resultc)){
            $nbeQuestions = $linec['nbq'];
        }
        echo "<li class=\"list-group-item\">QCM: ".$line['libelle'].", note: ".$line['note']."/".$nbeQuestions."</li>";
    }
    fermerConnection($result, $maConn);
    echo "</ul>";
?>

<?php
    afficheFin();
}
?>