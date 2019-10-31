<?php
session_start ();

if (isset($_SESSION['mail']) && isset($_SESSION['firstname'])) {

require'db_connection.php';
 /*     $databaseName= 'reunion_island';
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

      //var_dump($_GET);
      //echo $_GET['id'];

     $stmt = $pdo->prepare('DELETE FROM hiking WHERE id=:id ;');
     	if(!$stmt->execute([ ':id'=>$_GET['id'] ]) )
     	{
      		print_r( $stmt->errorInfo() );
      		//header('Location: /login.php');
     	}
  
	
    // $_GET["id"]        ;header('Location: /read.php');

		else
		{
			header('Location: /read.php');

		}
}else{
	header('Location: /login.php');
}
