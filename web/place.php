<html>
    <head>
        <title>Inserir local</title>
        <link rel="stylesheet" href="place.css">
    </head>
    <body>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Inserir local:</h1>
        <form id="form_insert_place" action="insert_place.php" method="post">
            <h3>Latitude</h3>
            <input type="text" name="latitude_local"></input><br>
            <h3>Longitude</h3>
            <input type="text" name="longitude_local"></input><br>
            <h3>Nome</h3>
            <input type="text" name="nome_local"></input><br>
            <div>
                <button onclick="location.href='main.html'" type="button">Cancelar</button>
                <input type="submit" value="Submeter">
            </div>
        </form>
    </body>
</html>