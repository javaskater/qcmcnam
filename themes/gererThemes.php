<?php
require_once("../functions/mysql/database.php");
require_once("../functions/presentation/html.php");
require_once("../functions/presentation/navbar.php");

session_start();
$utilisateur = $_SESSION['utilisateur'];
if (isset($utilisateur) && !empty($utilisateur) && $utilisateur['statut'] == "professeur"){
    afficheEntete($utilisateur['nom']);
    headerProfesseur($utilisateur);
}
?>
<div class="container-fluid">
	<div class="row flex-xl-nowrap mt-2">
        <div class="col-12 col-md-3 col-xl-2">
            <form method="post" action="ajouterTheme.php">
              <div class="form-group">
                <label for="labelTheme">Label du Thème</label>
                <input type="text" class="form-control" id="labelTheme" name="labelTheme" aria-describedby="labelTheme" placeholder="Entrez le Thème">
                <small id="labelThemeHelp" class="form-text text-muted">Ceci sera le thème que vous choisirez</small>
              </div>
              <div class="form-group">
                <label for="textTheme">Description du thème</label>
                <input type="text" class="form-control" id="textTheme" name="textTheme" placeholder="description">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
		</div>
		<div class="col-12 col-md-6 col-xl-10">
<?php
if (isset($_GET['error']) && !empty($_GET['error'])) {
    $typeErreur = $_GET['error'];
    echo "<div class=\"alert alert-danger\">";
    echo "<strong>Erreur!</strong>";
    if ($typeErreur == "vide") {
        echo "le label ne peut être vide";
    }
    echo "</div>";
}elseif (isset($utilisateur) && !empty($utilisateur) && $utilisateur['statut'] == "professeur"){
    $conn=openconnection();
    $sql = "select id, label, description from themes order by id";
    //echo $sql;
    $result = mysqli_query($conn,$sql) or die("Query failed");
    echo "<ul class=\"list-group\">";
    while ($line = mysqli_fetch_assoc($result)){
        echo "<li class=\"list-group-item\"><a href=\"editTheme.php?id=".$line['id']."\">".$line['label']."</li>";
    }
    echo "</ul>";
    fermerConnection($result, $conn);
}
?>
		</div>
	</div>
</div>
<?php
    afficheFin();
?>