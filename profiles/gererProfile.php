<?php
    require_once("../functions/mysql/database.php");
    require_once("../functions/presentation/html.php");
    require_once("../functions/presentation/navbar.php");
    
    session_start();
    $utilisateur = $_SESSION['utilisateur'];
    if (isset($utilisateur) && !empty($utilisateur)){
        afficheEntete($utilisateur['nom']);
        if ($utilisateur['statut'] == "eleve"){
            headerEleve($utilisateur);
        } else {
            headerProfesseur($utilisateur);
        }
        //var_dump($_SESSION);
?>
    <div class="container">
    <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
        $msg="";
        $erreur = $_GET['error'];
        echo "<div class=\"alert alert-danger\">";
        if ($erreur == "upfvide"){
            $msg = "Le fichier image n'a pu être téléchargé";
        } else if ($erreur == "upftype") {
            $msg = "Le fichier image doit être de type png";
        }
        echo $msg;
        echo "</div>";
    }
    if (isset($_GET['succes']) && !empty($_GET['succes'])){
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "l'image de votre profil a bien été uploadée";
        echo "</div>";
    }
    ?>
        <h4>Profil de <?php echo $utilisateur['email']; ?></h4>
        <form enctype="multipart/form-data"action="mettreAJourProfile.php" method="POST">
        <div class="form-group">
<?php
$maConn = openconnection();
if ($utilisateur['statut'] == "eleve"){
    $idClasseUtilisateur = "";
    echo "<label for=\"classe\">Sélectionnez une classe</label>";
    $sql = "select idClasse from personne where id=".$utilisateur['id'];
    $resultClasseUtilisateur = mysqli_query($maConn,$sql) or die("recherche de la clase de l'utilisateur en erreur");
    if ($lineClasseUtilisateur =  mysqli_fetch_assoc($resultClasseUtilisateur)){
        $idClasseUtilisateur = $lineClasseUtilisateur['idClasse'];
        //echo "la classe de l'utilisateur est ".$idClasseUtilisateur;
    }
    echo "<select id=\"classe\" name=\"classe\" class=\"form-control\">";
    $sql="select * from classe order by id";
    $resultClasses = mysqli_query($maConn,$sql) or die("recherche des classes en erreur");
    while ($lineClasses =  mysqli_fetch_assoc($resultClasses)){
        echo "<option value=".$lineClasses['id'];
        if (!empty($idClasseUtilisateur) && $idClasseUtilisateur == $lineClasses['id']){
            echo " selected "; 
        }
        echo ">".$lineClasses['nom']."</option>";
    }
    echo "</select>";
 }
?>
        </div>    
            <div class="form-group">
                <label for="userfile">Image à uploader</label>
                <input type="file" name="userfile" class="form-control" id="userfile" aria-describedby="userImage" >
                <small id="userFileHelp" class="form-text text-muted">Cette image sera votre avatar</small>
            </div>
            <button type="button" class="btn btn-secondary" onclick="reset()">Remettre à zero</button>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
<?php
    $utilisateurId = $_SESSION['utilisateur']['id'];
    //TODO verifier qu'il n'y a pas déjà une note pour ce QCM et cet élève
    $sql = "select urlImage from personne where id=".$utilisateurId;
    //echo $sql;
    $result = mysqli_query($maConn,$sql) or die("recherche de l'avatar en erreur");
    if ($line = mysqli_fetch_assoc($result)){
        $urlImage = $line['urlImage'];
        if (isset($urlImage) && !empty($urlImage)){
            echo "<img src=\"".$urlImage."\" class=\"img-fluid\" alt=\"Avatar\" />";
        }

    }
    fermerConnection($result, $maConn)
?>
    </div>
    <script>
        function reset(){
            var fileInput = document.getElementById("userfile");
            fileInput.value = "";
        }
    </script>
<?php
        afficheFin();
    }
?>