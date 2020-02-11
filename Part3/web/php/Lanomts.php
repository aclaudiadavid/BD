<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BD - Proj3</title>
</head>
<body>
    <?php 
        $user="ist190733";
        $host="db.ist.utl.pt";
        $port=5432;
        $password="obeo6629";
        $dbname = $user;    

        $connnection = pg_connect("host=$host port=$port user=$user password=$password dbname=$dbname") or die(pg_last_error());

        echo("<p>Connected to Postgres on $host as user $user on database $dbname.</p>");

        $lat = $_POST['lat'];
        $lon = $_POST['lon'];
        $lat2 = $_POST['lat2'];
        $lon2 = $_POST['lon2'];
        $now = date("Y-m-d 23:59:59", strtotime("now"));
        $three = date("Y-m-d 00:00:00", strtotime("-3 months"));
        $top = $lat+$lat2;
        $bot = $lat-$lat2;
        $left = $lon-$lon2;
        $right = $lon+$lon2;

        $sql = "SELECT Anomalia.idAnomalia, zona, imagem, lingua, ts, descricaoAnom, temAnomaliaRedacao
        FROM Incidencia
            NATURAL JOIN Item
            FULL JOIN Anomalia ON Incidencia.idAnomalia = Anomalia.idAnomalia    
        WHERE ts BETWEEN "$three" AND "$now"
            AND longitude BETWEEN $left AND $right
            AND latitude BETWEEN $bot AND $top;";

        $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

        // Prints result
        echo('<table>');
        echo("<tr><td>");
        echo("id");
        echo("</td><td>");
        echo("zona");
        echo("</td><td>");
        echo("imagem");
        echo("</td><td>");
        echo("lingua");
        echo("</td><td>");
        echo("timestamp");
        echo("</td><td>");
        echo("descricao");
        echo("</td><td>");
        echo("temAnomaliaRedacao");
        echo("</td></tr>");
        while($row = pg_fetch_assoc($result)) {
            echo("<tr><td>");
            echo($row["idAnomalia"]);
            echo("</td><td>");
            echo($row["zona"]);
            echo("</td><td>");
            echo($row["imagem"]);
            echo("</td><td>");
            echo($row["lingua"]);
            echo("</td><td>");
            echo($row["ts"]);
            echo("</td><td>");
            echo($row["descricaoanom"]);
            echo("</td><td>");
            echo($row["temAnomaliaRedacao"]);
            echo("</td></tr>");
        }
        echo('</table>');

        $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
        pg_close($connection);
        
        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");
    ?>
</body>
</html>