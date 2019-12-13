<html>
      <head>
            <title>Registar duplicados</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $item1 = $_REQUEST['item1'];
                  $item2 = $_REQUEST['item2'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $db->beginTransaction();
                  
                  $sql = "INSERT into duplicado (item1, item2) values (?, ?);";

                  $result = $db->prepare($sql);

                  $result->execute([$item1, $item2]);

                  $db->commit();

                  $db = null;
            }
            catch (PDOException $e){
                  $caught = true;
                  $db->rollBack();
            }
            if(!$caught){
                  echo("<h1>Registados duplicados com sucesso!</h1>");
            }else{
                  echo("<h1>O registo dos duplicados falhou.</h1>");
            }
      ?>
       <div>
            <button onclick="location.href='main.html'" type="button" id="home">Home</button>
      </div>
      </body>
</html>