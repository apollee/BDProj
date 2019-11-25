<html>
      <head>
            <title>Local Inserido</title>
            <link rel="stylesheet" href="place.css">
      </head>
      <body>
      <?php
            try {
                  $zona = $_REQUEST['zona_anomalia'];
                  $lingua = $_REQUEST['lingua_anomalia'];
                  $ts = $_REQUEST['time_stamp_anomalia'];
                  $descricao = $_REQUEST['descricao_anomalia'];
                  $anomalia_redacao = $_REQUEST['tem_anomalia_redacao'];
                  $imagem = $_REQUEST['foto_anomalia'];

                  echo("<p>$anomalia_redacao</p>\n");
                  if($anomalia_redacao != false){
                        $anomalia_redacao = true;
                  }

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "INSERT into anomalia (id, zona, imagem, ts, lingua, descricao, tem_anomalia_redacao) values (default ,?, ?, ?, ?, ?, ?);";

                  $result = $db->prepare($sql);

                  $result->execute([$zona, $imagem, $ts, $lingua, $descricao, $anomalia_redacao]);

                  $db = null;
            }
            catch (PDOException $e){
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
      ?>
      </body>
</html>