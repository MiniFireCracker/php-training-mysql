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
      var_dump($_GET);

      $stmt= $pdo->prepare("SELECT * FROM hiking WHERE id=? ; ");
      $stmt->execute([ $_GET['id'] ]);
    //  while($selectedTrack = $stmt->fetch(PDO::FETCH_ASSOC)){
    //  	var_dump($selectedTrack) ;
    //  }

	$selectedTrack= $stmt->fetch();


	$msgForUser=null;

	if(isset($_POST) && (!empty($_POST))){
		var_dump($_POST);

		/*
		$stmt= $pdo->prepare("UPDATE hiking SET name=? , difficulty=? , distance=?, duration=?, height_difference=? WHERE id=? ;");
		$stmt->execute([ $_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'], $_GET['id'] ]);
		*/
		
	$stmt= $pdo->prepare('UPDATE hiking SET name =:name,
					 difficulty =:difficulty,
					 distance =:distance,
					 duration=:duration,
					 height_difference =:height_difference
					 WHERE id =:id ;');

		if( !$stmt->execute([ ':name'=>$_POST['name'],
						 ':difficulty'=>$_POST['difficulty'],
						 ':distance'=>$_POST['distance'], 
						 ':duration'=>$_POST['duration'],
						 ':height_difference'=>$_POST['height_difference'],
						 ':id'=>$_GET['id'] 
					   ]))
		{
      		print_r( $stmt->errorInfo() );
      	};
  
		//}else{
		//	header('Location: /update.php');};


/*
		////////////////////           version stack //////////////////

$stmt= $pdo->prepare('UPDATE hiking SET name =? ,
					 difficulty =? ,
					 distance =? ,
					 duration=? ,
					 height_difference =?
					 WHERE id =?');

$stmt->bindParam($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'], $_GET['id'] );
$stmt->execute();
/*


		
		/*
		$stmt= $pdo->prepare('UPDATE hiking SET name = :name , difficulty = :difficulty , distance = :distance , duration= :duration , height_difference = :height_difference WHERE id = :id ;');

		$stmt->bindParam(':name', $_POST['name']);
		$stmt->bindParam(':difficulty', $_POST['difficulty']);
		$stmt->bindParam(':distance', $_POST['distance']);
		$stmt->bindParam(':duration', $_POST['duration']);
		$stmt->bindParam(':height_difference', $_POST['height_difference']);
		$stmt->bindParam(':id', $_GET['id']);

		$stmt->execute();
		*/

		$msgForUser= "Merci! Les détails de la randonée ont bien été modifiés";

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

	<h1>Modifier</h1>
	<form action="/update.php?id=<?= $_GET['id'] ?>" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?= $selectedTrack['name'] ?>" >
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value='<?= $selectedTrack['difficulty']?>' selected='selected'> <?= $selectedTrack['difficulty'] ?> </option>
				<?php $possibleOptionValue=["très facile", "facile", "moyen","difficile","très difficile"];
					function findAllValuesExceptTheOneInUse($val){
						return $val !== $selectedTrack['difficulty'];
					}

					$otherValues= array_filter($possibleOptionValue, findAllValuesExceptTheOneInUse);
					print_r($otherValues);

					foreach($otherValues as $otherValue):
				 ?>
				 <option value=<?= $otherValue ?> > <?= $otherValue  ?> </option>
				

				<?php endforeach; ?>
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
<?php

}else{
	header('Location: /login.php');

}

?>