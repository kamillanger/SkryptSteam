<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
  if ($_SESSION['login'] == 'wyswietl') {
    $_SESSION['Komunikat'] = 'Nie masz uprawnień do wyświetlenia tych danych';					// Jeśli użytkownik to Wyswietl, ustawienie komunikatu, następnie wysłanie go spowrotem do Aktual.php
    header('Location: wyswietl.php');
  }
  if (isset($_SESSION['Komunikat'])) {
    echo "<script> alert('".$_SESSION['Komunikat']."')</script>";				// Wyświetlenie komunikatu dla użytkownika bez uprawnień
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

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- BootStrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  </head>
  <body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
              <li>
                  <a href="Index.php">Wyświetl Gry</a>
              </li>
              <li>
                  <a href="Wyswietl.php">Zaktualizuj Gry</a>
              </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">
              <div class='text-right'>
                <?php
                echo "Witaj: ".$_SESSION['login']."<br>";
                echo "<a href='logout.php'>[Wyloguj się]</a>";
                 ?>
               </div>
                <div class='jumbotron p-2 pb-4'>
              <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
              <h1 class='text-center'> Zadanie Rekrutacyjne </h1>
            </div>
            <div class='text-dark bg-secondary'>
              <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Czas Odczytu
                    </th>
                    <th class="th-sm">Tytul
                    </th>
                    <th class="th-sm">Pozycja
                    </th>
                    <th class="th-sm">Strona
                    </th>
                  </tr>
                </thead>
                <tbody id="zawartosc">
              <?php
              $servername = "localhost";
              $login = "root";
              $pass = "";
              $db = "steamadv";
              $conn = new mysqli ($servername, $login, $pass, $db);  // Połączenie z bazą danych
              if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
              }
              $conn->query("SET CHARSET utf8");
              $sql = "SELECT * FROM SteamGry1 WHERE AppId='613100' OR AppId='294100' OR AppId='620980' OR AppId='637090'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['Czas_Odczytu']."</td><td>".$row['Tytul']."</td><td>".$row['Pozycja']."</td><td>".$row['Strona']."</td>";
                            echo "</tr>";
                        }
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Czas Odczytu
                  </th>
                  <th>Tytul
                  </th>
                  <th>Pozycja
                  </th>
                  <th>Strona
                  </th>
                </tr>
              </tfoot>
            </table>
            <div class='text-center'>
              <button id='dane'>Zaktualizuj Dane</button>
              <div class='text-muted'>
              <font size='1'>(Zajmuje ~7sek)</font>
              </div>
          </div>
              </div>
            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

      </body>
      <script>
      $(document).ready(function(){
        $("#dane").click(function(){
          $("#zawartosc").load("aktu2.php");
        });
        });


      $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
      </script>

</html>
