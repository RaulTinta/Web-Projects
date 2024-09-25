<?php
session_start();

// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$parola = $_POST['parola'];

// Verifică utilizatorul în baza de date și preia URL-ul dashboard-ului
$stmt = $conn->prepare("
    SELECT u.id, u.parola, u.drepturi, p.url_pagina AS dashboard_url
    FROM Users u
    INNER JOIN Pagini p ON p.drepturi = u.drepturi AND p.nume_pagina = 'Dashboard'
    WHERE u.email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($parola, $row['parola'])) {
        // Parola este corectă, stochează id-ul și drepturile utilizatorului în sesiune
        $_SESSION['client_id'] = $row['id'];
        $_SESSION['user_drepturi'] = $row['drepturi'];

        // Redirectare în funcție de drepturi
        if ($row['drepturi'] === "admin") {
            header("Location: ../Admin_Views/" . $row['dashboard_url']);
        } else if ($row['drepturi'] === "client") {
            header("Location: ../Client_Views/Client_Dashboard_tab.php");
        }
        exit();
    } else {
        echo "Parolă greșită!";
    }
} else {
    echo "Nu există utilizator cu acest email!";
}

$conn->close();
?>
