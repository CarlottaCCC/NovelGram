<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Storia</title>
</head>
<body>

<a href="../../home.php">Torna alla Home</a>

    <?php
$titolo = $_GET['titolo'];
echo "<form name='myForm' action='EffettuaModifica.php?titolo=$titolo' method='POST'>
<h1>Inserisci la modifica del tuo libro $titolo !</h1>
<div class='form-group'>
  <label for='myfile'>File</label>
  <input type='file' class='form-control' id='myfile' name = 'inputFile' aria-describedby='fileHelp'>
  <small id='fileHelp' class='form-text text-muted'>Ricorda formato Txt!</small>
</div>
<button type='submit' class='btn btn-primary'>Invia!</button>
      </form>";

    ?>
    
</body>
</html>