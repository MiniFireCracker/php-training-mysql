<?php
/*
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
*/
      require'db_connection.php';

if( isset($_POST) && (!empty($_POST))){
		var_dump($_POST);

		$informUser= null;

		$users= $pdo->query('SELECT * FROM user;');
		var_dump($users);

		foreach( $users as $user){
			if($user['mail'] == $_POST['mail']){
				return $informUser= "L'email que vous avez entré est déjà utilisé. Veuillez vérifier que vous n'avez pas déjà de compte.";
			}}//}else{

				$stmt= $pdo->prepare('INSERT INTO user(lastname, firstname, mail, password )VALUES(:lastname, :firstname, :mail, :password) ;');

				$stmt->execute([ 'lastname' => $_POST['lastname'], 'firstname' => $_POST['firstname'], 'mail'=> $_POST['mail'], 'password'=> password_hash($_POST['password'], PASSWORD_DEFAULT) ]);

				$informUser= "Félicitation. Votre compte a bien été crée";
			//}
		//}
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
	<h1>Créer un compte</h1>
	<form action="/register.php" method="post">
		<div>
			<label for="firstname">Prénom: </label>
			<input type="text" name="firstname" required>
		</div>
		<div>
			<label for="lastname">Nom: </label>
			<input type="text" name="lastname" required>
		</div>
		<div>
			<label for="mail">Mail: </label>
			<input type="email" name="mail" required>
		</div>

		<div>
			<label for="password">Mot de passe: </label>
			<input type="password" name="password" required>
		</div>
		
		<button type="submit" name="button">Envoyer</button>
	</form>
	<a href="login.php">Se connecter</a>
	<?= $informUser ?>
</body>
</html>