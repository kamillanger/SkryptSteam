<?php
error_reporting(E_ALL);
include_once('Strona/libs/simple_html_dom.php');

$servername = "localhost";
$login = "root";
$pass = "";
$db = "steamadv";
$conn = new mysqli ($servername, $login, $pass, $db);  // Połączenie z bazą danych
$conn->query("SET CHARSET utf8");  // Ustawienie polskiego kodowania
$nazwa_tabeli = "SteamGry1";  // Przypisanie nazwy tabeli do zmiennej
$time = date("H:i:s");  // Zapisanie czasu do zmiennej
$appid = 'data-ds-appid';           //  /
$bundleid = 'data-ds-bundleid';     //  |    Przypisanie zmiennych do pobrania ID Aplikacji
$packageid = 'data-ds-packageid';   //  \
$y = 1;


for ($x = 1; $x <= 25; $x++) {
$i = 0;
$o = 0;
$p = 0;
$g = 0;
$html = file_get_html("https://store.steampowered.com/search/results?filter=globaltopsellers&snr=1_7_7_globaltopsellers_7&page=$x");

foreach($html->find('span.title') as $title) {
  $tytul = substr($title,20,-7);
  $tytul2 = str_replace("'", "''", "$tytul");   // Pobranie tytułu i zapisanie go do tablicy
  $tytulz[$i] = $tytul2;
  $i++;
}

foreach($html->find('a') as $link) {
  $link2 = $link->href;
  $linkz[$g] = $link2;    //Pobranie linku do gry i zapisanie go do tablicy
  $g++;
}

foreach ($html->find('a') as $id) {
      if ($id->$packageid > 0){       //
      $idp = $id->$packageid;         //
      $idr[$o] = $idp;                //
      $o++;                           //
    } elseif ($id->$appid != "") {    //
      $idp = $id->$appid;             //   Pobranie id gry i zapisanie go do tablicy
      $idr[$o] = $idp;                //
      $o++;                           //
    } else {                          //
      $idp = $id->$bundleid;          //
      $idr[$o] = $idp;                //
      $o++;
    }
}

foreach ($html->find('div.search_price') as $cena) {
  $cena2 = substr($cena,-23,-22);
if ($cena2 != '1' && $cena2 != '2' && $cena2 != '3' && $cena2 != '4' && $cena2 != '5' && $cena2 != '6' && $cena2 != '7' && $cena2 != '8' && $cena2 != '9' && $cena2 != '0') {     //
  $cena3 = substr($cena,-22,-21);                                                                                                                                                 //
if ($cena3 != '1' && $cena3 != '2' && $cena3 != '3' && $cena3 != '4' && $cena3 != '5' && $cena3 != '6' && $cena3 != '7' && $cena3 != '8' && $cena3 != '9' && $cena3 != '0') {     // Sprawdzenie kosztu gry
  $cena4 = substr($cena,-21,-20);                                                                                                                                                 //
if ($cena4 != '1' && $cena4 != '2' && $cena4 != '3' && $cena4 != '4' && $cena4 != '5' && $cena4 != '6' && $cena4 != '7' && $cena4 != '8' && $cena4 != '9' && $cena4 != '0') {     //
      $cena5 = substr($cena,-20,-13);
      $cenaz[$p] = $cena5;                //
      $p++;                               //
  } else {                                //
    $cena5 = substr($cena,-21,-13);       //
    $cenaz[$p] = $cena5;                  //
    $p++;                                 //  Przycięcie string'a z ceną,
  }                                       //  a następnie zapisanie go
} else {                                  //  do tablicy
  $cena5 = substr($cena,-22,-13);         //
  $cenaz[$p] = $cena5;                    //
  $p++;                                   //
}                                         //
} else {                                  //
  $cena5 = substr($cena,-23,-13);         //
  $cenaz[$p] = $cena5;                    //
  $p++;
}
}
for ($r = 0; $r <= 24; $r++) {                                                                                                                                      //
$sql = "INSERT INTO $nazwa_tabeli (Strona, Tytul, AppId, Cena, Link, Czas_Odczytu) VALUES ('$x', '$tytulz[$r]', '$idr[$r]', '$cenaz[$r]', '$linkz[$r]', '$time')";  // Pętla wysyłająca zapisane dane do tablicy
$result = $conn->query($sql);                                                                                                                                       //

}
}






  ?>
