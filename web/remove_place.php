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
            <form id="form_remove_place" action="remove_place_final.php" method="post">
                <h2>Latitude:</h2>
                <input name='latitude_local' type='text'>
                <h2>Longitude:</h2>
                <input name='longitude_local' type="text">
                <button onclick="location.href='main.html'" type="button">Cancelar</button>
                <input type="submit" value="Submeter">
            </form>
        </div>
    </body>
</html>