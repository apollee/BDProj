<html>
      <head>
            <title>Inserir local</title>
            <link rel="stylesheet" href="place.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $latitude = $_REQUEST['latitude_local'];
                  $longitude = $_REQUEST['longitude_local'];
                  $nome = $_REQUEST['nome_local'];

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
                  $caught = true;
            }
            if(!$caught){
                  echo("<h1>Inserido local com sucesso!</h1>");
            }else{
                  echo("<h1>A inserção do local falhou.</h1>");
            }
      ?>
      <div>
            <button onclick="location.href='main.html'" type="button" id="home">Home</button>
      </div>
      </body>
</html>