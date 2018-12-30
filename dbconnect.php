<?php 

	function dbConnect()
	{
		//connexion à la base de donées
		try{

			$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
		}

		catch(Exception $e)
		{
			die('Error:' . $e -> getMessage());
		}


		return $bdd;
	}

 ?>