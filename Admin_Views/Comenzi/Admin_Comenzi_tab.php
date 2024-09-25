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
    <div class="row">
      <div class="columns large-centered large-10 medium-10 medium-centered small-12 small-centered cell">
        <h4>Comenzi: </h4>
      </div>
    </div>
    <div class="row">
      <div class="columns large-centered large-10 medium-10 medium-centered small-12 small-centered cell">   
        <table  class="unstriped">
          <thead>
            <tr>
              <th width="150">Nume Client</th>
              <th width="150">Adresa</th>
              <th width="150">Tipul Platii</th>
              <th width="150">Data</th>
              <th width="500">Produse</th>
              <th width="150">Starea Comnezii</th>
              <th>Pret</th>
            </tr>
          </thead>
          <tbody>
            
            <?php include 'Afisare.php' ?>

          </tbody>
        </table>
      </div>
    </div>
     </br></br>
     <hr />

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
