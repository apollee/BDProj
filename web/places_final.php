<html>
    <head>
        <title>Listar anomalias</title>
        <link rel="stylesheet" href="item.css">
    </head>
    <body>
    <?php
        $caught = false;
        try {
                $latitude = $_REQUEST['latitude'];
                $longitude = $_REQUEST['longitude'];
                $dx = $_REQUEST['dx'];
                $dy = $_REQUEST['dy'];

                $host = "db.ist.utl.pt";
                $user = "ist190334";
                $password = "123456789";
                $dbname = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                
                $sql = "SELECT ;";

                $result = $db->prepare($sql);

                $result->execute();

                $db = null;
        }
        catch (PDOException $e){
                $caught = true;
                echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        if(!$caught){
                echo("<h1>Registada a incidência com sucesso!</h1>");
        }else{
                echo("<h1>O registo da incidência falhou.</h1>");
        }
      ?>
       <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
    </body>
</html>