<?php
session_start();

session_destroy();              // Zniszczenie sesji, następnie wysłanie użytkownika do index.php

header('Location: index.php');
 ?>
