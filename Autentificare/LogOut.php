<?php
session_start(); // Asigură-te că sesiunea este inițiată
session_unset(); // Elimină toate variabilele de sesiune
session_destroy(); // Distrugerea sesiunii

header("Location: ../Home_tab.html"); // Redirecționează utilizatorul către pagina de home
exit();
?>
