<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}

error_reporting(E_ALL);
include_once('libs/simple_html_dom.php');

$servername = "localhost";
$login = "root";
$pass = "";
$db = "steamadv";
$conn = new mysqli ($servername, $login, $pass, $db);  // Połączenie z bazą danych
$conn->query("SET CHARSET utf8");  // Ustawienie polskiego kodowania w bazie danych
$nazwa_tabeli = "SteamGry1";
$time = date("H:i:s");
$poz = 1;
$poz2 = 0;
$tytulz[3] = "";
for ($x = 1; $x <= 25; $x++) {
  $html = file_get_html("https://store.steampowered.com/search/results?filter=globaltopsellers&snr=1_7_7_globaltopsellers_7&page=$x");

  foreach($html->find('span.title') as $title) {
    $tytul = substr($title,20,-7);
    $tytul2 = str_replace("'", "''", "$tytul");   // Pobranie tytułu i zapisanie go do tablicy
    if ($tytul2 == "House Flipper" || $tytul2 == "RimWorld" || $tytul2 == "Beat Saber" || $tytul2 == "BATTLETECH") {
      $tytulz[$poz2] = $tytul2;
      $pozycja[$poz2] = $poz;
      $strona[$poz2] = $x;
      if ($tytul2 == "House Flipper") {
        $id[$poz2] = 613100;
      } elseif ($tytul2 == "RimWorld") {
        $id[$poz2] = 294100;
      } elseif ($tytul2 == "Beat Saber") {
        $id[$poz2] = 620980;
      } elseif ($tytul2 == "BATTLETECH") {
        $id[$poz2] = 637090;
      }
      $poz2++;

    }
    $poz++;
  }
  if ($tytulz[3] == "House Flipper" || $tytulz[3] == "RimWorld" || $tytulz[3] == "Beat Saber" || $tytulz[3] == "BATTLETECH") {
    break;				// Po zebraniu wszystkich informacji następuje przerwanie pętli
  }
  }
  for ($r = 0; $r <= 3; $r++) {
  $sql = "UPDATE $nazwa_tabeli SET Pozycja='$pozycja[$r]', Strona='$strona[$r]', Czas_Odczytu='$time' WHERE AppId='$id[$r]'";		// Zaktualizowanie danych tabeli
  $result = $conn->query($sql);
  }

  $sql = "SELECT * FROM SteamGry1 WHERE AppId='613100' OR AppId='294100' OR AppId='620980' OR AppId='637090'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['Czas_Odczytu']."</td><td>".$row['Tytul']."</td><td>".$row['Pozycja']."</td><td>".$row['Strona']."</td>";				// Zaktualizowanie danych na stronie
                echo "</tr>";
            }
    }
?>
