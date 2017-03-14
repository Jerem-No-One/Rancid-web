<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Hostname</title>
  </head>
  <body>
    <?php
    $hostname = htmlspecialchars($_POST['hostname']);
    $hostname = trim($hostname);
    $hostname_file = fopen('/etc/hostname', 'a+');
    ftruncate($hostname_file,0);
    fputs($hostname_file,$hostname);
    fclose($hostname_file);
    echo "Le nouveau nom du serveur est $hostname"
    ?>
    <p>Un reboot est nécessaire !</p>
    <button type="button" class="btn btn-default btn-sm" onclick="location.href='index.php'">
      <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    </button>
  </body>
</html>
