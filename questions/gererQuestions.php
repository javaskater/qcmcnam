<?php
require_once("../functions/mysql/database.php");
require_once("../functions/presentation/html.php");
require_once("../functions/presentation/navbar.php");
require_once("rechercherThemes.php");

session_start();
$utilisateur = $_SESSION['utilisateur'];
if (isset($utilisateur) && !empty($utilisateur) && $utilisateur[statut] == "professeur"){
    afficheEntete($utilisateur[nom]);
    headerProfesseur($utilisateur);
    $lesThemes = retourneThemes();
    //TODO renvoyer vers gererThemes quand pas de thème entré
?>
<div class="container-fluid">
	<div class="row flex-xl-nowrap mt-2">
        <div class="col-12 col-md-3 col-xl-2">
            <form method="post" action="ajouterQuestion.php">
              <div class="form-group">
                <label for="texteQuestion">Texte de la question</label>
                <input type="text" class="form-control" id="texteQuestion" name="texteQuestion" aria-describedby="texteQuestion" placeholder="Entrez le Texte de la Question">
                <small id="texteQuestionHelp" class="form-text text-muted">Ceci sera la question</small>
              </div>
              <div class="form-group">
                <label for="selectTheme">Choix du thème</label>
                <select class="form-control" id="selectTheme" name="selectTheme">
                	<?php 
                	foreach ($lesThemes as $theme){
                	    echo "<option value=".$theme[id].">".$theme[label]."</option>";
                	}
                	?>
                </select>
              </div>
              <div class="form-group">
                <label for="choixNombreReponses">Choix du nombre de réponses</label>
                <select class="form-control" id="choixNombreReponses" name="choixNombreReponses" onchange="addFields()">
                	<option>3</option>
                	<option>4</option>
                	<option>5</option>
                </select>
              </div>
              <div id="reponses">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
		</div>
		<div class="col-12 col-md-6 col-xl-10">
		<!-- TODO mettre ici les questions déjà enregistrées -->
		</div>
	</div> <!-- fin du Row -->
</div> <!-- fin du Container -->
<script type="text/javascript">
function addFields(){
    // Number of inputs to create
    var number = document.getElementById("choixNombreReponses").value;
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("reponses");
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    for (i=0;i<number;i++){
        // Ajoute une entrée avec un inputField et un radioBouton
        //<div class="form-group">
        var div = document.createElement("div");
        div.className = "form-group";
        //Crée un label element
        var label = document.createElement("label");
        label.setAttribute("for", "r"+i);
        var txtlabel = document.createTextNode("Reponse "+(i+1))
        label.appendChild(txtlabel);
        // Crée un <input> element!
        var input = document.createElement("input");
        input.id = "r" + i;
        input.type = "text";
        input.name = "r" + i;
        input.className = "form-control";
        div.appendChild(label);
        div.appendChild(input);
        container.appendChild(div);
    }
    //le Div pour les radio boutons qui indiquent la réponse vraie
    container.appendChild(div);
    var divrb = document.createElement("div");
    divrb.className = "form-group";
    for (var i=0;i<number;i++){
    	//<input type="radio" id="huey" name="drone" value="huey"
    	var radio = document.createElement("input");
    	radio.type = "radio";
    	radio.name = "bonneReponse";
    	radio.id = "rb"+i;
    	radio.value = "rb"+i;
    	radio.className = "form-control";
    	var label = document.createElement("label");
        label.setAttribute("for", "rb"+i);
        var txtlabel = document.createTextNode("choix "+(i+1))
        label.appendChild(txtlabel);
        divrb.appendChild(label);
        divrb.appendChild(radio);
    }
    container.appendChild(divrb);
}
addFields();
</script>
<?php
    afficheFin();
}
?>