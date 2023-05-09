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
        $password = $_POST['inputPassword'];

        
        $query = "select * from utente where username = $1 and email = $2";
        $result = pg_query_params($dbconn, $query, array($username,$email));
        
        if (!($line = pg_fetch_array($result))) {
            echo "Non sembra che tu sia registrato,
            </h1>
            <a href=../signin/registrazione.html> Clicca qui per farlo! </a>
            </br>
            Oppure, se pensi di aver sbagliato qualcosa, prova di nuovo il
            <a href=login.html>login</a>";

        }

        else {
            /* $q2 = "select * from utente where username = $1 and email = $2 and pswd = $3";
            $result = pg_query_params($dbconn, $q2, array($username,$email,$password)); */
            $hash = $line['pswd'];

            if (password_verify($password,$hash)) {

                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $email;

                echo "Benvenuto ".$username."!!! Accedi al tuo
                <a href = ../profilo/paginaprofilo.php>profilo!</a>";
                
            }

            else {
                echo "<h1> La password è sbagliata! </h1>
                <a href=login.html> Clicca qui per riprovare </a>";
               
            }


        }


    }

    ?>
    
</body>
</html>