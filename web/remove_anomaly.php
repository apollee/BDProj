<html>
    <head>
        <title>Remover item</title>
        <link rel="stylesheet" href="users.css">
        <!--usa-se este por ser igual-->
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Escolha o item para remover:</h1>
        <table id="item_information">
            <tr>
                <th>ID</th>
                <th>Zona</th>           
                <th>Descrição</th>
            </tr>
        <?php
            $host = "db.ist.utl.pt";
            $user = "ist190334";
            $password = "123456789";
            $dbname = $user;

            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $sql = "SELECT id, zona, descricao FROM anomalia;";

            $result = $db->prepare($sql);

            $result->execute();

            foreach($result as $row){
                echo("<tr>\n");
                echo("<td>{$row['id']}</td>\n");
                echo("<td>{$row['zona']}</td>\n");
                echo("<td>{$row['descricao']}</td>\n");
                echo("<tr>\n");
            }

        ?>
        </table>
        <div>
            <form id="form_remove_anomaly" action="remove_anomaly_final.php" method="post">
                <h2>ID:</h2>
                <input name='id_anomalia' type='text'>
                <button onclick="location.href='main.html'" type="button">Cancelar</button>
                <input type="submit" value="Submeter">
            </form>
        </div>
    </body>
</html>