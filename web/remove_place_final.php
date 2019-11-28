<html>
      <head>
            <title>Remover local</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            $caugh = false;
            try {
                  $latitude = $_REQUEST['latitude_local'];
                  $longitude = $_REQUEST['longitude_local'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  
                  $sql = "DELETE FROM local_publico WHERE latitude = $latitude and longitude = $longitude;";

                  $result = $db->prepare($sql);

                  $result->execute();

                  if($result->rowCount() == 0){
                        $caught = true;
                  }
                  $db = null;

            }
            catch (PDOException $e){
                  $caught = true;
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            if(!$caught){
                  echo("<h1>Removido local com sucesso!</h1>");
            }else{
                  echo("<h1>A remoção do local falhou.</h1>");
            }
      ?>
      <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
      </body>
</html>