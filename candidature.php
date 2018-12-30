
<!-- OBJECTIFS -->
<!-- Afficher les 5 derniers tickets  -->

<!DOCTYPE html >
<html>
	<head>
		<?= include('link.html') ?>
		<title>CERVEAU COLLECTIF AFRICAIN</title>
	</head>

	<body>
		<div class="banner">
			<h1>CERVEAU COLLECTIF AFRICAIN</h1>
			<h3>Developper vos idées, entourer vous des meilleurs, réaliser vos projets.</h3>
			
		</div>
		<em><a class="btn btn-danger" href="index.php" >Retour à la liste</a></em>
		<?php 

		include('dbconnect.php');

		$db = dbConnect();

		// Recupere le ticket 
		$ticket =  $db -> prepare('SELECT id, author, title, content, DATE_FORMAT(created_at, \'%d/%m/%y à %Hh%imin%ss\') As ticket_date FROM tickets WHERE id= ?');

		$ticket -> execute(array($_GET['ticket']));

		$ticket_data = $ticket -> fetch()

		?>
			<div class="ticket">
                <h3>
                    <?= htmlspecialchars($ticket_data['author']) ?>
                    <em>le <?= $ticket_data['ticket_date'] ?></em>
                </h3>
                
                <p>

                   <strong><?= nl2br(htmlspecialchars($ticket_data['content'])) ?></strong><br>    
                </p>
            </div>

            <hr>
		<?php

		$ticket -> closeCursor(); // on libere le curseur pour la prochaine requete

		// on recupere les candidatures associées au ticket
		$resp = $db -> prepare('SELECT ticket_id, author, qualifications, experiences, DATE_FORMAT(date_disponibilité, \'%d/%m/%y\') As candidature_date FROM candidatures WHERE ticket_id= ?');


		$resp -> execute(array($_GET['ticket']));

		$data = $resp -> fetch()
		
			?>
            <div class="candidatures">
            	<h2 style="background-color: black; color: white;">Candidatures</h2>
                <h3>
                    <?= htmlspecialchars($data['author']) ?>
                    <em>le <?= $data['candidature_date'] ?></em>
                </h3>
                
                <p>
                    <strong><?= 'Qualifications : ' . nl2br(htmlspecialchars($data['qualifications'])) ?></strong><br>
                    <strong><?= 'Experiences : ' . htmlspecialchars($data['experiences']) ?></strong><br><br>    
                </p>
            </div>
        <?php
        $resp -> closeCursor();
		?>
		
		<hr>

		<h3><input class= "btn btn-primary" type="button" onClick="bascule('boite');" value="Postuler" href></h3>

		
		<?= include('form.php') ?>
		
		<script type="text/javascript" src="form.js">
			
		</script>
	</body>
</html>
