<?php
    include('../../config.php');
?>

  <head>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title>EduLog</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="../navbar.js"></script>

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>



    <link rel="stylesheet" href="../css/style.css" type="text/css" />

  </head>

  <body>
    <?php include "../navbar/navbar.php" ?>
    <div class="container-fluid">
      <div class="container-1">
          <h1 class="settings-title">Õpetaja tegevused</h1>

          <!-- here goes first element. You can get your needed elements from here. Clean these comments after -->
            <div class="row vertical-center rooms" id="element1">

                    <div class="col-7">TEACHER ACTION NO1</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element2">

                    <div class="col-7">TEACHER ACTION NO2</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element3">

                    <div class="col-7">TEACHER ACTION NO3</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element4">

                    <div class="col-7">TEACHER ACTION NO4</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element5">

                    <div class="col-7">TEACHER ACTION NO5</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

      </div>

      <div class="container-1">
        <h1 class="settings-title">Lisa uus õpetaja tegevus</h1>


        <div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Õpetaja tegevus" aria-label="Text input with dropdown button">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vali värv</button>
              <div class="dropdown-menu">
              <a class="dropdown-item red-1" href="#">Punane 1</a>
              <a class="dropdown-item red-2" href="#">Punane 2</a>
              <a class="dropdown-item red-3" href="#">Punane 3</a>
              <a class="dropdown-item green-1" href="#">Roheline 1</a>
              <a class="dropdown-item green-2" href="#">Roheline 2</a>
              <a class="dropdown-item green-3" href="#">Roheline 3</a>
              <a class="dropdown-item blue-1" href="#">Sinine 1</a>
              <a class="dropdown-item blue-2" href="#">Sinine 2</a>
              <a class="dropdown-item blue-3" href="#">Sinine 3</a>
              <a class="dropdown-item gray-1" href="#">Hall 1</a>
              <a class="dropdown-item gray-2" href="#">Hall 2</a>
              <a class="dropdown-item gray-3" href="#">Hall 3</a>
              </div>
            <button class="btn btn-outline-secondary" type="button">Lisa tegevus</button>
          </div>

        </div>

        </div>

      </div> <!-- end of container-1 -->

      <hr>

      <div class="container-1">
          <h1 class="settings-title">Õpilase tegevused</h1>

          <!-- here goes first element. You can get your needed elements from here. Clean these comments after -->
            <div class="row vertical-center rooms" id="element1">

                    <div class="col-7">STUDENT ACTION NO1</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element2">

                    <div class="col-7">STUDENT ACTION NO2</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element3">

                    <div class="col-7">STUDENT ACTION NO3</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element4">

                    <div class="col-7">STUDENT ACTION NO4</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element5">

                    <div class="col-7">TEACHER ACTION NO5</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

      </div>

      <div class="container-1">
        <h1 class="settings-title">Lisa uus õpilase tegevus</h1>


        <div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Õpilase tegevus" aria-label="Text input with dropdown button">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vali värv</button>
              <div class="dropdown-menu">
              <a class="dropdown-item red-1" href="#">Punane 1</a>
              <a class="dropdown-item red-2" href="#">Punane 2</a>
              <a class="dropdown-item red-3" href="#">Punane 3</a>
              <a class="dropdown-item green-1" href="#">Roheline 1</a>
              <a class="dropdown-item green-2" href="#">Roheline 2</a>
              <a class="dropdown-item green-3" href="#">Roheline 3</a>
              <a class="dropdown-item blue-1" href="#">Sinine 1</a>
              <a class="dropdown-item blue-2" href="#">Sinine 2</a>
              <a class="dropdown-item blue-3" href="#">Sinine 3</a>
              <a class="dropdown-item gray-1" href="#">Hall 1</a>
              <a class="dropdown-item gray-2" href="#">Hall 2</a>
              <a class="dropdown-item gray-3" href="#">Hall 3</a>
              </div>
            <button class="btn btn-outline-secondary" type="button">Lisa tegevus</button>
          </div>

        </div>

      </div> <!-- end of container-1 -->



    </div>
  </body>
</html>
