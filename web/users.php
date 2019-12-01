<html>
    <head>
        <title>Utilizadores</title>
        <link rel="stylesheet" href="users.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css"/> 
        <h1>Utilizadores:</h1>
        <table id="">
            <tr>
                <th>Email</th>
            </tr>
        <?php
            try {
                $host = "db.ist.utl.pt";
                $user = "ist190334";
                $password = "123456789";
                $dbname = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $sql = "SELECT email FROM utilizador;";

                $result = $db->prepare($sql);

                $result->execute();

                foreach($result as $row){
                    echo("<tr>\n");
                    echo("<td>{$row['email']}</td>\n");
                    echo("<tr>\n");
                }

                $db = null;
            }
            catch (PDOExeception $e){
                echo("<h1>A listagem de utilizadores falhou.</h1>");
            }
        ?>
        </table>
        <div>
        <button onclick="location.href='main.html'" type="button" id="home">Home</button>
        </div>
    </body>
</html>