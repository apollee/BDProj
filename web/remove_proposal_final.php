<html>
      <head>
            <title>Remover proposta</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $email = $_REQUEST['email'];
                  $nro = $_REQUEST['nro'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $db->beginTransaction();
                  
                  $sql = "DELETE FROM proposta_de_correcao WHERE email = ? and nro = ?;";

                  $result = $db->prepare($sql);

                  $result->execute([$email, $nro]);

                  if($result->rowCount() == 0){
                    $caught = true;
                  }

                  $db->commit();

                  $db = null;
            }
            catch (PDOException $e){
                  $caught = true;
                  echo("<p>ERROR: {$e->getMessage()}</p>");
                  $db->rollBack();
            }
            if(!$caught){
                  echo("<h1>Removida proposta com sucesso!</h1>");
            }else{
                  echo("<h1>A remoção da proposta falhou.</h1>");
            }
      ?>
       <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
      </body>
</html>