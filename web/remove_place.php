<html>
    <head>
        <title>Remover local</title>
        <link rel="stylesheet" href="users.css">
        <!--usa-se este por ser igual-->
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Escolha o local para remover:</h1>
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
        <div>
            <button onclick="location.href='main.html'" type="button">Cancelar</button>
            <input type="submit" value="Submeter">
        </div>
    </body>
</html>