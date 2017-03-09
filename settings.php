<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Paramètres</title>
  </head>
  <body>
    <?php
    $hostname_serveur = shell_exec("cat /etc/hostname");
     ?>
     <form action="change_hostname.php" method="post" class="settings" name="change_hostname">  <!-- Formulaire ajout d'un device -->
       <filedset>
         <legend class="titre">Hostname</legend>
         <div><input type="text" name="hostname" placeholder="<?php echo $hostname_serveur ?>" required=""></div>
         <div>
           <input type="button" onclick="location.href='index.php'" value="Retour">
           <input type="submit" value="Modifier">
         </div>
       </fieldset>
     </form>
   </body>
</html>
