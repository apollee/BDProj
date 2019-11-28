<html>
    <head>
        <title>Listar anomalias</title>
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
                $latitude1 = $_REQUEST['latitude1'];
                $longitude1 = $_REQUEST['longitude1'];
                $latitude2 = $_REQUEST['latitude2'];
                $longitude2 = $_REQUEST['longitude2'];
        
                $host = "db.ist.utl.pt";
                $user = "ist190334";
                $password = "123456789";
                $dbname = $user;

                if ($latitude1 > $latitude2){
                        $latitude3 = $latitude1;
                        $latitude1 = $latitude2;
                        $latitude2 = $latitude3;
                }

                if ($longitude1 > $longitude2){
                        $longitude3 = $longitude1;
                        $longitude1 = $longitude2;
                        $longitude2 = $longitude3;
                }

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                
                $sql = "SELECT anom.id FROM item as it, anomalia as anom, incidencia as inc
                        WHERE inc.anomalia_id = anom.id and it.id = inc.item_id
                        and it.latitude <= $latitude2 and it.latitude >= $latitude1
                        and it.longitude <= $longitude2 and it.longitude >= $longitude1;";

                $result = $db->prepare($sql);

                $result->execute();

                $db = null;
        }
        catch (PDOException $e){
                $caught = true;
                echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        
        foreach($result as $row){
                echo("<tr>\n");
                echo("<td>{$row['id']}</td>\n");
                echo("<tr>\n");
        }
        echo("</table>");
      ?>
       <div>
            <button onclick="location.href='main.html'" type="button">Home</button>
      </div>
    </body>
</html>