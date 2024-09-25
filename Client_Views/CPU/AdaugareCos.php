<?php
session_start();

// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "computercorner";

$conn = new mysqli($servername, $username, $password, $database);

// Verifică conexiunea
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Preia client_id din sesiune
$client_id = $_SESSION['client_id'];

// Preia ID-ul produsului din query string
if (isset($_GET['id'])) {
    $produs_id = $_GET['id'];
    $produs_tip = 'CPU';
    $cantitate = 1;

    // Inserarea în baza de date
    $stmt = $conn->prepare("INSERT INTO Cos (client_id, produs_id, produs_tip, cantitate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $client_id, $produs_id, $produs_tip, $cantitate);

    if ($stmt->execute()) {
        echo "Produsul a fost adăugat în coș cu succes!";
    } else {
        echo "Eroare la adăugarea produsului: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID-ul produsului nu este specificat!";
}

$conn->close();

// Redirecționează utilizatorul înapoi la lista de produse
header("Location: Client_CPU_tab.php");
exit;
?>
