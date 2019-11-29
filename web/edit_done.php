<html>
      <head>
            <title>Editar proposta</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  session_start();
                  $email = $_SESSION['email'];
                  $nro = $_SESSION['nro'];
                  $texto = $_REQUEST['text'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "UPDATE proposta_de_correcao SET texto = ? WHERE email = ? and nro = ?;";

                  $result = $db->prepare($sql);
                  $result->execute([$texto, $email, $nro]);

                  if($result->rowCount() == 0){
                        $caught = true;
                  }

                  $db = null;
            }
            catch (PDOException $e){
                  $caught = true;
            }
            if(!$caught){
                  echo("<h1>Edição feita com sucesso!</h1>");
            }else{
                  echo("<h1>A edição da proposta falhou.</h1>");
            }
      ?>
      <div>
            <button onclick="location.href='main.html'" type="button" id="home">Home</button>
      </div>
      </body>
</html>