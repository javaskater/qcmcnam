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
        <a class="nav-link" href="#"><?php echo $utilisateur['nom'];?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="themes/gererThemes.php">Themes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gererQuestions.php">Questions Réponses</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          QCM
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Créer un QCM</a>
          <a class="dropdown-item" href="#">Publier un QCM</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarNotesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Notes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarNotesDropdown">
          <a class="dropdown-item" href="#">Consulter Notes</a>
          <a class="dropdown-item" href="#">Publier une note</a>
        </div>
      </li>    </ul>
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
        <a class="nav-link" href="#"><?php echo $utilisateur['nom'];?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">QCM</a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Notes</a>
      </li>
    </ul>
  </div>
</nav>

<?php
}
?>