<?php
function headerProfesseur($utilisateur){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Professeur</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost/qcmcnam/profiles/gererProfile.php"><i class="fas fa-user"></i>&nbsp;<?php echo $utilisateur['nom'];?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/qcmcnam/themes/gererThemes.php">Themes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/qcmcnam/questions/gererQuestions.php">Questions Réponses</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          QCM
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="http://localhost/qcmcnam/qcm/creerqcm.php">Créer un QCM</a>
          <a class="dropdown-item" href="http://localhost/qcmcnam/qcm/publishqcm.php">Publier un QCM</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarNotesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Notes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarNotesDropdown">
          <a class="dropdown-item" href="http://localhost/qcmcnam/notes/gererNotes.php">Gérer Notes</a>
        </div>
      </li>    
    </ul>
    <form class="form-inline my-2 my-lg-0" action="../logout.php">
        <button type="submit" class="btn btn-default btn-sm">
        <i class="fas fa-sign-out-alt"></i> Log out
        </button>
    </form>
  </div>
</nav>

<?php
}

function headerEleve($utilisateur){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Eleve</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost/qcmcnam/profiles/gererProfile.php"><i class="fas fa-user"></i>&nbsp;<?php echo $utilisateur['nom'];?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/qcmcnam/qcmeleve/choixqcm.php">QCM</a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/qcmcnam/notes/consulterNotes.php">Notes</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="../logout.php">
        <button type="submit" class="btn btn-default btn-sm">
        <i class="fas fa-sign-out-alt"></i> Log out
        </button>
    </form>
  </div>
</nav>

<?php
}
?>