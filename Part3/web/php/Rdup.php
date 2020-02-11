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

        $id1 = $_POST['id1'];
        $id2 = $_POST['id2'];

        $sql1 = "select * from item where iditem=$id1";
        $sql2 = "select * from item where iditem=$id2";

        $result = pg_query($sql1) or die('ERROR: ' . pg_last_error());
        $result2 = pg_query($sql2) or die('ERROR: ' . pg_last_error());        

        while($row = pg_fetch_assoc($result) and $row2 = pg_fetch_assoc($result2)) {
            $lat = $row['latitude'];
            $long = $row['longitude'];
            $desc = $row['descricao'];
            $loc = $row['localizacao'];
            $desct = "$desc";
            $loct = "$loc";
            
            $lat2 = $row2['latitude'];
            $long2 = $row2['longitude'];
            $desc2 = $row2['descricao'];
            $loc2 = $row2['localizacao'];
            $desct2 = "$desc2";
            $loct2 = "$loc2";
        }

        if($id1 != $id2 and $lat == $lat2 and $long == $long2 and $desct==$desct2 and $loct==$loct2) {
            $sql3 = "insert into duplicado values ($id1,$id2);";
            $result3 = pg_query($sql3) or die('ERROR: ' . pg_last_error());

            $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
            $result2 = pg_free_result($result2) or die('ERROR: ' . pg_last_error());
            $result3 = pg_free_result($result3) or die('ERROR: ' . pg_last_error());
        } else {
            echo("<p>There was an error in the form</p>");
        }

        pg_close($connection);

        echo("<p>Registed $id2 as duplicated of $id1 with success.</p>");
        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");
    ?>
</body>
</html>