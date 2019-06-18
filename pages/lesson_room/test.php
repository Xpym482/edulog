<div class="site-content">
    <?php include "../../" . 'pages/navbar/navbar.php'; ?>
    <form id="login-form" action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="logreg">
        <section class="box-head">
            <h1 id="title">VALI RUUM</h1>
            <hr>
        </section>
        <div class="login-details">
            <section>
                <h1 id="title">Sinu ruumid:</h1>
                <ul>
                  <?php
                  $ourarray = getLessons();
                  //var_dump($ourarray);
                  foreach ($ourarray as $key) {
                    ?><li><?php echo $key;?></li>
                    <?php
                  }
                   ?>
                </ul>
                <!--<input id="Ruum" name="Ruum" placeholder="Kirjutage ruum">-->
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <h3 id="title">LISA UUS RUUM</h3>
                <input id="Ruum" name="Ruum" placeholder="Kirjutage ruum" type="text">
                <hr>
                <div class="btn-wrap">
                <hr>
                    <input id="login-btn" class="f-btn" type="submit" name="addroom" value="submit"></input>
                </div>
            </section>
        </div>
    </form>
</div>
