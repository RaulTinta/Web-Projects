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

    <style>
      /* Stiluri personalizate pentru a formata textul */
      .contact-info,
      .address {
        text-align: left;
        font-weight: bold;
      }
      /* Stiluri pentru radio buttons */
      input[type='radio'] {
        vertical-align: middle;
      }
    </style>
  </head>

  <body>
    <!--Top Bar - Client Cos -->
    <?php include '../../Meniu.php' ?>
    <?php include '../VerificareDrepturi.php' ?>

    <br /><br />

    <?php include 'Preluare_Date_Comanda.php' ?>
      
    <hr />
    <center><h4><b>Introduceti datele comenezii:</b></h4></center>

    <br /><br />

    <form action="ContinuarePlata.php" method="POST">
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label><h6><b>Adresa de livrare (Judet/Oras/Strada/Numar/Detali)</b></h6></label>
          <input type="text" name="adresa" placeholder="Judet/Oras/Strada/Numar/Detali" required/>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label><h6><b>Persoana de contact</b></h6></label>
          <input type="text" name="nume" value="<?php echo htmlspecialchars($nume_prenume); ?>" required/>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label><h6><b>Telefon</b></h6></label>
          <input type="text" name="Telefon" value="<?php echo htmlspecialchars($telefon); ?>" required/>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
          <label><h6><b>Modalitate Plata</b></h6></label>
          <input type="radio" name="modalitate_plata" value="Card Online" id="card_online" required><label for="card_online">Card Online</label>
          <input type="radio" name="modalitate_plata" value="Ramburs la curier" id="ramburs_curier"><label for="ramburs_curier">Ramburs la curier</label>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="columns large-centered large-5 medium-5 medium-centered small-12 small-centered cell">
            <label><h6><b>Suma Totală de Plătit</b></h6></label>
            <input type="text" readonly="readonly" value="<?php echo number_format($_SESSION['suma_totala'], 2); ?> RON"/>
        </div>
      </div>

      </br></br>
      <div class="row">
        <div class="columns large-6 medium-6 small-12 text-right">
        <button type="button" class="button secondary" onclick="window.location.href='./Client_Cos_tab.php';"><b>Inapoi</b></button>
        <button type="submit" class="button"><b>Continuare</b></button>
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
