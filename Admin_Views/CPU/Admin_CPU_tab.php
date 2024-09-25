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
    <!--Top Bar - Client -->
    <?php include '../../Meniu.php' ?>
    <?php include '../VerificareDrepturi.php' ?>

    <br /><br /><br /><br />
    
    <form action="Admin_CPU_tab.php" method="GET">
      <div style="text-align: center;">
        <div style="display: flex; justify-content: center; align-items: center;">
          <input type="text" name="descriere" placeholder="Căutați după descriere..." required 
                style="flex: 1; max-width: 600px; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" />
          <button type="submit" class="button" style="margin-left: 10px;"><b>Caută</b></button>
          <button type="button" class="button secondary" onclick="location.href='Admin_CPU_tab.php';"><b>Reset</b></button>
        </div>
      </div>
    </form>

    <br /><br />
      
    <hr />
    <div class="row">
      <div class="columns large-centered large-10 medium-10 medium-centered small-12 small-centered cell">
        <h4>CPUs: </h4>
      </div>
    </div>
    <div class="row">
      <div class="columns large-centered large-10 medium-10 medium-centered small-12 small-centered cell">   
        <table  class="unstriped">
          <thead>
            <tr>
              <th>Imagine</th>
              <th width="400">Descriere</th>
              <th width="150">Seria</th>
              <th width="150">Nucleu</th>
              <th width="150">Frecventa</th>
              <th width="150">Tehnologia de Fabricatie</th>
              <th width="100">Pret</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php include 'Afisare.php' ?>
          </tbody>
        </table>
      </div>
    </div>
     </br></br>
     <div class="row">
      <div class="columns large-6 medium-6 small-12 text-right">
        <a href="Admin_CPU_AdaugareForm.php" class="button"><b>Adauga produs</b></a>
      </div>
    </div>
     <hr />

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
