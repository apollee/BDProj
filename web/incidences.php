<!DOCTYPE html>
<html>
    <head>
        <title>Registar Incidência</title>
        <link rel="stylesheet" href="anomalies_places.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Complete a informação para registar a incidência:</h1>
        <form id="form_incidences" action="incidences_final.php" method="post">
            <h3>Anomalia</h3>
            <?php
                $host = "db.ist.utl.pt";
                $user = "ist190334";
                $password = "123456789";
                $dbname = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT id FROM anomalia;";

                $result = $db->prepare($sql);

                $result->execute();

                echo("<select name='id_anomalia'>");
                foreach($result as $row){
                    echo("<option value='{$row['id']}'>{$row['id']}</option>");
                }    
                echo("</select>");
                echo("<h3>Item</h3>");

                $sql = "SELECT id FROM item;";

                $result = $db->prepare($sql);

                $result->execute();

                echo("<select  name='id_item'>");
                foreach($result as $row){
                    echo("<option value='{$row['id']}'>{$row['id']}</option>");
                }    
                echo("</select><br>");
            ?>
            <h3 style="vertical-align:baseline">Email do utilizador</h3>
            <input style="margin-top: 5%" type="text" name="email_incidencia"></input><br>
            <div>
                <button onclick="location.href='main.html'" type="button">Cancelar</button>
                <input type="submit" value="Submeter">
            </div>
        </form>
    </body>
</html>