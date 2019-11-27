<!DOCTYPE html>
<html>
    <head>
        <title>Listar anomalias</title>
        <link rel="stylesheet" href="anomalies_places.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Insira a latitude e a longitude dos locais:</h1>
        <form id="form_insert_places" action="places_final.php" method="post">
        <table id="place_information">
            <tr>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Nome</th>
            </tr>
        
            <?php
                $host = "db.ist.utl.pt";
                $user = "ist190334";
                $password = "123456789";
                $dbname = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $sql = "SELECT latitude, longitude, nome FROM local_publico;";

                $result = $db->prepare($sql);

                $result->execute();

                foreach($result as $row){
                    echo("<tr>\n");
                    echo("<td>{$row['latitude']}</td>\n");
                    echo("<td>{$row['longitude']}</td>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("<tr>\n");
                }

            ?>
        </table>
        <h3>Latitude local 1</h3>
        <input style="margin-right: 1%" type="text" name="latitude1"></input>
        <h3>Longitude local 1</h3>
        <input type="text" name="longitude1"></input><br>
        <h3>Latitude local 2</h3>
        <input style="margin-right: 1%" type="text" name="latitude2"></input>
        <h3>Longitude local 2</h3>
        <input type="text" name="longitude2"></input>

        <div>
            <button onclick="location.href='main.html'" type="button">Cancelar</button>
            <input type="submit" value="Submeter">
        </div>
        </form>
    </body>
</html>