<?php
session_start ();

if (isset($_SESSION['mail']) && isset($_SESSION['firstname'])) {

      $databaseName= 'reunion_island';
      $serverName= 'localhost';
      $userName= 'root';
      $password= 'root';

      try{
      $pdo= new PDO("mysql:host=" .$serverName . ";dbname=" . $databaseName.";charset=utf8", $userName, $password);
      }
      catch(PDOException $e){
        echo "Failed to establish connection" . $e->getMessage();
      }

	$msgForUser=null;

	if(isset($_POST) && (!empty($_POST))){
		var_dump($_POST);

	/*	$stmt= $pdo->prepare("INSERT INTO hiking(name, difficulty, distance, duration, height_difference)VALUES(?, ?, ?, ?, ?) ;");
		$stmt->execute([ $_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'] ]);
	*/
		$stmt= $pdo->prepare('INSERT INTO hiking(name, difficulty, distance, duration, height_difference)VALUES(:name, :difficulty, :distance, :duration, :height_difference) ;');
		$stmt->execute([ 'name' => $_POST['name'], 'difficulty' => $_POST['difficulty'], 'distance'=> $_POST['distance'], 'duration'=> $_POST['duration'], 'height_difference'=> $_POST['height_difference'] ]);

		$msgForUser= "Merci! Grace à vous nous pouvons maintenant proposer à nos utilisateurs une nouvelle randonnée";

	}else{
		$msgForUser= "Formulaire incomplet. Veuillez remplir tous les champs.";
	}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/read.php">Liste des données</a>
	<a href="/logout.php">Se déconnecter </a>

	<h1>Ajouter</h1>
	<form action="/create.php" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée (pour 2 heures présenter comme suit: 02:00:00) </label>
			<input type="duration" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<?php if($msgForUser != null):  ?>
	<div><?= $msgForUser ?></div>
	<?php endif; ?>
</body>
</html>

<?php

}else{
	header('Location: /login.php');

}

?>