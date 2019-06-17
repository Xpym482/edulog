<?php
    include('../../config.php');
    require("functions.php");
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>EduLog</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    </head>

    <body>
        <?php include "../../" . 'pages/navbar/navbar.php'; ?>
        <div class="container">
            <div id="tracker">
             <!--   <div id="activities"></div> -->
                <footer></footer>
            </div>
            <div id="addTeacher">
            <h2>Lisa õpetajate tegevused:</h2>
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" id="addTeacherActivity" placeholder="Kirjuta õpejudude tegevust" name="addTeacherActivity"/><br />
                <input type="submit" value="Submit" name="addActivity"/><br />
            </form>
            <?php
            $teacherArray = getTeacherActivities();
             ?>
            <select>
              <?php
              foreach ($teacherArray as $key) {
                ?><option><?php echo $key;?></option>
                <?php
              }
               ?>
            </select>
            <h2>Lisa tudengi tegevused:</h2>
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" id="addStudentActivity" placeholder="Kirjuta tudengi tegevust" name="addStudentActivity"/><br />
                <input type="submit" value="Submit" name="addActivity"/><br />
            </form>
            <?php
            $studentArray = getStudentActivities();
             ?>
            <select>
              <?php
              foreach ($studentArray as $key) {
                ?><option><?php echo $key;?></option>
                <?php
              }
               ?>
            </select>
            </div>
    </body>
</html>
