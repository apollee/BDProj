<html>
      <head>
            <title>Inserir proposta</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $email = $_REQUEST['email_proposal'];
                  $anomaly = $_REQUEST['anomaly'];
                  $text = $_REQUEST['text'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $db->beginTransaction();

                  $sql = "SELECT count(email) from proposta_de_correcao where email = ? group by email;";

                  $result1 = $db->prepare($sql);
                  $result1->execute([$email]);
                  $nro = (int) $result1->fetch(PDO::FETCH_ASSOC) + 1;
                  echo $nro;

                  $data_hora = new DateTime();
                  $data_final = $data_hora->format('Y-m-d H:i:s');
                  $sql = "INSERT into proposta_de_correcao(email, nro, data_hora, texto) values (?, ?, ?, ?);";
                  $result = $db->prepare($sql);
                  $result->execute([$email, $nro, $data_final, $text]);
                  
                  $sql = "INSERT into correcao(email, nro, anomalia_id) values (?, ?, ?);";
                  $result = $db->prepare($sql);
                  $result->execute([$email, $nro, $anomaly]);

                  $db->commit();

                  $db = null;
            }
            catch (PDOException $e){
                  $caught = true;
                  echo("<p>ERROR: {$e->getMessage()}</p>");
                  $db->rollBack();
            }
            if(!$caught){
                  echo("<h1>Inserida proposta com sucesso!</h1>");
            }else{
                  echo("<h1>A inserção da proposta falhou.</h1>");
            }
      ?>
      <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
      </body>
</html>