<html>
    <head>
        <title>Remover item</title>
        <link rel="stylesheet" href="users.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Insira o id do item para remover:</h1>
        <table id="item_information">
            <tr>
                <th>ID</th>
                <th>Localização</th>           
                <th>Descrição</th>
            </tr>
        <?php
            $host = "db.ist.utl.pt";
            $user = "ist190334";
            $password = "123456789";
            $dbname = $user;

            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $sql = "SELECT id, localizacao, descricao FROM item;";
            
            $result = $db->prepare($sql);
            $result->execute();

            foreach($result as $row){
                echo("<tr>\n");
                echo("<td>{$row['id']}</td>\n");
                echo("<td>{$row['localizacao']}</td>\n");
                echo("<td>{$row['descricao']}</td>\n");
                echo("<tr>\n");
            }

        ?>
        </table>
        <div>
            <form id="form_remove_item" action="remove_item_final.php" method="post">
                <h3>ID:</h3>
                <input name='id_item' type='text'>
                <div>
                    <button onclick="location.href='main.html'" type="button">Cancelar</button>
                    <input type="submit" value="Submeter">
                </div>
            </form>
        </div>
    </body>
</html>