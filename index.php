<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/signin.css">
</head>
<body class="text-center">
    <?php
        if (isset($_GET['error']) && !empty($_GET['error'])) {
            $typeErreur = $_GET['error'];
            echo "<div class=\"alert alert-danger\">";
            echo "<strong>Erreur!</strong>";
            if($typeErreur == "incorrect"){
                echo "adresse mail ou mot de passe incorrect";
            } elseif ($typeErreur == "vide") {
                echo "veuillez entrer une adresse mail ou un mot de passe non vide";
            }
            echo "</div>";
        }
    ?>
    <form class="form-signin" method="POST" action="authentification.php">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Authentifiez vous!</h1>
        <label for="inputEmail" class="sr-only">adresse E-Mail</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="adresse E-Mail" required autofocus>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="mot de passe" required>
        <!--<div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        </div>-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Authentification</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
</body>
</html>