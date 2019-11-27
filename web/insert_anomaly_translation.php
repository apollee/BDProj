<html>
      <head>
            <title>Inserir anomalia</title>
            <link rel="stylesheet" href="anomaly.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $zona = $_REQUEST['zona_anomalia'];
                  $zona2 = $_REQUEST['zona_anomalia2'];
                  $lingua = $_REQUEST['lingua_anomalia'];
                  $lingua2 = $_REQUEST['lingua_anomalia2'];
                  $descricao = $_REQUEST['descricao_anomalia'];
                  $imagem = $_REQUEST['foto_anomalia'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $data_hora = new DateTime();
                  $data_final = $data_hora->format('Y-m-d H:i:s');
                  $sql = "INSERT into anomalia (id, zona, imagem, ts, lingua, descricao, tem_anomalia_redacao) values (default ,?, ?, ?, ?, ?, false);";

                  $result = $db->prepare($sql);
                  
                  $result->execute([$zona, $imagem, $data_final, $lingua, $descricao]);
                  $id = $db->lastInsertId();

                  $sql = "INSERT into anomalia_traducao(id, zona2, lingua2) values ($id , ?, ?);";
                  
                  $result = $db->prepare($sql);

                  $result->execute([$zona2, $lingua2]);

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