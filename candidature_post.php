<?php 

	include('dbconnect.php');
	// ici on recupere les données saisies par users
		$db = dbConnect();
		$id = $_GET['ticket'];
			$author = $_POST['author'];
			$qualifications = $_POST['qualifications'];
			$experiences = $_POST['experiences'];
	?>

	<div name="boite" id="boite" style="">

			<form action="candidature_post.php" method="post">
				<div>
					<label style="vertical-align: top;" for="author">Nom et Prénom: </label><br>
					<input type="text" name="author">
				</div>
				<div>
					<label style="vertical-align: top;" for="qualifications">Qualifications:</label><br>
					<input type="text" name="qualifications"><br>
				</div>

				<div>
					<label style="vertical-align: top;" for="experiences">Experiences:</label><br>
					<input type="text" name="experiences"><br>
				</div>

				<div>
					<label style="vertical-align: top;" for="date_disponibilité">date de disponibilite:</label><br>
					<input type="date" name="date_disponibilité"><br>
				</div>

				<div>
					<button  class="btn btn-primary" type="submit" >Envoyer</button>
				</div>
			</form>
		</div>

	<?php 

	// on verifie que les champs ont bien ete remplis
			
			echo "<br>  id=" . $id . "<br>  " .$author."<br>  ".$qualifications."<br>  ".$experiences."<br>  ";
			
			// $db -> prepare('INSERT INTO candidatures (ticket_id, author, qualifications, experiences)
			// 			VALUES (:ticket_id, :author, :qualifications, :experiences)');
			// // on execute la requete
			// $insert = $db -> execute(array(
			// 						'ticket_id' => $_GET['ticket'],
			// 						'author' => $_POST['author'],
			// 						'qualifications' => $_POST['qualifications'],
			// 						'experiences' => $_POST['experiences']));

	
	// on verifie les injections sql et html
	// on redirige vers la page des candidatures.





?>