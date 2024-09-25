<?php
session_start();

// Verifică dacă utilizatorul este logat
if (!isset($_SESSION['client_id'])) {
    echo "Trebuie să te loghezi pentru a efectua această acțiune.";
    exit;
}

// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$produs_id = $_GET['id'];
$produs_tip = $_GET['type'];
$client_id = $_SESSION['client_id'];

// Verifică cantitatea curentă în coș
$query = "SELECT cantitate FROM Cos WHERE client_id = ? AND produs_id = ? AND produs_tip = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iis", $client_id, $produs_id, $produs_tip);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cantitate = $row['cantitate'];
    
    if ($cantitate > 1) {
        // Scade cantitatea cu 1
        $update_query = "UPDATE Cos SET cantitate = cantitate - 1 WHERE client_id = ? AND produs_id = ? AND produs_tip = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("iis", $client_id, $produs_id, $produs_tip);
        $update_stmt->execute();
        $update_stmt->close();
        echo "Cantitatea a fost redusă.";
    } else {
        // Șterge produsul din coș
        $delete_query = "DELETE FROM Cos WHERE client_id = ? AND produs_id = ? AND produs_tip = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("iis", $client_id, $produs_id, $produs_tip);
        $delete_stmt->execute();
        $delete_stmt->close();
        echo "Produsul a fost șters din coș.";
    }
} else {
    echo "Produsul nu a fost găsit în coș.";
}

$stmt->close();
$conn->close();

// Redirecționează utilizatorul înapoi la lista de produse
header("Location: Client_Cos_tab.php");
exit;
?>
