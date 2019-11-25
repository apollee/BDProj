<html>
      <head>
            <title>Local Inserido</title>
            <link rel="stylesheet" href="place.css">
      </head>
      <body>
      <?php
            try {
                  $zona = $_REQUEST['zona_anomalia'];
                  $lingua = $_REQUEST['longitude_anomalia'];
                  $ts = $_REQUEST['time_stamp_anomalia'];
                  $descricao = $_REQUEST['descricao_anomalia'];
                  $anomalia_redacao = $_REQUEST['tem_anomalia_redacao'];
                  $foto = $_REQUEST['foto_anomalia'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "INSERT into anomalia (id, zona, lingua, ts, descricao, anomalia_redacao, foto) values (default ,?, ?, ?, ?, ?, ?);";

                  $result = $db->prepare($sql);

                  $result->execute([$zona, $lingua, $ts, $descricao, $anomalia_redacao, $foto]);

                  $db = null;
            }
            catch (PDOException $e){
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
      ?>
      </body>
</html>