<?php
    require_once("../functions/mysql/database.php");
    require_once("../functions/presentation/html.php");
    require_once("../functions/presentation/navbar.php");
    require_once("retournerQcm.php");
    require_once("retournerEleve.php");

    session_start();
    $utilisateur = $_SESSION['utilisateur'];
    if (isset($utilisateur) && !empty($utilisateur) && $utilisateur['statut'] == "professeur"){
        afficheEntete($utilisateur['nom']);
        headerProfesseur($utilisateur);
        $lesEleves = retourneEleves();
        //var_dump($lesEleves);
        $lesQcm = retourneQcms();
?>
<div class="container-fluid">
	<div class="row flex-xl-nowrap mt-2">
        <div class="col-12 col-md-3 col-xl-2">
            <form method="post" action="gererNotes.php">
              <div class="form-group">
                <label for="selectEleve">Choix de l'élève</label>
                <select class="form-control" id="selectEleve" name="selectEleve">
                    <option value="">Neant</option>
                	<?php 
                	foreach ($lesEleves as $eleve){
                	    echo "<option value=".$eleve['id'].">".$eleve['email']."</option>";
                	}
                	?>
                </select>
              </div>
              <div class="form-group">
                <label for="selectQcm">Choix d'un QCM</label>
                <select class="form-control" id="selectQcm" name="selectQcm">
                    <option value="">Neant</option>
                	<?php 
                	foreach ($lesQcm as $qcm){
                	    echo "<option value=".$qcm['id'].">".$qcm['libelle']."</option>";
                	}
                	?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
		</div>
		<div class="col-12 col-md-6 col-xl-10">
		<?php
		$maConn = openconnection();
		$sql = "select p.nom as nom, qcm.id as qcmid, qcm.libelle as libelle, n.note as note, n.id as id, n.publie as publie from personne p, qcm qcm, notes n ";
        $sql .= "where n.idPersonne = p.id and n.idQcm = qcm.id";
        if (isset($_POST["selectEleve"]) && !empty($_POST["selectEleve"])){
            $eleveId = $_POST["selectEleve"];
            $sql .= " and p.id = ".$eleveId;
        }
        if (isset($_POST["selectQcm"]) && !empty($_POST["selectQcm"])){
            $qcmId = $_POST["selectQcm"];
            $sql .= " and qcm.id = ".$qcmId;
        }
		//echo "$sql";
		$result = mysqli_query($maConn,$sql) or die("requete lecture notes en erreur");
		echo "<ul class=\"list-group\">";
		while ($line = mysqli_fetch_assoc($result)){
            $sqlCount = "select count(idQuestion) as count from questionqcm where idQcm=".$line['qcmid'];
            $resultCount = mysqli_query($maConn,$sqlCount) or die("requete comptage questions en erreur");
            if ($lineCount = mysqli_fetch_assoc($resultCount)){
                $nbeQuestions = $lineCount['count'];
                $msgPublication = $line['publie'] == 1?"publié":"non publié"; 
		        echo "<li class=\"list-group-item\"><a href=\"#\" id=".$line['id']." class=\"openModal\">".$line['libelle']." (eléve:".$line['nom']."). Note: ".$line['note']."/".$nbeQuestions." ".$msgPublication."</li>";
 echo "<div class=\"modal fade\" data-backdrop=\"backdrop\" id=\"exampleModal".$line['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">";
?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" action="updateNote.php">
      <div class="modal-body">
      <?php 
        echo "<div class=\"form-group\">";
        echo "<label for=\"publierElement\">Publier Note</label>";
        echo "<input type=\"checkbox\" id=\"publierElement\" name=\"publication\"";
        $pub = $line['publie'] == 1?"checked":""; 
        echo " ".$pub." />";
        echo "<input type=\"hidden\" name=\"nodeId\" value=".$line['id']." />";
        echo "</div>";
       ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<?php        }
            mysqli_free_result($resultCount);
        }
		echo "</ul>";
		fermerConnection($result, $maConn);
        ?>
		</div>
	</div> <!-- fin du Row -->
</div> <!-- fin du Container -->
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery/jquery-3.6.0.js"></script>
    <script src="../js/bootstrap/bootstrap.js"></script>
    <script>
        $('.openModal').on('click', function(e){
        console.log("lmsqkdqmlkdqmldk:"+ e.target.id);
        var id = e.target.id;
        $('#exampleModal'+id).modal('show');
        //e.preventDefault();
        });
    </script>
  </body>
</html>
<?php
}
?>