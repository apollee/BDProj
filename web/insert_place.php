<html>
      <head>
            <title>Local Inserido</title>
            <link rel="stylesheet" href="place.css">
      </head>
      <body>
      <?php
            try {
                  $latitude = $_REQUEST['latitude_local'];
                  $longitude = $_REQUEST['longitude_local'];
                  $nome = $_REQUEST['nome_local'];

                  echo("<h1>$latitude</h1>");
                  echo("<h1>$longitude</h1>");
                  echo("<h1>$nome</h1>");

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "INSERT into local_publico (latitude, longitude, nome) values (?, ?, ?);";

                  $result = $db->prepare($sql);

                  $result->execute([$latitude, $longitude, $nome]);

                  $db = null;
            }
            catch (PDOException $e){
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
      ?>
      </body>
</html>