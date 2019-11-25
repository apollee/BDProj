<html>
      <head>
            <title>Anomalia Inserida</title>
            <link rel="stylesheet" href="anomaly.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $zona = $_REQUEST['zona_anomalia'];
                  $lingua = $_REQUEST['lingua_anomalia'];
                  $ts = $_REQUEST['time_stamp_anomalia'];
                  $descricao = $_REQUEST['descricao_anomalia'];
                  $anomalia_redacao = $_REQUEST['tem_anomalia_redacao'];
                  $imagem = $_REQUEST['foto_anomalia'];

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
                  $caught = true;
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            if(!$caught){
                  echo("<h1>Inserida anomalia com sucesso!</h1>");
            }else{
                  echo("<h1>A inserção da anomalia falhou.</h1>");
            }
      ?>
      <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
      </body>
</html>