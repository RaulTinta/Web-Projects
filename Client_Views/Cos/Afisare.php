<?php

// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_bError);
}

$client_id = $_SESSION['client_id'];

// Interogare pentru toate produsele din coșul utilizatorului
$products_query = "SELECT c.produs_id, c.produs_tip, c.cantitate, p.imagine, p.descriere, p.pret 
                   FROM Cos c 
                   JOIN %s p ON c.produs_id = p.id AND c.produs_tip = '%s'
                   WHERE c.client_id = ?"; // %s -> place holder pentru tabela de produse

$tables = ['ComputerCases', 'MotherBoards', 'RAMs', 'GPU', 'CPU', 'PrebuiltComputers'];
$fullResults = [];

$suma_totala = 0;

foreach ($tables as $table) {
    // Aici folosim sprintf pentru a înlocui %s cu numele tabelului
    $sql = sprintf($products_query, $table, $table); // Dynamic table name in the query
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "<tr><td colspan='7'>Eroare la pregătirea interogării: " . $conn->error . "</td></tr>";
        continue;
    }

    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $pret_total = $row['cantitate'] * $row['pret'];
        $row['pret_total'] = $pret_total;
        $suma_totala += $pret_total;
        $fullResults[] = $row;
    }
    $stmt->close();
}

// Stocarea sumei totale în sesiune
$_SESSION['suma_totala'] = $suma_totala;

// Afisarea datelor
if (!empty($fullResults)) {
    foreach ($fullResults as $row) {
        echo "<tr>";
        echo "<td><img src='" . htmlspecialchars($row["imagine"], ENT_QUOTES) . "' alt='Produs' style='width:100px;'></td>";
        echo "<td>" . htmlspecialchars($row["descriere"], ENT_QUOTES) . "</td>";
        echo "<td>" . $row["cantitate"] . "</td>";
        echo "<td>" . number_format($row["pret"], 2) . " RON</td>";
        echo "<td>" . number_format($row["pret_total"], 2) . " RON</td>";
        echo "<td>
                <a href='Stergere_Produs.php?id=" . $row["produs_id"] . "&type=" . $row["produs_tip"] . "'>Șterge</a><br>
                <a href='Adaugare_Produs.php?id=" . $row["produs_id"] . "&type=" . $row["produs_tip"] . "'>Adauga</a>
             </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Coșul este gol.</td></tr>";
}

$conn->close();
?>
