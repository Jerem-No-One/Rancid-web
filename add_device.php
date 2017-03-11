<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Ajouter un Equipement</title>
  </head>
  <body>
    <?php
    $ip_device = htmlspecialchars($_POST['ip_device']);
    $user_device = htmlspecialchars($_POST['user_device']);
    $password_device = htmlspecialchars($_POST['password_device']);
    $password_enable = htmlspecialchars($_POST['password_enable']);
    $modele_device = htmlspecialchars($_POST['modele_device']);
    $name_device = htmlspecialchars($_POST['name_device']);
    $connection_device = htmlspecialchars($_POST['connection_device']);
    $autoenable_device = htmlspecialchars($_POST['autoenable_device']);
    $password_enable = htmlspecialchars($_POST['password_enable']);
    $modele_device = trim($modele_device);  // On nettoie la variable car il y a un retour chariot à la fin
    $abort = FALSE;

    shell_exec("cut -d \; -f 1 /usr/local/rancid/var/networking/router.db > data/name_device.txt"); // On met à jour le fichier nom avec les devices existants
    shell_exec("cut -d \  -f1 /etc/hosts > data/ip.txt");
    $ip_txt = fopen('data/ip.txt', 'r');
    $name_device_txt = fopen('data/name_device.txt', 'r');
    if(filter_var($ip_device, FILTER_VALIDATE_IP))
    {
      while(!feof($ip_txt)) // On parcours le fichier ip jusqu'à la fin
      {
        $ip_exist = fgets($ip_txt,4096);
        if(preg_match("#$ip_device#", $ip_exist)) // On vérifie que l'ip ajouté n'est pas déjà présent
        {
          echo "L'ip est déjà attribué à un équipement ...";
          $abort = TRUE;
        }
      }
      while(!feof($name_device_txt)) // On parcours le fichier de nom jusqu'à la fin
      {
        $name_exist = fgets($name_device_txt,4096);
        if(preg_match("#$name_device#", $name_exist)) // On vérifie que le nom ajouté n'est pas déjà présent
        {
          echo "Le nom est déjà attribué à un équipement ...";
          $abort = TRUE;
        }
      }
      fclose($name_device_txt);
      fclose($ip_txt);
    }
    else
    {
        echo "Le format adresse IP n'est pas respecté";
        $abort = TRUE;
    }
    if($abort == TRUE)
    {
      echo '<div class="align-center"><input type="button" value="Retour" onclick="history.go(-1)"></div>';
      exit;
    }
    else
    {
      $cloginrc = fopen ('/usr/local/rancid/.cloginrc', 'a+'); // On ajoute dans le fichier de conf cloginrc les paramètres d'authentification du device
      if ($autoenable_device == 'oui')
      {
        fputs($cloginrc, "add user $name_device $user_device \n");
        fputs($cloginrc, "add password $name_device $password_device $password_device \n");
        fputs($cloginrc, "add autoenable $name_device 1 \n");
      }
      elseif($autoenable_device == 'non')
      {
        fputs($cloginrc, "add user $name_device $user_device \n");
        fputs($cloginrc, "add password $name_device $password_device $password_enable \n");
      }
      if ($connection_device == 'ssh')
      {
        fputs($cloginrc, "add method $name_device $connection_device \n");
      }
      fputs($cloginrc, "\n");
      fclose($cloginrc);
      $router_db = fopen('/usr/local/rancid/var/networking/router.db', 'a+'); // On ajoute dans le fichier de conf router.db les informations de l'équipement
      $hosts = fopen('/etc/hosts', 'a+');
      $ip_add_txt = fopen('data/ip.txt', 'a+');
      fputs($ip_add_txt,"$ip_device\n");
      fputs($hosts, "$ip_device $name_device\n");
      fputs($router_db, "$name_device;$modele_device;up \n");
      echo "$name_device a bien été ajouté !";
      fclose($router_db);
      fclose($hosts);
      fclose($îp_add_txt);
    }
    ?>
    <form class="align-center">
      <input type="button" value="Retour" onclick="location.href='index.php';">
      <!--<input type="button" value="Retour" onclick="history.go(-1)">-->
    </form>
  </body>
</html>
