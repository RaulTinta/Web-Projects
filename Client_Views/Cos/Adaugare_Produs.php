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

// Verifică parametrii necesari
if (!isset($_GET['id']) || !isset($_GET['type'])) {
    echo "Date insuficiente pentru a efectua operația.";
    exit;
}

$produs_id = $_GET['id'];
$produs_tip = $_GET['type'];
$client_id = $_SESSION['client_id'];

// Incrementează cantitatea produsului în coș
$update_query = "UPDATE Cos SET cantitate = cantitate + 1 WHERE client_id = ? AND produs_id = ? AND produs_tip = ?";
$update_stmt = $conn->prepare($update_query);
$update_stmt->bind_param("iis", $client_id, $produs_id, $produs_tip);

if ($update_stmt->execute()) {
    echo "Cantitatea a fost incrementată.";
} else {
    echo "Eroare la adăugarea produsului: " . $update_stmt->error;
}

$update_stmt->close();
$conn->close();

// Redirecționează utilizatorul înapoi la lista de produse
header("Location: Client_Cos_tab.php");
exit;
?>
