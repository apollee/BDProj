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

                  $nro = /*e preciso fazer isto*/

                  $data_hora = new DateTime();

                  $sql = "INSERT into proposta_de_correcao(email, nro, data_hora, texto) values (?, ?, $data_hora->getTimestamp(), ?);";

                  $result = $db->prepare($sql);
                  $result->execute([$email, $nro, $text]);

                  $sql = "INSERT into correccao(email, nro, anomalia_id) values (?, ?, ?);";

                  $result = $db->prepare($sql);
                  $result->execute([$email, $nro, $anomalia_id]);

                  $db->commit();

                  $db = null;
            }
            catch (PDOException $e){
                  $caught = true;
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            if(!$caught){
                  echo("<h1>Inserido item com sucesso!</h1>");
            }else{
                  echo("<h1>A inserção do item falhou.</h1>");
            }
      ?>
      <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
      </body>
</html>