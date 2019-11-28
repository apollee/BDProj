<html>
    <head>
        <title>Registar incidências</title>
        <link rel="stylesheet" href="item.css">
    </head>
    <body>
    <h1>Listagem:</h1>
    <table>
        <tr>
            <th>Id de anomalia</th>
        </tr>
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

                        
                        $sql = "SELECT anom.id FROM item as it, anomalia as anom, incidencia as inc 
                                WHERE it.id  = inc.item_id and  inc.anomalia_id = anom.id and
                                        it.latitude < ($latitude + $dx) and it.latitude > ($latitude - $dx) and
                                        it.longitude < ($longitude + $dy) and it.longitude > $longitude - $dy and
                                        anom.ts < now() and anom.ts > now() - interval '3 months';";
                        
                        $result = $db->prepare($sql);

                        $result->execute();

                        foreach($result as $row){
                                echo("<tr>\n");
                                echo("<td>{$row['id']}</td>\n");
                                echo("<tr>\n");
                        }
                        echo("</table>");


                        $db = null;
                }
                catch (PDOException $e){
                        $caught = true;
                        echo("<p>ERROR: {$e->getMessage()}</p>");
                }
                if($caught){
                        echo("<h1>Falha na listagem.</h1>");
                }
      ?>
       <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
    </body>
</html>