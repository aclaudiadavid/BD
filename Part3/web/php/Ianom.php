<!DOCTYPE html>
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

        $id = $_POST['id'];
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $x2 = $_POST['x2'];
        $y2 = $_POST['y2'];
        $box = "($x1, $y1),($x2, $y2)";
        $img = $_POST['img'];
        $ling = $_POST['ling'];
        $ano = $_POST['ano'];
        $mes = $_POST['mes'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $min = $_POST['min'];
        $seg = $_POST['seg'];
        $dt = "$ano-$mes-$dia $hora:$min:$seg";
        $desc = $_POST['desc'];

        if ($img == '') {
            $img = "null";
        } else {
            $img = "'$img'";
        }

        if ($ling == '') {
            $ling = "null";
        } else {
            $ling = "'$ling'";
        }



        if ($desc == '') {
            $desc = "null";
        } else {
            $desc = "'$desc'";
        }



        $sql = "insert into anomalia values ($id, '$box', '$img', '$ling', '$dt', '$desc', B'1');";

        $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

        $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
        pg_close($connection);

        echo("<p>Added Anomaly $id with success.</p>");
        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");
?>
</body>
</html>