<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "computercorner";

// Crează conexiunea
$conn = new mysqli($servername, $username, $password, $database);

// Verifică conexiunea
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Colectează datele din formular
$nume = $conn->real_escape_string($_POST['nume']);
$prenume = $conn->real_escape_string($_POST['prenume']);
$email = $conn->real_escape_string($_POST['email']);
$telefon = $conn->real_escape_string($_POST['telefon']);
$parola = $conn->real_escape_string($_POST['parola']);
$parola_hash = password_hash($parola, PASSWORD_DEFAULT);

// Crează și execută interogarea SQL
$sql = "INSERT INTO Users (nume, prenume, email, telefon, parola) VALUES ('$nume', '$prenume', '$email', '$telefon', '$parola_hash')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: Login_tab.html");
} else {
    echo "Error: " . $sql . "<model>" . $conn->error;
}

$conn->close();
?>
