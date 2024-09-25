<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

// Creare conexiune
$conn = new mysqli($servername, $username, $password, $database);

// Verificare conexiune
if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

// Verifică dacă există un parametru ID valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Pregătește o interogare SQL pentru ștergere
    $stmt = $conn->prepare("DELETE FROM PrebuiltComputers WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execută interogarea
    if ($stmt->execute()) {
        echo "Produsul a fost șters cu succes.";
    } else {
        echo "Eroare la ștergerea produsului.";
    }

    $stmt->close();
} else {
    echo "ID invalid sau lipsă.";
}

$conn->close();

// Redirecționează utilizatorul înapoi la lista de produse
header("Location: Admin_PrebuiltComputers_tab.php");
exit;
?>
