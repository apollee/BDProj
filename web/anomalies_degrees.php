<!DOCTYPE html>
<html>
    <head>
        <title>Listar anomalias</title>
        <link rel="stylesheet" href="anomalies_places.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Insira o max e o min da latitude e longitude dos locais:</h1>
        <form id="form_insert_places" action="degrees_final.php" method="post">
        
        <h3>Min latitude</h3>
        <input style="margin-right: 1%" type="text" name="min_latitude"></input>
        <h3>Max latitude</h3>
        <input type="text" name="max_latitude"></input><br>
        <h3>Min longitude</h3>
        <input style="margin-right: 1%" type="text" name="min_longitude"></input>
        <h3>Max longitude</h3>
        <input type="text" name="max_longitude"></input>

        <div>
            <button onclick="location.href='main.html'" type="button">Cancelar</button>
            <input type="submit" value="Submeter">
        </div>
        </form>
    </body>
</html>