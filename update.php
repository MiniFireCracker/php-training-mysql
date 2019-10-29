<?php

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
      var_dump($_GET);

      $stmt= $pdo->prepare("SELECT * FROM hiking WHERE id= :id; ");
      $stmt->execute([ 'id'=> $_GET['id'] ]);
    //  while($selectedTrack = $stmt->fetch(PDO::FETCH_ASSOC)){
    //  	var_dump($selectedTrack) ;
    //  }

	$selectedTrack= $stmt->fetch();


	$msgForUser=null;

	if(isset($_POST) && (!empty($_POST))){
		var_dump($_POST);

		$stmt= $pdo->prepare('UPDATE hiking SET name= :name, difficulty= :difficulty, distance= :difficulty, duration= :duration, height_difference= :height_difference WHERE id= $_GET["id"];');
		$stmt->execute([ 'name' => $_POST['name'], 'difficulty' => $_POST['difficulty'], 'distance'=> $_POST['distance'], 'duration'=> $_POST['duration'], 'height_difference'=> $_POST['height_difference'] ]);

		$msgForUser= "Merci! La route a bien été modifiée";

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
	<h1>Modifier</h1>
	<form action="/update.php?id=<?= $_GET['id'] ?>" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?= $selectedTrack['name'] ?>" >
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value='<?= $selectedTrack['distance']?>' selected='selected'> <?= $selectedTrack['difficulty'] ?> </option>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?= $selectedTrack['distance'] ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?= $selectedTrack['duration'] ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?= $selectedTrack['height_difference'] ?>">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<?php if($msgForUser != null):  ?>
	<div><?= $msgForUser ?></div>
	<?php endif; ?>
</body>
</html>
