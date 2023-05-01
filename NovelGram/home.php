<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

    <!-- <div class="card"> -->
        <a href="/profilo/paginaprofilo.php">Vai al tuo profilo</a>
        <a href="/login/login.html">Accedi!</a>
        <a href="/signin/registrazione.html">Non hai un account? Iscriviti!</a>
        <br/>
        <form class="cercaAutore" method = "POST" action = "ricerca/ricercaAutore.php">
            <input type="text" class="search_autore" placeholder="Cerca Autore" name = "InputAutore">
            <button>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" 
                height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg"><path d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z"></path></svg>
            </button>
        </form>
            

            <br>

            <form class="cercaTitolo" method = "POST" action = "ricerca/ricercaTitolo.php">

            <input type="text" class="search_titolo" placeholder="Cerca Titolo" name = "InputTitolo" >
            <button>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" 
                height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg"><path d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z"></path></svg>

            </button>
            </form>
            

        <br>
        <br>
        <br>
        <br>

        <h1>Storie pubblicate su NovelGram</h1>

        <br>
        <br>
        <br>
        <br>

        <?php

        session_start();

              $dbconn = pg_connect("host=localhost user=username password=password 
              port=5432 dbname=novelgram")
              or die('Errore di connessione: ' . pg_last_error());


                $query = "select l.titolo,l.testo,l.trama,l.mipiace,l.email,u.username
                from libro l join utente u on l.email = u.email";
                $result = pg_query($dbconn,$query);


               while ($line = pg_fetch_array($result)) : 
               $titolo = $line["titolo"]; ?>

              


        <div class="card-body">
              <p class="card-text"><?php echo "<a href='Librogenerico/libro.php?titolo=$titolo'>".$titolo."</a>"; ?></p>
              <div class="d-flex justify-content-between align-items-center">
              <form class="btn-group" method = "POST" action = "Librogenerico/libro.php">
               </form>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#55595c"></rect>
            <text y = 10% fill="#eceeef" dy=".3em"><?php echo $line["trama"]; ?></text>
            </svg>

      <?php 
       endwhile; 
       pg_close($dbconn); 
       ?>

       
        
    <!-- </div> -->


    
</body>
</html>