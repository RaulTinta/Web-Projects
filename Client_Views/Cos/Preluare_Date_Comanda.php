<?php

// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$client_id = $_SESSION['client_id'];

// Interogare pentru detalii client
$client_query = "SELECT nume, prenume, telefon FROM Users WHERE id = ?";
$stmt = $conn->prepare($client_query);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $nume_prenume = $row['nume'] . " " . $row['prenume'];
    $telefon = $row['telefon'];
} else {
    $nume_prenume = "";
    $telefon = "";
}
$stmt->close();
$conn->close();
?>