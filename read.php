<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>

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

    $stmt = $pdo->query('SELECT * FROM hiking');
      ?>

    <h1>Liste des randonnées</h1>
    <table>
      <thead>
        <tr>
        <th>id</th>
        <th>nom</th>
        <th>difficulté</th>
        <th>distance</th>
        <th>durée</th>
        <th>dénivelé</th>
        <th>action</th>
        </tr>
      </thead>
      <tbody>
      <!-- Afficher la liste des randonnées -->
      <?php while($hikingTracks = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
        <tr>
        <td><?=$hikingTracks['id'] ?></td>
        <td><?=$hikingTracks['name'] ?></td>
        <td><?=$hikingTracks['difficulty'] ?></td>
        <td><?=$hikingTracks['distance'] ?> km</td>
        <td><?=$hikingTracks['duration'] ?></td>
        <td><?=$hikingTracks['height_difference'] ?> m </td> 
        <td><a href="/update.php?id=<?= $hikingTracks['id'] ?>"> Modifier </a></td>
        </tr>         
      <?php } ?>
    </tbody>
  </table>
  <p>Vous connaissez un autre chemin de randonnée qui n'est pas encore répertorié ? </p>
  <p>N'hesitez pas à enrichir notre base de donnée...</p>
  <a href="/create.php"> Ajouter une randonnée</a>
  </body>
</html>
