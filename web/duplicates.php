<!DOCTYPE html>
<html>
    <head>
        <title>Registar duplicados</title>
        <link rel="stylesheet" href="anomalies_places.css">
        <!--usa o css do anomalies_degrees pois sao exatamente iguais-->
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Registe os items que são duplicados um do outro:</h1>
        <form id="form_insert_duplicates" action="duplicates_final.php" method="post">
            <h3>Item 1</h3>
        <?php
            $host = "db.ist.utl.pt";
            $user = "ist190334";
            $password = "123456789";
            $dbname = $user;

            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id FROM item;";

        $result = $db->prepare($sql);

        $result->execute();

        echo("<select  name='item1'>");
        foreach($result as $row){
            echo("<option value='{$row['id']}'>{$row['id']}</option>");
        }
        echo("</select>");

        $result = $db->prepare($sql);

        $result->execute();

        echo("<h3>Item 2</h3>");
        echo("<select name='item2'>");
        foreach($result as $row){
            echo("<option value='{$row['id']}'>{$row['id']}</option>");
        }
        echo("</select>");
        ?>
        <div style="margin-top: 5%">
            <button onclick="location.href='main.html'" type="button">Cancelar</button>
            <input type="submit" value="Registar">
        </div>
        </form>
    </body>
</html>