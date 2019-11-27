<html>
    <head>
        <title>Editar proposta</title>
        <link rel="stylesheet" href="anomalies_places.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Editar proposta:</h1>
        <form id="form_edit_proposal" action="edit_done.php" method="post">
            <h3 style="display:initial">Texto</h3>
            <textarea name="text" id="description"></textarea></input><br>
            <?php
                session_start();
                $host = "db.ist.utl.pt";
                $user = "ist190334";
                $password = "123456789";
                $dbname = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $_SESSION['email'] = $_POST['email'];
                $_SESSION['nro'] = $_POST['nro'];
            ?>
            <div>
                <button onclick="location.href='main.html'" type="button">Cancelar</button>
                <input type="submit" value="Submeter">
            </div>
        </form>
    </body>
</html>