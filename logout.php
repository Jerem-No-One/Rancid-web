<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Logout</title>
  </head>
  <body>
    <?php
    session_start();
    session_destroy();
    header('Location:login.php');
    ?>
    <!--<div class="text-center">
      Vous avez été déconnecté.
      <a href="login.php">Login</a>
    </div>-->
  </body>
</html>
