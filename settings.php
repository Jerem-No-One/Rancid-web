<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Paramètres</title>
  </head>
  <body>
    <?php
    $hostname = shell_exec("cat /etc/hostname");
     ?>
     <p>Hostname</p>
     <div><input type="text" name="hostname" placeholder="<?php echo $hostname?>" autofocus=""></div>
     <div><input type="button" onclick="location.href='change_hostname.php'" value="Modifier"></div>
   </body>
</html>
