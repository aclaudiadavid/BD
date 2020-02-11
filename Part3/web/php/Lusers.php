<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

        $sql = "SELECT * FROM utilizador;";

        $result = pg_query($sql) or die('ERROR: ' . pg_last_error());

        // Prints result
        echo('<table>');
        while($row = pg_fetch_assoc($result)) {
            echo("<tr><td>");
            echo($row["email"]);
            echo("</td><td>");
            //echo($row["password"]);
            echo("</td>");
        }
        echo('</table>');

        $result = pg_free_result($result) or die('ERROR: ' . pg_last_error());
        pg_close($connection);
        
        echo("<form><input type=\"button\" onclick=\"history.go(-2)\" value=\"Voltar\"></form>");
    ?>
</body>
</html>