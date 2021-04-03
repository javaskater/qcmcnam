<?php
require_once("../functions/mysql/database.php");
require_once("../functions/presentation/html.php");
require_once("../functions/presentation/navbar.php");
require_once("rechercherQuestions.php");

session_start();
$utilisateur = $_SESSION['utilisateur'];
if (isset($utilisateur) && !empty($utilisateur) && $utilisateur['statut'] == "professeur"){
    afficheEntete($utilisateur['nom']);
    headerProfesseur($utilisateur);
    ?>
<div class="container-fluid">
    <form method="POST" action="publishQcmAction.php">
    	<div class="row flex-xl-nowrap mt-2">
            <div class="col-12 col-md-12 col-xl-12">
                <ul class="list-group" id="questionsQcm">
                <?php 
                    $maConn = openconnection();
                    $casesaCocher = "";
                    $sql = "select * from qcm order by id";
                    //echo $sql;
                    $result = mysqli_query($maConn,$sql) or die("requete affiche QCM publish en erreur");
                    while ($line = mysqli_fetch_assoc($result)){
                        $casesaCocher = $casesaCocher.$line['id']."+";
                        echo "<li class='list-group-item'>";
                        echo $line['libelle']. " <input type='checkbox' name='cb".$line['id']."' value='on'";
                        if($line['publie'] == 1){
                            echo " checked";
                        }
                        echo " />";
                        echo "</li>";
                    }
                    $casesaCocher=substr($casesaCocher, 0, -1);
                    echo "<input type='hidden' name='cases' value='".$casesaCocher."' />";
                    fermerConnection($result, $maConn);
                ?>
        		</ul>
        		<button type="submit" class="btn btn-primary">publier</button>
            </div>
        </div>
    </form>
</div>

<?php
    afficheFin();
}