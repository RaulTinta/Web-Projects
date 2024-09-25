<?php
    session_start(); // Asigură-te că sesiunea este pornită

    // Verifică dacă utilizatorul este autentificat și are drepturi de admin
    if (!isset($_SESSION['user_drepturi']) || $_SESSION['user_drepturi'] != 'admin') {
        header("Location: ../../Autentificare/Login_tab.html");
        session_unset(); // Elimină toate variabilele de sesiune
        session_destroy(); // Distrugerea sesiunii
        exit;
    }
?>