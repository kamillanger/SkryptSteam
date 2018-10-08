<?php

	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');											// Wysłanie użytkownika spowrotem do index.php, jeśli nie wpisał loginu, bądź hasła
		exit();
	}

  $servername = "localhost";
  $login = "root";
  $pass = "";
  $db = "steamadv";
  $conn = new mysqli ($servername, $login, $pass, $db);

	if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];						// Pobranie loginu i hasła z formumlarza
    $haslo2 = md5($haslo);							// Zhashowanie hasła

    $sql = "SELECT * FROM users WHERE login='$login' AND haslo='$haslo2'";   // Pobranie użytkownika i jego hasła z bazy danych
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['zalogowany'] = true;			// Ustawienie informacji o tym, że użytkownik jest zalogowany
              while($row = $result->fetch_assoc()) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['login'] = $row['login'];

                unset($_SESSION['blad']);
                $result->free_result();

                if ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'wyswietl') {
                header('Location: wyswietl.php');																// Jeśli użytkownik to admin, bądź wyświetl, wysyła go do wyswietl.php
              } elseif ($_SESSION['login'] == 'aktualizacja') {
                header('Location: Aktual.php');																	// Jeśli użytkownik to aktualizacja, wysyła go do Aktual.php
              }
              }
              } else {
                $_SESSION['blad'] = 'Nieprawidłowy login lub hasło!';
                header('Location: index.php');															// Jeśli w bazie danych nie ma użytkownika o takich loginie, bądź haśle, wysłanie go spowrotem do index.php
      }



		$conn->close();
	}

?>
