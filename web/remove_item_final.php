<html>
      <head>
            <title>Remover item</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $id = $_REQUEST['id_item'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "DELETE FROM item WHERE id = $id;";

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
                  echo("<h1>Removida item com sucesso!</h1>");
            }else{
                  echo("<h1>A remoção do item falhou.</h1>");
            }
      ?>
       <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
      </body>
</html>