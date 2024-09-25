<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "computercorner";

// Creare conexiune
$conn = new mysqli($servername, $username, $password, $database);

// Verificare conexiune
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Interogare pentru a obține datele din tabelul Comenzi
$sql = "SELECT id, nume, adresa, modalitate_plata, data_comanda, suma_totala, produse FROM Comenzi";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afișare date pentru fiecare rând
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nume"] . "</td>";
        echo "<td>" . $row["adresa"] . "</td>";
        echo "<td>" . $row["modalitate_plata"] . "</td>";
        echo "<td>" . $row["data_comanda"] . "</td>";
        echo "<td>" . $row["produse"] . "</td>";
        echo "<td>In curs de livrare</td>";  // Starea comenzii hard-coded
        echo "<td>" . $row["suma_totala"] . " RON</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Nu există comenzi înregistrate.</td></tr>";
}
$conn->close();
?>
