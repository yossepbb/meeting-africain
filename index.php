
<!-- OBJECTIFS -->
<!-- Afficher les 5 derniers tickets  -->

<!DOCTYPE html >
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>CERVEAU COLLECTIF AFRICAIN</title>
	</head>

	<body>
		<div class="banner">
			<h1>CERVEAU COLLECTIF AFRICAIN</h1>
			<h3>Developper vos idées, entourer vous des meilleurs, réaliser vos projets.</h3>
			<h5>Derniers tickets du projet:</h5>
		</div>
		
		<?php 

			//connexion à la base de donées
		try{

			$db = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
		}

		catch(Exception $e)
		{
			die('Error:' . $e -> getMessage());
		}

		// Recupere les entrées de tickets et on les affiche

		$resp = $db -> query('SELECT id, author, title, content, category, location, nbre_personne, DATE_FORMAT(created_at, \'%d/%m/%y à %Hh%imin%ss\') As ticket_date FROM tickets ORDER BY id DESC LIMIT 0, 5');

		while ($data = $resp -> fetch())
		{
			?>
            <div class="tickets">
                <h3>
                    <?= htmlspecialchars($data['author']) ?>
                    <em>le <?= $data['ticket_date'] ?></em>
                </h3>
                
                <p>
                    <strong><?= 'Category : ' . nl2br(htmlspecialchars($data['category'])) ?></strong><br>
                    <strong><?= 'Location : ' . nl2br(htmlspecialchars($data['location'])) ?></strong><br>
                    <strong><?= ' How many person : ' . nl2br(htmlspecialchars($data['nbre_personne'])) ?></strong><br><br>
                    <?= nl2br(htmlspecialchars($data['content'])) ?>
                    <br />
                    <em><a href="candidature.php?ticket=<?php echo $data['id']; ?>">Postuler</a></em>
                </p>
            </div>
        <?php

		}

		$resp -> closeCursor();


		?>
	</body>
</html>
