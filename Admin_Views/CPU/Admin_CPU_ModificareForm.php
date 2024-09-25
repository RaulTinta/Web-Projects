<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ComputerCorner</title>
    <link rel="stylesheet" href="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css" />
    <!-- Insert this within your head tag and after foundation.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css" />

    <style>
      /* Stilizare personalizată pentru tab-bar */
      .top-bar {
        background-color: #333;
        height: 60px;
      }

      .top-bar .menu li {
        background-color: #333;
      }

      .top-bar .menu li a {
        padding: 10px 15px;
      }

      .top-bar .menu li a:hover {
        background-color: black;
      }
    </style>
  </head>

  <body>
    <!--Top Bar - Admin -->
    <?php include '../../Meniu.php' ?>
    <?php include '../VerificareDrepturi.php' ?>

    <br /><br /><br /><br />
    
    <!-- PHP Code to Fetch Data -->
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "ComputerCorner";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Get ID from URL
      $id = isset($_GET['id']) ? $_GET['id'] : die('ID not provided');

      // Fetching data
      $sql = "SELECT * FROM CPU WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      if (!$row) {
          die('No record found');
      }
    ?>

    <hr />
    <center><h5><b>Introduceti datele despre noul produs:</b></h5></center>
    <form action="Update.php" method="POST" enctype="multipart/form-data">
      <center>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label for="imagine">Imagine:</label>
          <input type="file" id="imagine" name="imagine">
          <?php
            // Check if an image exists
            if (!empty($row['imagine'])) {
               echo '<img src="' . htmlspecialchars($row['imagine']) . '" style="max-width:100px;max-height:100px;">';
            }
          ?>
        </div>
      </div>
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      </center>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Descriere</label>
          <input type="text" name="descriere" value="<?php echo htmlspecialchars($row['descriere']); ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Seria</label>
          <input type="text" name="seria" value="<?php echo htmlspecialchars($row['seria']); ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Nucleu</label>
          <input type="text" name="nucleu" value="<?php echo htmlspecialchars($row['nucleu']); ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Frecventa</label>
          <input type="text" name="frecventa" value="<?php echo htmlspecialchars($row['frecventa']); ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Tehnologia de Fabricatie</label>
          <input type="text" name="tehnologie_fabricatie" value="<?php echo htmlspecialchars($row['tehnologie_fabricatie']); ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Pret</label>
          <input type="text" name="pret" value="<?php echo htmlspecialchars($row['pret']); ?>"/>
        </div>
      </div>

      </br></br>
      <div class="row">
        <div class="columns large-6 medium-6 small-12 text-right">
          <button type="submit" class="button"><b>Finalizare</b></button>
        </div>
      </div>
    </form>

    <hr />

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
