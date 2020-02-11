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
        $x3 = $_POST['x3'];
        $y3 = $_POST['y3'];
        $x4 = $_POST['x4'];
        $y4 = $_POST['y4'];
        $box = "($x1, $y1),($x2, $y2)";
        $box2 = "($x3, $y3),($x4, $y4)";
        $img = $_POST['img'];
        $ling = $_POST['ling'];
        $ling2 = $_POST['ling2'];
        $ano = $_POST['ano'];
        $mes = $_POST['mes'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $min = $_POST['min'];
        $seg = $_POST['seg'];
        $dt = "$ano-$mes-$dia $hora:$min:$seg";
        $desc = $_POST['desc'];

        if ($img == "") {
            $img = "null";
        } else {
            $img = "'$img'";
        }

        $fail = True;
        if ($ling == $ling2) {
            $fail = False;
        }

        if ($ling == "") {
            $ling = "null";

            if ($ling2 == "") {
                $ling2 = "null";
            } else {
                $ling2 = "'$ling2'";
            }
        } else {
            $ling = "'$ling'";

            if ($ling2 == "") {
                $ling2 = "null";
            } else {
                $ling2 = "'$ling2'";
            }
        }

        if ($desc == "") {
            $desc = "null";
        } else {
            $desc = "'$desc'";
        }

        if ($ano == "" or strpos($dt,"--")!==false or strpos($dt,"- ")!==false or strpos($dt," :")!==false or strpos($dt,"::")!==false or $seg == "") {
            $dt = "null";
        } else {
            $dt = "'$dt'";
        }

        if($x1=="" or $y1=="" or $x2=="" or $y2=="" and $fail) {
            $box = "null";

            if($x3=="" or $y3=="" or $x4=="" or $y4=="") {
                $box2 = "null";
            } else {
                $box2 = "'$box2'";
            }

            $sql = "insert into anomalia values ($id, $box, $img, $ling, $dt, $desc, B'0');";

            $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

            $sql2 = "insert into anomaliatraducao values ($id, $box2, $ling2);";
            $result2 = pg_query($sql2) or die('ERROR: ' . pg_last_error());

            $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
            $result2 = pg_free_result($result2) or die('ERROR: ' . pg_last_error());

            echo("<p>Added Traduction Anomaly $id with success.</p>");

        } else {
            $box = "'$box'";

            if($x3=="" or $y3=="" or $x4=="" or $y4=="" and $fail) {
                $box2 = "null";

                $sql = "insert into anomalia values ($id, $box, $img, $ling, $dt, $desc, B'0');";

                $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

                $sql2 = "insert into anomaliatraducao values ($id, $box2, $ling2);";
                $result2 = pg_query($sql2) or die('ERROR: ' . pg_last_error());

                $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
                $result2 = pg_free_result($result2) or die('ERROR: ' . pg_last_error());

                echo("<p>Added Traduction Anomaly $id with success.</p>");
            } else {

                if("($x1,$y1)" != "($x3,$y3)" and "($x1,$y1)" != "($x4,$y4)" and "($x2,$y2)" != "($x3,$y3)" and "($x2,$y2)" != "($x4,$y4)" and $fail) {
                    $box = "'$box'";
                    $box2 = "'$box2'";

                    $sql = "insert into anomalia values ($id, $box, $img, $ling, $dt, $desc, B'0');";

                    $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

                    $sql2 = "insert into anomaliatraducao values ($id, $box2, $ling2);";
                    $result2 = pg_query($sql2) or die('ERROR: ' . pg_last_error());

                    $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
                    $result2 = pg_free_result($result2) or die('ERROR: ' . pg_last_error());

                    echo("<p>Added Traduction Anomaly $id with success.</p>");
                } else {
                    $box = "null";
                    $box2 = "null";

                    echo("<p>There was an error in the form</p>");
                }
            }
        }
        pg_close($connection);

        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");

?>
</body>
</html>