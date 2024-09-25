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
    $model_cpu = $_POST['model_cpu'];
    $model_gpu = $_POST['model_gpu'];
    $chipset = $_POST['chipset']; 
    $capacitate_ram = $_POST['capacitate_ram'];
    $pret = $_POST['pret'];
    $pret = $_POST['discount'];
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
        $query = "SELECT imagine FROM PrebuiltComputers WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($currentImage);
        $stmt->fetch();
        $imagine = $currentImage;
        $stmt->close();
    }

    // Pregătirea interogării SQL
    $sql = "UPDATE PrebuiltComputers SET descriere=?, model_cpu=?, model_gpu=?, chipset=?, capacitate_ram=?, pret=?, imagine=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $descriere, $model_cpu, $model_gpu, $chipset, $capacitate_ram, $pret, $discount, $imagine, $id);
    
    // Executarea interogării
    if ($stmt->execute()) {
        echo "Înregistrarea a fost actualizată cu succes.";
        header("Location: Admin_PrebuiltComputers_tab.php"); // Redirect către pagina de administrare
    } else {
        echo "Eroare: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Metoda HTTP neacceptată.";
}
?>
