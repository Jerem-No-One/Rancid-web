<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Supprimer un Equipement</title>
  </head>
  <body>
    <?php
    $choix = ($_POST['choix']);
    $execution = 0;

    if(isset($choix)){ // Sera vrai si au moins un moins une checkbox a été coché
       foreach($choix as $choix){ // Pour chaque case coché, on supprime l'équipement du router.db et cloginrc
           $choix = trim($choix);
           shell_exec ("sed -i -e '/$choix/ d' /usr/local/rancid/var/networking/router.db");
           shell_exec ("sed -i -e '/$choix/ d' /usr/local/rancid/.cloginrc");

           $lines = file("/etc/hosts", FILE_IGNORE_NEW_LINES);

           foreach($lines as $key => $line) // On supprime l'équipement du fichier host
             if(stristr($line, $choix)) unset($lines[$key]);

           $data = implode("\n", array_values($lines));
           $hosts = fopen('/etc/hosts','w');
           fwrite($hosts, "$data \n");
           fclose($hosts);
           shell_exec("cut -d \  -f1 /etc/hosts > data/ip.txt");
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
    ?>
    <form class="align-center">
      <input type="button" value="Retour" onclick="location.href='index.php';">
      <!--<input type="button" value="Retour" onclick="history.go(-1)">-->
    </form>
  </body>
</html>
