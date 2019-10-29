<?php
/**** Supprimer une randonnée ****/

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

      //var_dump($_GET);
      //echo $_GET['id'];

    $stmt = $pdo->query('DELETE FROM hiking WHERE id= $_GET["id"] ;');
    header('Location: /read.php');

      ?>
