<?php
    require_once("../functions/mysql/database.php");
    //var_dump($_POST);
    $publie = 0;
    if (isset($_POST['publication']) && !empty($_POST['publication']) && $_POST['publication'] == 'on'){
        $publie = 1;
    }
    $idNote = $_POST['nodeId'];
    $maConn = openconnection();
    $sql = "update notes set publie=".$publie." where id=".$idNote;
    $result = mysqli_query($maConn,$sql) or die("requete mise à jour note en erreur");
    
    //TODO envoyer un mail si publié
    if ($publie == 1){
        $sql = 'select p.email as email, n.note as note, q.libelle as titreQcm, q.id as qcmid from personne p, qcm q, notes n where n.idQcm = q.id and n.idPersonne = p.id and n.id='.$idNote;
        $result = mysqli_query($maConn,$sql) or die("paramètres mail note en erreur");
        if($line = mysqli_fetch_assoc($result)){
            $sqlCount = "select count(idQuestion) as count from questionqcm where idQcm=".$line['qcmid'];
            $resultCount = mysqli_query($maConn,$sqlCount) or die("requete comptage questions en erreur");
            if ($lineCount = mysqli_fetch_assoc($resultCount)){
                $nbeQuestions = $lineCount['count'];
                $note = $line['note']."/".$nbeQuestions;
                $destinataire = $line['email'];
                $titreQcm = $line['titreQcm'];
                $to      = $destinataire;
                $subject = 'le résultat de votre QCM';
                $message = 'Pour votre QCM '.$titreQcm.'\r\n';
                $message = 'vous avez obtenu la note de '.$note.' pour le QCM: '.$titreQcm;
                $headers = 'From: jpm@jpmena.eu' . "\r\n" .
                'Reply-To: jpm@jpmena.eu' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);
            }
        }
    }
    fermerConnection($result, $maConn);
    header('Location:http://localhost/qcmcnam/notes/gererNotes.php');
?>