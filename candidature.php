
<!-- OBJECTIFS -->
<!-- Afficher les 5 derniers tickets  -->

<!DOCTYPE html >
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!-- javascript boostrap -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>CERVEAU COLLECTIF AFRICAIN</title>
	</head>

	<body>
		<div class="banner">
			<h1>CERVEAU COLLECTIF AFRICAIN</h1>
			<h3>Developper vos idées, entourer vous des meilleurs, réaliser vos projets.</h3>
			
		</div>
		<em><a class="btn btn-danger" href="index.php" >Retour à la liste</a></em>
		<?php 

			//connexion à la base de donées
		try{

			$db = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
		}

		catch(Exception $e)
		{
			die('Error:' . $e -> getMessage());
		}

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

		<h3><input class= "btn btn-primary" type="button" onClick="bascule('boite');" value="Postuler"></h3>

		

		<div name="boite" id="boite" style="visibility: hidden">

			<form action="candidature_post.php" method="post">
				<div>
					<label style="vertical-align: top;">Nom et Prénom: </label><br>
					<input type="text" name="author">
				</div>
				<div>
					<label style="vertical-align: top;">Qualifications:</label><br>
					<input type="text" name="qualifications"><br>
				</div>

				<div>
					<label style="vertical-align: top;">Experiences:</label><br>
					<input type="text" name="experiences"><br>
				</div>

				<div>
					<label style="vertical-align: top;">date de disponibilite:</label><br>
					<input type="date" name="date_disponibilité"><br>
				</div>

				<div>
					<button  class="btn btn-primary" type="submit" >Envoyer</button>
				</div>
			</form>
		</div>
		
		<script type="text/javascript" >
			
			function bascule(elem)
			{
				// Quel est l'état actuel ?
				etat=document.getElementById(elem).style.visibility;

				if(etat=="hidden")
					{
						document.getElementById(elem).style.visibility="visible";
					}

				else
					{
						document.getElementById(elem).style.visibility="hidden";
					}
			}
		</script>
	</body>
</html>
