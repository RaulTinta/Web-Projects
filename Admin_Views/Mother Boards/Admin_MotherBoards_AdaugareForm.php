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
    
    <hr />
    <center><h5><b>Introduceti datele despre noul produs:</b></h5></center>
    <form action="Adaugare.php" method="POST" enctype="multipart/form-data">
      <center>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label for="imagine">Imagine:</label>
          <input type="file" id="imagine" name="imagine" required>
        </div>
      </div>
      </center>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Descriere</label>
          <input type="text" name="descriere"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Soclu procesor</label>
          <input type="text" name="soclu_procesor"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Producator chipset</label>
          <input type="text" name="chipset_producator"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Model chipset</label>
          <input type="text" name="chipset_model"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Tip memorie</label>
          <input type="text" name="tip_memorie"/>
        </div>
      </div>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label>Pret</label>
          <input type="text" name="pret"/>
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
