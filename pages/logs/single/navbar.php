      <?php
    include('../../../config.php');
?>


<nav>
    <div class="wrapper-menu">
        <div class="line-menu half start"></div>
        <div class="line-menu"></div>
        <div class="line-menu half end"></div>
    </div>
   <h3 id="timer">Edulog</h3>
</nav>
<aside class="menu">
    <div class="menu-overlay"></div>

    <?php if($_COOKIE['locale'] == 'et') : ?>
    <ul>
        <li><a href="<?php echo $edulog_root . 'pages/tracker';?>">Tundide logimine</a></li>
        <li><a href="<?php echo $edulog_root . 'pages/logs';?>">Tundide logid</a></li>
        <li><a id="logout" href="<?php echo $edulog_root . 'pages/login/logout.php';?>">Logi välja (<?php echo $_SESSION['user-name']; ?>)</a></li>

       <?php if(strstr($_SERVER["SCRIPT_NAME"], 'logs')) : ?>
        <li><a onclick="fetchCsv('Self')">Lae alla kõik enda logid</a></li>
        <?php if ($_SESSION['id'] == '3'):?>
        <li><a onclick="fetchCsv('All')">ADMIN: Lae alla kõigi logid</a></li>
        <?php endif;?>
        <?php endif;?>
    </ul>
    <?php endif;?>


    <?php if($_COOKIE['locale'] != 'et') : ?>
    <ul>
        <li><a href="<?php echo $edulog_root . 'pages/tracker';?>">Tracker</a></li>
        <li><a href="<?php echo $edulog_root . 'pages/logs';?>">Logs</a></li>
        <li><a id="logout" href="<?php echo $edulog_root . 'pages/login';?>">Log out</a></li>
        <?php if(strstr($_SERVER["SCRIPT_NAME"], 'logs')) : ?>
        <li><a onclick="fetchCsv('Self')">Download all of your logs</a></li>
        <?php if ($_SESSION['id'] == '3'):?>
        <li><a onclick="fetchCsv('All')">ADMIN: Download everyone's logs</a></li>
        <?php endif;?>
        <?php endif;?>
    </ul>
    <?php endif;?>
</aside>
<!-- end of markup -->
<script src="../functions.js"></script>
<script>
    var wrapperMenu = document.querySelector('.wrapper-menu');

    wrapperMenu.addEventListener('click', function(){
      wrapperMenu.classList.toggle('open');
      $('aside.menu').toggleClass('open')
    })

    $('#logout').click(function() {
        Cookies.remove('user_id');
        Cookies.remove('lesson_id');
        Cookies.remove('lesson_start');
    })

</script>
