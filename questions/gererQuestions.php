<?php
require_once("../functions/mysql/database.php");
require_once("../functions/presentation/html.php");
require_once("../functions/presentation/navbar.php");
require_once("rechercherThemes.php");

session_start();
$utilisateur = $_SESSION['utilisateur'];
if (isset($utilisateur) && !empty($utilisateur) && $utilisateur['statut'] == "professeur"){
    afficheEntete($utilisateur['nom']);
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
		<?php
		if (isset($_GET['error']) && !empty($_GET['error'])) {
		    echo "<div class=\"alert alert-danger\">";
		    echo "<strong>Erreur!</strong>";
		    $listeErreur = explode ( ";" , $_GET['error']);
		    $msg = "";
		    for ($i=0; $i < count($listeErreur); $i++){
		        $erreur = $listeErreur[$i];
		        if ($erreur == "qvide"){
		            $msg = $msg."le texte de la question ne peut être vide";
		        } else if ($erreur == "rvide"){
		            if (strlen(msg) > 0){
		                $msg = $msg."<br />";
		            }
		            $msg = $msg."le texte des réponses ne peut être vide";
		        } else if ($erreur == "rbvide"){
		            if (strlen(msg) > 0){
		                $msg = $msg."<br />";
		            }
		            $msg = $msg."il vous faut choisir une réponse";
		        }
		    }
            echo $msg;
            echo "</div>";
		}
		$maConn = openconnection();
		$sql = "select q.id as id, p.nom as nom, q.texte as texte from question q, personne p where q.idAuteur = p.id order by q.id";
		//echo "$sql";
		$result = mysqli_query($maConn,$sql) or die("requete lecture questions en erreur");
		echo "<ul class=\"list-group\">";
		while ($line = mysqli_fetch_assoc($result)){
		    echo "<li class=\"list-group-item\"><a href=\"editQuesion.php?id=".$line['id']."\">".$line['texte']." (auteur:".$line['nom'].")</li>";
		}
		echo "</ul>";
		fermerConnection($result, $maConn);
        ?>
		</div>
	</div> <!-- fin du Row -->
</div> <!-- fin du Container -->
<script type="text/javascript">

function byId(id){
	return document.getElementById(id);
}

//Trouvé sur https://www.informit.com/articles/article.aspx?p=2164575&seqNum=9
function getCookie(name) {
  var cArr = document.cookie.split(';');
  for(var i=0;i < cArr.length;i++) {
    var cookie = cArr[i].split("=",2);
    cookie[0] = cookie[0].replace(/^\s+/,"");
    if (cookie[0] == name){ return cookie[1]; }
  }
}



function setCookie(name, value, days) {
  var date = new Date();
  date.setTime(date.getTime()+(days*24*60*60*1000));
  var expires = "; expires="+date.toGMTString();
  document.cookie = name + "=" + value +
                    expires + "; path=/";
}


function addFields(){
    // Number of inputs to create
    var number = document.getElementById("choixNombreReponses").value;
    addANumberOfFields(number);
}
function addANumberOfFields(number){
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
        var txtlabel = document.createTextNode("Reponse "+(i+1));
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
    var titrerb = document.createElement("h4");
    titrerb.appendChild(document.createTextNode("Choisissez la bonne réponse"));
    container.appendChild(titrerb);
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
        var txtlabel = document.createTextNode("reponse "+(i+1))
        label.appendChild(txtlabel);
        divrb.appendChild(label);
        divrb.appendChild(radio);
    }
    container.appendChild(divrb);
}
function pageEnErreur(){
	var enErreur = false;
	var queryString = window.location.search;
	if (queryString.length > 0){
		var urlParams = new URLSearchParams(queryString);
		var error = urlParams.get('error');
		if (error != null && error.length > 0){
			enErreur = true;
		}
	}
	return enErreur;
}
if (pageEnErreur()){
	var jsonString = decodeURIComponent(getCookie('postValues'));
    console.log("le String Cookie vaut:"+jsonString);
    var lesValeurs = JSON.parse(jsonString)
    console.log(lesValeurs);
    addANumberOfFields(lesValeurs['choixNombreReponses']);
    //On prerempli les champs pour permettre la correction du formulaire
    var qInputElt = byId('texteQuestion');
    qInputElt.value = lesValeurs['texteQuestion'];
    var themeElt = byId('selectTheme');
    themeElt.value = lesValeurs['selectTheme'];
    var nbChoixElt = byId('choixNombreReponses');
    nbChoixElt.value = lesValeurs['choixNombreReponses'];
    for (var i = 0; i < lesValeurs['choixNombreReponses']; i++){
    	var repId = 'r'+i;
    	var eltRep = byId(repId);
    	eltRep.value = lesValeurs[repId];
    }
    if (lesValeurs['bonneReponse'] != undefined){
    	var valeur = lesValeurs['bonneReponse'];
    	for (var i = 0; i < lesValeurs['choixNombreReponses']; i++){
        	var rchoixId = 'rb'+i;
        	var eltChoix = byId(rchoixId);
        	if (eltChoix.value == valeur){
        		eltChoix.checked = true;
        	}
        }
    }
} else {
	addFields();
	console.log("tout va bien rien à faire");
}
</script>
<?php
    afficheFin();
}
?>