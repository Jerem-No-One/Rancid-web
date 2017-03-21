<?php
session_start();
 ?>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Paramètres</title>
  </head>
  <body>
    <?php
    if (!empty($_SESSION['logged_in']))
    {
      $hostname_serveur = shell_exec("cat /etc/hostname");
       ?>
       <form action="change_hostname.php" method="post" name="change_hostname">  <!-- Formulaire ajout d'un device -->
           <legend class="text-center">Hostname</legend>
           <div class="container">
             <div class="row">
               <div class="col-md-offset-5 col-md-1">
                 <input type="text" name="hostname" placeholder="<?php echo $hostname_serveur ?>" required="">
               </div>
             </div>
           <div class="row">
             <div class="col-md-offset-5 col-md-1">
               <button type="button" class="btn btn-default btn-sm" onclick="location.href='index.php'">
                 <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
               </button>
             </div>
             <div>
               <button type="submit" class="btn btn-default btn-sm">
                 <span class="glyphicon glyphicon-edit"></span> Modifier
               </button>
             </div>
           </div>
         </div>
       </form>
       <?php
       }
       else
       {
         header('Location:login.php');
       }
       ?>
   </body>
</html>
