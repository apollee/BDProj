<html>
    <head>
        <title>Escolher proposta</title>
        <link rel="stylesheet" href="users.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Escolher proposta:</h1>
        <table>
            <tr>
                <th>Email</th>
                <th>Nro</th>
                <th>Texto</th>
            </tr>
            <?php
                session_start();
                $host = "db.ist.utl.pt";
                $user = "ist190334";
                $password = "123456789";
                $dbname = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT email, nro, texto FROM proposta_de_correcao;";

                $result = $db->prepare($sql);
                $result->execute();

                foreach($result as $row){
                    echo("<tr>\n");
                    echo("<td>{$row['email']}</td>\n");
                    echo("<td>{$row['nro']}</td>\n");
                    echo("<td>{$row['texto']}</td>\n");
                    echo("<tr>\n");
                }
                echo("</select>");

                $db = null;
                
            ?>
        </table>
        <div>
            <form id="form_choose_proposal" action="edit_proposal.php" method="post">
                <div>
                    <h3>Email:</h3>
                    <input name='email' type='text'>
                    <h3>Nro:</h3>
                    <input name='nro' type="text">
                </div>
                <div>
                    <button onclick="location.href='main.html'" type="button">Cancelar</button>
                    <input type="submit" value="Submeter">
                </div>
            </form>
</html>