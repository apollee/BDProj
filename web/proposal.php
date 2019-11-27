<html>
    <head>
        <title>Inserir proposta</title>
        <link rel="stylesheet" href="anomalies_places.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Inserir proposta:</h1>
        <form id="form_insert_item" action="insert_proposal.php" method="post">
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

                echo("<select  name='anomaly'>");
                foreach($result as $row){
                    echo("<option value='{$row['id']}'>{$row['id']}</option>");
                }
                echo("</select>");

                $result = $db->prepare($sql);

                $result->execute();
            ?><br>
            <h3 style="vertical-align:baseline">Email</h3>
            <input style="margin-top: 5%" type="text" name="email_proposal"></input><br>
            <h3 style="display:initial">Texto</h3>
            <textarea name="text" id="description"></textarea></input><br>
            <div>
                <button onclick="location.href='main.html'" type="button">Cancelar</button>
                <input type="submit" value="Submeter">
            </div>
        </form>
    </body>
</html>