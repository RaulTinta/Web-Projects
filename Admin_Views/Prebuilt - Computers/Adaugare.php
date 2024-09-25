<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "computercorner";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO PrebuiltComputers (imagine, descriere, model_cpu, model_gpu, chipset, capacitate_ram, pret, discount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssdd", $imagine, $descriere, $model_cpu, $model_gpu, $chipset, $capacitate_ram, $pret, $discount);

// Process file upload
$upload_dir = "../../uploads/"; 
$target_file = $upload_dir . basename($_FILES["imagine"]["name"]);

// Check if file is valid and upload
if ($_FILES["imagine"]["error"] == 0) {
    if (move_uploaded_file($_FILES["imagine"]["tmp_name"], $target_file)) {
        echo "File uploaded successfully. ";
    } else {
        die("Error uploading file.");
    }
} else {
    die("Error with file upload: " . $_FILES["imagine"]["error"]);
}

// Set parameters and execute
$imagine = $target_file; 
$descriere = $_POST['descriere'];
$model_cpu = $_POST['model_cpu'];
$model_gpu = $_POST['model_gpu'];
$chipset = $_POST['chipset'];
$capacitate_ram = $_POST['capacitate_ram'];
$pret = $_POST['pret'];
$discount = $_POST['discount'];

if ($stmt->execute()) {
    echo "New record created successfully";
    // Redirect back to the form page after successful insertion
    header("Location: Admin_PrebuiltComputers_tab.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
