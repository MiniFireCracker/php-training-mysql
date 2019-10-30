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

      if( isset($_POST) && (!empty($_POST))){
		var_dump($_POST);

		$informUser= NULL;

		$users= $pdo->query('SELECT * FROM user;');
		var_dump($users);

		foreach( $users as $user){
			if( ($user['mail'] == $_POST['mail']) && ( password_verify($_POST['password'], $user['password'] )) ){
				session_start ();
				$_SESSION['mail'] = $_POST['mail'];
				$_SESSION['firstname'] = $user['firstname'];

				header('Location: /read.php');
			}else{
				$informUser= "Echec. Email ou mot de passe incorrect.";
			}
		}

	  }else{
		$informUser= "Formulaire incomplet. Veuillez remplir tous les champs.";
	       }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>login</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<h1>Login</h1>
	<form action="/login.php" method="post">
		<div>
			<label for="mail">Mail: </label>
			<input type="email" name="mail" >
		</div>

		<div>
			<label for="password">Mot de passe: </label>
			<input type="password" name="password" >
		</div>
		
		<button type="submit" name="button">Envoyer</button>
	</form>
	<a href="register.php">Créer un compte</a>
	<?= $informUser ?>
</body>
</html>