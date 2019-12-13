<!DOCTYPE html>
<html>
    <head>
        <title>Inserir anomalia de tradução</title>
        <link rel="stylesheet" href="anomaly.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Inserir anomalia de tradução:</h1>
        <form id="form_insert_anomaly_t" action="insert_anomaly_translation.php" method="post">
            <h3>Zona</h3>
            <input type="text" name="zona_anomalia"></input><br>
            <h3>Zona2</h3>
            <input type="text" name="zona_anomalia2"></input><br>
            <h3>Língua</h3>
            <input type="text" name="lingua_anomalia"></input><br>
            <h3>Língua2</h3>
            <input type="text" name="lingua_anomalia2"></input><br>
            <h3>Descrição</h3>
            <textarea name="descricao_anomalia" id="description"></textarea></input><br>
            <h3>Foto</h3>
            <label class="input_file">
                    <input type="file" name="foto_anomalia"/>
                    <p style="display: inline">Escolher foto</p>
            </label><br>
            <div>
                <button onclick="location.href='main.html'" type="button">Cancelar</button>
                <input type="submit" value="Submeter">
            </div>
        </form>
    </body>
</html>