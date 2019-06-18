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
          <h1 class="settings-title">Sinu klassid</h1>

          <!-- here goes first element. You can get your needed elements from here. Clean these comments after -->
            <div class="row vertical-center rooms" id="element1">

                    <div class="col-5">KLASS NO1</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element2">

                    <div class="col-5">KLASS NO2</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element3">

                    <div class="col-5">KLASS NO3</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element4">

                    <div class="col-5">KLASS NO4</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>

            <div class="row vertical-center" id="element5">

                    <div class="col-5">KLASS NO5</div>
                    <div class="col-3 delete-room">KUSTUTA</div>

            </div>


      </div>

      <div class="container-1">
          <h1 class="settings-title">Lisa uus klass</h1>

        
        <div>

        <div class="input-group mb-3 rooms">
            <input type="text" class="form-control" placeholder="Lisa uus ruum" aria-label="new-room" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button">Salvesta</button>
            </div>
        </div>

        </div>


    </div>
  </body>
</html>
