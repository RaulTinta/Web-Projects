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

$drepturi = $_SESSION['user_drepturi'];

// Interogare pentru a prelua paginile accesibile în funcție de drepturile utilizatorului
$sql = "SELECT nume_pagina, url_pagina FROM Pagini WHERE drepturi = ? AND nume_pagina IS NOT NULL AND nume_pagina != ''";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $drepturi);
$stmt->execute();
$result = $stmt->get_result();

// Generarea meniului pentru top-bar
echo '<div class="top-bar">';
echo '  <div class="top-bar-left">';
echo '    <ul class="menu">';
echo '      <li class="menu-text"><h8><b>ComputerCorner</b></h8></li>';

while ($row = $result->fetch_assoc()) {
    // Condiție specială pentru pagina Dashboard
    if ($row['nume_pagina'] === "Dashboard") {
        echo "<li><a href='../" . htmlspecialchars($row['url_pagina']) . "'><strong>" . htmlspecialchars($row['nume_pagina']) . "</strong></a></li>";
    } else {
        echo "<li><a href='../" . htmlspecialchars($row['url_pagina']) . "'>" . htmlspecialchars($row['nume_pagina']) . "</a></li>";
    }
}

echo '    </ul>';
echo '  </div>';
echo '  <div class="top-bar-right">';
echo '    <ul class="menu">';
echo '      <li><a href="../Autentificare/LogOut.php">Log out</a></li>';
echo '    </ul>';
echo '  </div>';
echo '</div>';

$stmt->close();
$conn->close();
?>
