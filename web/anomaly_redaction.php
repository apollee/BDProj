<!DOCTYPE html>
<html>
    <head>
        <title>Inserir anomalia de redação</title>
        <link rel="stylesheet" href="anomaly.css">
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,300" rel="stylesheet" type="text/css" /> 
        <h1>Inserir anomalia de redação:</h1>
        <form id="form_insert_anomaly" action="insert_anomaly_redaction.php" method="post">
            <h3>Zona</h3>
            <input type="text" name="zona_anomalia"></input><br>
            <h3>Língua</h3>
            <input type="text" name="lingua_anomalia"></input><br>
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