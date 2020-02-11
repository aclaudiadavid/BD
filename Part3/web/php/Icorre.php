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

        $email = $_POST['email'];
        $nro = $_POST['nro'];
        $id = $_POST['id'];

        $sql = "insert into correcao values ('$email', $nro, $id);";

        $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

        $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
        pg_close($connection);

        echo("<p>Added Correction $nro of Anomaly $id with success.</p>");
        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");
    ?>
</body>
</html>