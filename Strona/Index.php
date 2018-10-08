<?php

	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))			// Sprawdzenie czy użytkownik jest już zalogowany
	{
		if ($_SESSION['login'] == 'aktualizacja') {			// Jeśli użytkownik to Aktualizacja, wysłanie go do Aktual.php
			header('Location: Aktual.php');
			exit();
		} else {
		header('Location: Wyswietl.php');								// Jeśli jest to jakikolwiek inny użytkownik, wysłanie go do Wyswietl.php
		exit();
	}
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>

    <title>SteamAdv</title>
    <!-- Potrzebne Meta Tagi -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Kamil Langer">

    <!-- BootStrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  </head>
<body id="LoginForm">
<div class="container">
<h1 class="form-heading">Logowanie</h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   </div>
    <form id="Login" action='login.php' method='POST'>
        <div class="form-group">
            <input type="text" class="form-control" name="login" placeholder="Login">				<!-- Formularz logowania   -->
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="haslo" placeholder="Haslo">
        </div>
        <div class="forgot">
        <a href="#" onClick='javascript:przyklad();'>Zapomniałeś loginu i hasła?</a>								<!-- Wywołanie funkcji Przykład() po naciśnięciu na tekst -->
</div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    </div>
</div></div></div>
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];					// Wyświetlenie błędu
?>
<script>
function przyklad() {
  alert('Przykładowe loginy i hasła:\n  admin  admin \n  aktualizacja  aktualizacja \n  wyswietl  wyswietl')			// Wyświetlenie loginów i haseł po kliknięciu przycisku "Zapomniałeś loginu i hasła?"
}
</script>



</body>
</html>
