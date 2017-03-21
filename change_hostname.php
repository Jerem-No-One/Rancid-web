<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Hostname</title>
  </head>
  <body>
    <?php
    if (!empty($_SESSION['logged_in']))
    {
      $hostname = htmlspecialchars($_POST['hostname']);
      $hostname = trim($hostname);
      $hostname_file = fopen('/etc/hostname', 'a+');
      ftruncate($hostname_file,0);
      fputs($hostname_file,$hostname);
      fclose($hostname_file);
      echo '<div class="text-center">Le nouveau nom du serveur est '.$hostname.'</div>';
      ?>
      <div class="text-center">Un reboot est nécessaire !</div>
      <div class="text-center">
        <button type="button" class="btn btn-default btn-sm" onclick="location.href='index.php'">
          <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </button>
      </div>
    <?php
    }
    else
    {
      header('Location:login.php');
    }
    ?>
  </body>
</html>
