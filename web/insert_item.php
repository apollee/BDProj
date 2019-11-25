<html>
      <head>
            <title>Item Inserido</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            try {
                  $localizacao = $_REQUEST['localizacao_item'];
                  $latitude = $_REQUEST['latitude_item'];
                  $longitude = $_REQUEST['longitude_item'];
                  $descricao = $_REQUEST['descricao_item'];

                  echo("<h1>$localizacao</h1>");
                  echo("<h1>$latitude</h1>");
                  echo("<h1>$longitude</h1>");
                  echo("<h1>$descricao</h1>");

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "INSERT into item (id, localizacao, latitude, longitude, descricao) values ( 24, ?, ?, ?, ?);";

                  $result = $db->prepare($sql);

                  $result->execute([$localizacao, $latitude, $longitude, $descricao]);

                  $db = null;
            }
            catch (PDOException $e){
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
      ?>
      </body>
</html>