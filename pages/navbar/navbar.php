<?php
    include('../../config.php');
?>
<style type="text/css">
    .wrapper-menu {
    width: 25px;
    height: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
    transition: transform 330ms ease-out;
    position: absolute;
    right: 20px;
    top:50%;
    transform: translateY(-50%);
    }

    .wrapper-menu.open {
    transform: translateY(-50%) rotate(-45deg);
    }

    .line-menu {
    background-color: #fff;
    border-radius: 5px;
    width: 100%;
    height: 3px;
    }

    .line-menu.half {
    width: 50%;
    }

    .line-menu.start {
    transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
    transform-origin: right;
    }

    .open .line-menu.start {
    transform: rotate(-90deg) translateX(3px);
    }

    .line-menu.end {
    align-self: flex-end;
    transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
    transform-origin: left;
    }

    .open .line-menu.end {
    transform: rotate(-90deg) translateX(-3px);
    }


    nav {
        position: fixed;
        height: 50px;
        width: 100%;
        z-index: 500;
        top: 0;
        left: 0;
        background: black;
        color: white;
        display: flex;
        justify-content:center;
        align-items: center;
        box-sizing: border-box;
        padding: 0 20px;
    }

    nav h3 {
        margin-left: 0;
        margin-bottom: 0;
    }

    aside {
        position: fixed;
        top:0;
        left: 0;
        height: 100vh;
        width: 100%;
        z-index: 499;
        pointer-events: none;
    }

    aside ul {
        position: absolute;
        top: 70px;
        right: 20px;
        list-style-type: none;
        text-align: right;
        transition: transform ease 0.4s;
        transform: translateX(500px);
        pointer-events: all;
    }

    aside ul a {
        text-decoration: none;
        font-weight: bold;
        font-size: 21px;
        color: black;
        padding: 0.5em 1em;
    }

    aside ul li {
        margin-bottom: 20px;
    }

    aside .menu-overlay {
        position: fixed;
        top:0;
        left: 0;
        height: 100vh;
        width: 100%;
        background: #f7f7f7;
        opacity: 0;
        transition: opacity ease 0.4s;
    }

    aside.open {
        pointer-events: all;
    }

    aside.open .menu-overlay {
        opacity: 0.9;
    }

    aside.open ul {
        transform: translateX(0);
    }

</style>


<!-- markup -->
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
        <li><a href="<?php echo $edulog_root . 'pages/tracker';?>">Tunni logimine</a></li>
        <li><a href="<?php echo $edulog_root . 'pages/logs';?>">Tundide logi</a></li>
        <li><a href="<?php echo $edulog_root . 'pages/lesson_thread';?>">Tundide teema</a></li>
        <li><a href="<?php echo $edulog_root . 'pages/lesson_room';?>">Tundide room</a></li>
        <li><a id="logout" href="<?php echo $edulog_root . 'pages/login';?>">Logi välja</a></li>
        
       <?php if(strstr($_SERVER["SCRIPT_NAME"], 'logs')) : ?>
        <li><a onclick="fetchCsv('Self')">Lae alla kõik enda logid</a></li>
        <?php if ($_COOKIE['user_id'] == '3'):?>
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
        <?php if ($_COOKIE['user_id'] == '3'):?>
        <li><a onclick="fetchCsv('All')">ADMIN: Download everyone's logs</a></li>
        <?php endif;?>
        <?php endif;?>
    </ul>
    <?php endif;?>
</aside>
<!-- end of markup -->
<script src="functions.js"></script>
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
