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
    if (!empty($_SESSION['logged_in']))
    {
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
             /*echo '<div class="text-center">'.$choix.'</div>';
             $execution++;
           }
           if($execution == 1){
              echo '<div class="text-center">Supprimé !</div>';
           }
           elseif($execution > 1){
             echo '<div class="text-center">Supprimés !</div>';
           }
        }
        else{
          echo '<div class="text-center">Veuillez cocher un équipement à supprimer ...</div>';
        }*/
        ?>
        <!--<div class="text-center">
          <button type="button" class="btn btn-default btn-sm" OnClick="location.href='index.php'">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
          </button>
        </div>-->
      <?php
        }
      }
      header('Location:index.php');
      }
      else
      {
        header('Location:login.php');
      }
      ?>
  </body>
</html>
