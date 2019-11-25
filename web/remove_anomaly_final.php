<html>
      <head>
            <title>Item Inserido</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            try {
                  $id = $_REQUEST['id_anomalia'];

                  echo("<h1>$id</h1>");

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "DELETE FROM anomalia WHERE id = $id;";

                  $result = $db->prepare($sql);

                  $result->execute();

                  $db = null;
            }
            catch (PDOException $e){
                  echo("<p>ERROR: {$e->getMessage()}</p>");
            }
      ?>
      </body>
</html>