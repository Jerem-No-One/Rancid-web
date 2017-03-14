<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Paramètres</title>
  </head>
  <body>
    <?php
    $hostname_serveur = shell_exec("cat /etc/hostname");
     ?>
     <form action="change_hostname.php" method="post" name="change_hostname">  <!-- Formulaire ajout d'un device -->
       <filedset>
         <legend class="titre">Hostname</legend>
         <div><input type="text" name="hostname" placeholder="<?php echo $hostname_serveur ?>" required=""></div>
         <div>
           <button type="button" class="btn btn-default btn-sm" onclick="location.href='index.php'">
             <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
           </button>
           <button type="submit" class="btn btn-default btn-sm">
             <span class="glyphicon glyphicon-edit"></span> Modifier
           </button>
         </div>
       </fieldset>
     </form>
   </body>
</html>
