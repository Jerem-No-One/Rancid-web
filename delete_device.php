<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Supprimer un Equipement</title>
  </head>
  <body>
    <?php
    //$name_del = htmlspecialchars($_POST['name_del']);
    //$name_del = trim($name_del); // On nettoie la variable car il y a un retour chariot à la fin
    $choix = ($_POST['choix']);
    $execution = 0;

    if(isset($choix)){ //sera vrai si au moins un moins un checkbox a été coché
      //$nb = 0;
      //$tab = file('/usr/local/rancid/var/networking/router.db');
      //$cloginrc = file('/usr/local/rancid/.cloginrc');
       foreach($choix as $choix){
           $choix = trim($choix);
           shell_exec ("sed -i -e '/$choix/ d' /usr/local/rancid/var/networking/router.db");
           shell_exec ("sed -i -e '/$choix/ d' /usr/local/rancid/.cloginrc");

           $lines = file("/etc/hosts", FILE_IGNORE_NEW_LINES);

           foreach($lines as $key => $line)
             if(stristr($line, $choix)) unset($lines[$key]);

           $data = implode("\n", array_values($lines));
           $hosts = fopen('/etc/hosts','w');
           fwrite($hosts, "$data \n");
           fclose($hosts);
           shell_exec("cut -d \  -f1 /etc/hosts > /var/www/rancid-web/data/ip.txt");
           echo "$choix ";
           $execution++;
         }
         if($execution == 1){
            echo "a bien été supprimé !";
         }
         elseif($execution > 1){
           echo "ont bien été supprimés !";
         }
      }
      else{
        echo "Veuillez cocher un équipement à supprimer ...";
      }

      //file_put_contents('/usr/local/rancid/var/networking/router.db', $router_db);
      //print_r($tab);
      //print_r($choix);
    //}
    //$contenu = shell_exec ("cat /var/www/rancid-web/data/router.db"); // On affecte le contenu du fichier router.db à une variable
    //shell_exec ("sed -i -e '/$chkbx/ d' /usr/local/rancid/var/networking/router.db"); // On suprime les paramètres de connexions au switch du fichier router.db
    //shell_exec ("sed -i -e '/$chkbx/ d' /usr/local/rancid/.cloginrc"); // On supprime les informations du device du fichier cloginrc

    /*$contenu_del = shell_exec ("cat /var/www/rancid-web/data/router.db"); // On affecte le nouveau contenu à une variable
    if ($contenu == $contenu_del){ // On compare les 2 contenus
      echo "$ip_device_del  n'existe pas ...";
    }
    else{*/
      //echo "$name_del a bien été supprimé !";
    //}
    ?>
    <form class="align-center">
      <!--<input type="button" value="Retour" onclick="location.href='index.php';">-->
      <input type="button" value="Retour" onclick="history.go(-1)">
    </form>
  </body>
</html>
