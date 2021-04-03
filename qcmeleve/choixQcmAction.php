<?php 
require_once("../functions/mysql/database.php");
require_once("../functions/presentation/html.php");
require_once("../functions/presentation/navbar.php");
    //var_dump($_POST);
    
session_start();
$utilisateur = $_SESSION['utilisateur'];
$qcmId=0;
if (isset($utilisateur) && !empty($utilisateur) && $utilisateur['statut'] == "eleve"){
    afficheEntete($utilisateur['nom']);
    headerEleve($utilisateur);
    if (isset($_POST['qcmChoisi']) && !empty($_POST['qcmChoisi'])){
        $qcmId = $_POST['qcmChoisi'];
    } else {
        $error = "rbvide";
        header('Location:http://localhost/qcmcnam/qcmeleve/choixqcm.php?error='.$error);
    }
?>

<div class="container-fluid">
    <form method="POST" action="soumettreQcm.php">
    	<div class="row flex-xl-nowrap mt-2">
            <div class="col-12 col-md-12 col-xl-12">
            <?php 
        $reponsesOk="";
        $maConn = openconnection();
        $sql = "select * from qcm where id =".$qcmId;
        //echo $sql;
        $result = mysqli_query($maConn,$sql) or die("requete recupération  QCM a traiter en erreur");
        if ($line = mysqli_fetch_assoc($result)){
            echo "<h1>".$line['libelle']."</h1>" ;
            $idQcm = $line['id'];
            $sqlQuestions = "select q.id as idQuestion, q.texte as texteQuestion from question q, questionqcm qq ";
            $sqlQuestions .= "where qq.idQuestion=q.id and qq.idQcm=".$idQcm." order by qq.ordre";
            $resultQuestions = mysqli_query($maConn,$sqlQuestions) or die("requete recupération  Questions du QCM en erreur");
            
            echo "<ul class=\"list-group\" id=\"questionsQcm\">";
            while ($lineQuestion = mysqli_fetch_assoc($resultQuestions)){
                echo "<li class='list-group-item'>";
                echo $lineQuestion['texteQuestion'];
                $rbName = "rb".$lineQuestion['idQuestion'];
                $reponsesOk.=$rbName."=";
                $sqlResponses = "select id, idQuestion, texte, bonneReponse from Reponse where idQuestion=".$lineQuestion['idQuestion'];
                //TODO idQuestion sert à créer le name de la série de radiobuttons !!!
                //echo $sqlResponses;
                $resultResponses = mysqli_query($maConn,$sqlResponses) or die("requete recupération  Réponses du QCM en erreur");
                while ($lineResponse = mysqli_fetch_assoc($resultResponses)){
                    echo " <input type='radio' name='".$rbName."' id = 'rb".$lineResponse['id']."' value='".$lineResponse['id']."'";
                    echo " />";
                    echo "<label for='rb".$lineResponse['id']."'>".$lineResponse['texte']."</label>" ;
                    if ($lineResponse["bonneReponse"] == 1){
                        $reponsesOk.= $lineResponse['id'].";";
                    }
                }
                mysqli_free_result($resultResponses);
                echo "</li>";
            }
            echo "</ul>";
            mysqli_free_result($resultQuestions);

        }
        fermerConnection($result, $maConn);
        $reponsesOk = substr($reponsesOk,0,-1);
        echo "<input type=hidden name=reponses value='".$reponsesOk."' />";
        echo "<input type=hidden name=idQcm value='".$qcmId."' />";
    ?>
            
            <button type="submit" class="btn btn-primary">Soumettre QCM</button>
            </div>
        </div>
    </form>
</div>

<?php
    afficheFin();
}
?>