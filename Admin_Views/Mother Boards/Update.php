<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ComputerCorner";

// Crearea conexiunii la baza de date
$conn = new mysqli($servername, $username, $password, $database);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificarea metodei HTTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descriere = $_POST['descriere'];
    $soclu_procesor = $_POST['soclu_procesor'];
    $chipset_producator = $_POST['chipset_producator'];
    $chipset_model = $_POST['chipset_model']; 
    $tip_memorie = $_POST['tip_memorie'];
    $pret = $_POST['pret'];
    $imagine = "";

    // Verifică dacă o nouă imagine a fost încărcată
    if (!empty($_FILES['imagine']['name'])) {
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["imagine"]["name"]);
        if (move_uploaded_file($_FILES["imagine"]["tmp_name"], $target_file)) {
            $imagine = $target_file;
        }
    } else {
        // Selectează calea imaginii existente din baza de date
        $query = "SELECT imagine FROM motherboards WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($currentImage);
        $stmt->fetch();
        $imagine = $currentImage;
        $stmt->close();
    }

    // Pregătirea interogării SQL
    $sql = "UPDATE motherboards SET descriere=?, soclu_procesor=?, chipset_producator=?, chipset_model=?, tip_memorie=?, pret=?, imagine=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $descriere, $soclu_procesor, $chipset_producator, $chipset_model, $tip_memorie, $pret, $imagine, $id);
    
    // Executarea interogării
    if ($stmt->execute()) {
        echo "Înregistrarea a fost actualizată cu succes.";
        header("Location: Admin_MotherBoards_tab.php"); // Redirect către pagina de administrare
    } else {
        echo "Eroare: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Metoda HTTP neacceptată.";
}
?>
