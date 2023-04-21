<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

$dbconn = pg_connect("host=localhost user=username password=password 
port=5432 dbname=novelgram")
or die('Errore di connessione: ' . pg_last_error());

if ($dbconn) {
$email = $_POST['inputEmail'];
$username = $_POST['inputUserName'];
$pswd = $_POST['inputPassword'];

$q1 = "select * from utente where username = $1 and email != $2";
$result = pg_query_params($dbconn, $q1, array($username,$email));

if ($line = pg_fetch_array($result)) {
    echo "Questo username è già stato usato, </br>
    inventane un'altro e <a href=registrazione.html>riprova!</a>";
}

else {


$query = "select * from utente where username = $1 and email = $2";
$result = pg_query_params($dbconn, $query, array($username,$email));

if ($line = pg_fetch_array($result)) {
    echo "Questo indirizzo email è già stato usato, se sei già registrato clicca
    <a href=../login/login.html>qui</a> per fare login!";
}

else {

    $query2 = "insert into utente values ($1,$2,$3)";
    $data = pg_query_params($dbconn, $query2, array($username,$email,$pswd));
    if ($data) {
        echo "La registrazione è andata a buon fine! <br>
        Clicca <a href=../login/login.html>qui</a> per fare login!";
    }
    else {
        "La registrazione non è andata a buon fine. Prova di nuovo!";
    }

}
}

    pg_close($dbconn);

}

?>
    
</body>
</html>