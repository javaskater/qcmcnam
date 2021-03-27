<?php
require_once("../functions/mysql/database.php");
require_once("../functions/presentation/html.php");
require_once("../functions/presentation/navbar.php");

session_start();
$utilisateur = $_SESSION['utilisateur'];
if (isset($utilisateur) && !empty($utilisateur) && $utilisateur[statut] == "eleve"){
    afficheEntete($utilisateur[nom]);
    headerEleve($utilisateur);
?>
<div class="container-fluid">
    <form method="POST" action="choixQcmAction.php">
    	<div class="row flex-xl-nowrap mt-2">
            <div class="col-12 col-md-12 col-xl-12">
<?php if (isset($_GET['error']) && !empty($_GET['error'])) {
        $msg="";
        $erreur = $_GET['error'];
        echo "<div class=\"alert alert-danger\">";
        if ($erreur == "rbvide"){
            $msg = "Vous devez à tout prix choisir un QCM";
        }
        echo $msg;
        echo "</div>";
    }
?>
    <ul class="list-group" id="questionsQcm">
    <?php 
        $maConn = openconnection();
        $sql = "select * from qcm where publie=1 order by id";
        //echo $sql;
        $result = mysqli_query($maConn,$sql) or die("requete choix  QCM a traiter en erreur");
        while ($line = mysqli_fetch_assoc($result)){
            echo "<li class='list-group-item'>";
            echo " <input type='radio' class='form-check-input' name='qcmChoisi' id = 'rb".$line['id']."' value='".$line['id']."'";
            echo " />";
            echo "<label for='rb".$line['id']."'>".$line['libelle']."</label>" ;
            echo "</li>";
        }
        fermerConnection($result, $maConn);
    ?>
        		</ul>
        		<button type="submit" class="btn btn-primary">Choisir QCM</button>
            </div>
        </div>
    </form>
</div>
<?php
    afficheFin();
}
?>