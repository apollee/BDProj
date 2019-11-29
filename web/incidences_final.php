<html>
      <head>
            <title>Registar incidências</title>
            <link rel="stylesheet" href="item.css">
      </head>
      <body>
      <?php
            $caught = false;
            try {
                  $id_anomalia = $_REQUEST['id_anomalia'];
                  $id_item = $_REQUEST['id_item'];
                  $email = $_REQUEST['email_incidencia'];

                  $host = "db.ist.utl.pt";
                  $user = "ist190334";
                  $password = "123456789";
                  $dbname = $user;

                  $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  
                  $sql = "INSERT into incidencia (anomalia_id, item_id, email) values (?, ?, ?);";

                  $result = $db->prepare($sql);

                  $result->execute([$id_anomalia, $id_item, $email]);

                  $db = null;
            }
            catch (PDOException $e){
                  $caught = true;
            }
            if(!$caught){
                  echo("<h1>Registada a incidência com sucesso!</h1>");
            }else{
                  echo("<h1>O registo da incidência falhou.</h1>");
            }
      ?>
       <div>
            <button onclick="location.href='main.html'" type="button" id="home">Home</button>
      </div>
      </body>
</html>