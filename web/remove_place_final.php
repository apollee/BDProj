<html>
      <head>
            <title>Item Inserido</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            try {
                  $latitude = $_REQUEST['latitude_local'];
                  $longitude = $_REQUEST['longitude_local'];

                  echo("<h1>$latitude</h1>");
                  echo("<h1>$longitude</h1>");

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "DELETE FROM local_publico WHERE latitude = $latitude and longitude = $longitude;";

                  $result = $db->prepare($sql);

                  $result->execute();

                  $db = null;
            }
            catch (PDOException $e){
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
      ?>
      </body>
</html>