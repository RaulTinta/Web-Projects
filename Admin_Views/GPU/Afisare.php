<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

// Verifică dacă există un termen de căutare
$descriere = isset($_GET['descriere']) ? '%' . $_GET['descriere'] . '%' : '';

if (!empty($descriere)) {
    // Dacă există un termen de căutare, caută în baza de date
    $stmt = $conn->prepare("SELECT * FROM GPU WHERE descriere LIKE ?");
    $stmt->bind_param("s", $descriere);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Altfel, afișează toate datele
    $sql = "SELECT * FROM GPU";
    $result = $conn->query($sql);
}

// Verifică dacă interogarea a returnat rezultate
if (!$result) {
    die("Eroare la interogare: " . $conn->error);
}

?>

<!-- Afișează datele din baza de date în tabelul HTML -->
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='" . htmlspecialchars($row["imagine"], ENT_QUOTES) . "' alt='Produs' ></td>";
        echo "<td>" . htmlspecialchars($row["descriere"], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlspecialchars($row["seria"], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlspecialchars($row["boost_clock"], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlspecialchars($row["tip_memorie"], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlspecialchars($row["dimensiune_memorie"], ENT_QUOTES) . "</td>";
        echo "<td>" . htmlspecialchars($row["pret"], ENT_QUOTES) . "</td>";
        echo "<td>
                <a href='Stergere.php?id=" . htmlspecialchars($row["id"], ENT_QUOTES) . "' onclick='return confirm(\"Sigur vrei să ștergi acest produs?\")'>șterge</a><br>
                <a href='Admin_GPU_ModificareForm.php?id=" . $row["id"] . "'>modifică</a><br>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Nu există date disponibile</td></tr>";
}

$conn->close();
?>