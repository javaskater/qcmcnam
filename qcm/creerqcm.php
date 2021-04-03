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
	<div class="row flex-xl-nowrap mt-2">
        <div class="col-12 col-md-3 col-xl-2">
            <form method="post" action="ajouterQcm.php">
              <div class="form-group">
                <label for="texteQuestion">Libelle du QCM</label>
                <input type="text" class="form-control" id="libelleQcm" name="libelleQcm" aria-describedby="libelleQcm" placeholder="Entrez le titre du QCM">
                <small id="texteQuestionHelp" class="form-text text-muted">Ceci sera le titre du QCM</small>
              </div>
              <div class="form-group">
                <label for="selectTheme">Choix de la question</label>
                <select class="form-control" id="selectQuestion" name="selectQuestion">
                	<?php 
                	$lesQuestions = rechercheQuestionsPourQcm();
                	foreach ($lesQuestions as $question){
                	    echo "<option value=".$question[id].">".$question[texte]."</option>";
                	}
                	?>
                </select>
              </div>
              <input type="button" class="btn btn-primary" value="Ajouter au QCM" onclick="ajouterADroite()" />
		</div>
		<div class="col-12 col-md-6 col-xl-10">
		<div class="alert alert-danger" id="erreurMessage" style="display:none;">
		   <strong>Erreur!</strong>
		</div>
		<ul class="list-group" id="questionsQcm">
		</ul>
		<input type="button" class="btn btn-primary" value="Créer le QCM" onclick="envoyerLeQcm()" />
		</div>
		</form>
	</div> <!-- fin du Row -->
</div> <!-- fin du Container -->
<script type="text/javascript">
function byId(id){
	return document.getElementById(id);
}
function ajouterADroite(){
	var selectList = byId('selectQuestion');
	var ulList = byId('questionsQcm');
	var valeur  = selectList.value;
	var texte = selectList.options[selectList.selectedIndex].text;
	console.log("on transfère "+ texte + " de valeur : "+ valeur);
	var li = document.createElement("li");
	li.className = "list-group-item";
	var span = document.createElement("span");
	span.id = valeur;
	var textNode = document.createTextNode(texte);
	span.appendChild(textNode);
	li.appendChild(span);
	ulList.appendChild(li);
	selectList.removeChild(selectList.options[selectList.selectedIndex]);	
}
function envoyerLeQcm(){
	var enErreur = false;
	var msgError = "";
	var libelleQcm = byId('libelleQcm');
	if (libelleQcm.value.length == 0){
		enErreur = true;
		msgError = "veuillez entrer un libelle de QCM <br/>";
	}
	var questionsElts = document.querySelectorAll('#questionsQcm li span');
	if (questionsElts.length == 0){
		enErreur = true;
		msgError = msgError+"veuillez sélectionner des questions pour le QCM <br/>";
	}
	if (enErreur){
		var msgElt = byId("erreurMessage");
		msgElt.innerHTML = '';
		msgElt.innerHTML = msgError;
		msgElt.style.display = "block";
	} else {
		//on prépare les Get PArameters
		var queryString= 'libelle='+encodeURIComponent(libelleQcm.value)+'&questions=';
		for (var i = 0; i < questionsElts.length; i++){
			queryString=queryString+questionsElts[i].id;
			if (i < questionsElts.length - 1){
				queryString=queryString+"+";
			}
		}
		window.location="http://localhost/qcmcnam/qcm/ajouterQcm.php?"+queryString;
	}
}
</script>
<?php
    afficheFin();
}
?>