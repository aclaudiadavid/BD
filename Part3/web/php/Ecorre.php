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

        $email = $_POST['email'];
        $nro = $_POST['nro'];
        $id = $_POST['id'];
        $nro_new = $_POST['nronovo'];
        $id_new = $_POST['idnovo'];

        if ($nro_new == "") {
            $nro_new = $nro;
        } else {
            $nro_new = $nro_new;
        }

        if ($id_new == "") {
            $id_new = $id;
        } else {
            $id_new = $id_new;
        }

        $sql = "update correcao set nro=$nro_new, idanomalia=$id_new where email='$email' and nro=$nro and idanomalia=$id;";

        $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

        $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
        pg_close($connection);

        echo("<p>Edited Correction $nro with success.</p>");
        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");
    ?>
</body>
</html>