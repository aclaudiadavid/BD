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

        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $x2 = $_POST['x2'];
        $y2 = $_POST['y2'];

        if ($x1>$x2) {
            $bigx = $x1;
            $smallx = $x2;
        } else {
            $bigx = $x2;
            $smallx = $x1;
        }

        if ($y1>$y2) {
            $bigy = $y1;
            $smally = $y2;
        } else {
            $bigy = $y2;
            $smally = $y1;
        }

        $sql = "select anomalia.idanomalia, zona, imagem, lingua, ts, descricaoanom, temAnomaliaRedacao from incidencia inner join item on incidencia.iditem = item.iditem full join anomalia on incidencia.idanomalia = anomalia.idanomalia where latitude < $bigx and latitude > $smallx AND longitude < $bigy AND longitude > $smally;";

        $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

        // Prints result
        echo('<table>');
        while($row = pg_fetch_assoc($result)) {
            echo("<tr><td>");
            echo($row["idanomalia"]);
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
            echo($row["temanomaliaredacao"]);
            echo("</td><td>");
        }
        echo('</table>');

        $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
        pg_close($connection);
        
        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");
    ?>
</body>
</html>