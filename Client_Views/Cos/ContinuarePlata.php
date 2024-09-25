<?php
session_start();

// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$client_id = $_SESSION['client_id'];
$produse_descriere = "";  // Inițializează stringul pentru descrierea produselor

// Interogare pentru toate produsele din coșul utilizatorului
$products_query = "SELECT c.produs_id, c.produs_tip, c.cantitate, p.descriere
                   FROM Cos c
                   JOIN %s p ON c.produs_id = p.id AND c.produs_tip = '%s'
                   WHERE c.client_id = ?";
$tables = ['ComputerCases', 'MotherBoards', 'RAMs', 'GPU', 'CPU', 'PrebuiltComputers'];

foreach ($tables as $table) {
    $sql = sprintf($products_query, $table, $table);
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Eroare la pregătirea interogării: " . $conn->error;
        continue;
    }

    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $produse_descriere .= "<b>" . $row['cantitate'] . "x </b>"  . $row['descriere'] . ', ';
    }
    $stmt->close();
}

// Elimină ultima virgulă și spațiu
$produse_descriere = rtrim($produse_descriere, ', ');

$client_id = $_SESSION['client_id'];
$adresa = $_POST['adresa'];
$nume = $_POST['nume'];
$telefon = $_POST['Telefon'];
$modalitate_plata = $_POST['modalitate_plata'];
$suma_totala = $_SESSION['suma_totala'];

// Inserare comandă în baza de date
$query = "INSERT INTO Comenzi (adresa, nume, telefon, modalitate_plata, suma_totala, produse) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssis", $adresa, $nume, $telefon, $modalitate_plata, $suma_totala, $produse_descriere);
if (!$stmt->execute()) {
    echo "Eroare la înregistrarea comenzii: " . $stmt->error;
} else {
    echo "Comanda a fost înregistrată cu succes.";
}
// Eliberarea coșului după plasarea comenzii
$delete_query = "DELETE FROM Cos WHERE client_id = ?";
$delete_stmt = $conn->prepare($delete_query);
if (!$delete_stmt) {
    echo "Eroare la pregătirea interogării pentru ștergerea coșului: " . $conn->error;
    exit;
}
$delete_stmt->bind_param("i", $client_id);
$delete_stmt->execute();
$delete_stmt->close();

// Redirecționare în funcție de modalitatea de plată
if ($modalitate_plata == 'Card Online') {
    header('Location: IntroducereCard.html');
    exit;
} else if ($modalitate_plata == 'Ramburs la curier') {
    header('Location: Client_ConfirmareComanda_tab.html');
    exit;
} else {
    echo "Eroare la înregistrarea comenzii: " . $stmt->error;
}

$stmt->close();

$conn->close();
?>
