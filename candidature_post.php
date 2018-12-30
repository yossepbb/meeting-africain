<?php 

	// ici on recupere les données saisies par users
		try{

			$db = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
		}

		catch(Exception $e)
		{
			die('Error:' . $e -> getMessage());
		}


	// on verifie que les champs ont bien ete remplis
		if ( isset($_POST['author']) AND isset($_POST['qualifications']) AND isset($_POST['experiences']) AND isset($_POST['date_disponibilité']))
		{
				
			// on prepare la requete
			$insert = $db -> prepare('INSERT INTO candidatures
									(author, qualifications)
									VALUES(:author, :qualifications)
								');
		
			// on execute la requete
		
			$insert -> execute(array(
							'author' => $_POST['author'],
							'qualifications' => $_POST['qualifications']
							
							));
		}

	// on verifie les injections sql et html
	// on redirige vers la page des candidatures.





?>