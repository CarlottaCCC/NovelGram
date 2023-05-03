<?php
$dbconn = pg_connect("host=localhost user=username password=password 
port=5432 dbname=novelgram")
or die('Errore di connessione: ' . pg_last_error());

$username = $_GET['username'];

$query = "select *
           from utente where username = $1";
$result = pg_query_params($dbconn,$query,array($username));

if ($line = pg_fetch_array($result)) {

echo "<table>";
echo "<tr>";
echo "<td>" . $line['descrizione'] . "</td>";
echo "</tr>";
echo "</table>";
}

else {
    echo "non ho trovato niente";
}



?>