<!DOCTYPE html>
<html>
    <head>
        <title>Listar anomalias</title>
        <link rel="stylesheet" href="anomalies_places.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Insira a latitude e a longitude dos locais e o dx e o dy:</h1>
        <form id="form_insert_degrees" action="degrees_final.php" method="post">
        
        <h3>Latitude</h3>
        <input style="margin-right: 1%" type="text" name="latitude"></input>
        <h3>Longitude</h3>
        <input type="text" name="longitude"></input><br>
        <h3>Dx</h3>
        <input style="margin-right: 1%" type="text" name="dx"></input>
        <h3>Dy</h3>
        <input type="text" name="dy"></input>

        <div>
            <button onclick="location.href='main.html'" type="button">Cancelar</button>
            <input type="submit" value="Submeter">
        </div>
        </form>
    </body>
</html>