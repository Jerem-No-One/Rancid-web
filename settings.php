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
         <div class="container">
           <div class="raw">
             <nav class="navbar navbar-default">
               <div class="container-fluid">
                 <div class="navbar-header">
                   <a class="navbar-brand" href="index.php">Rancid Web</a>
                 </div>
                 <ul class="nav navbar-nav navbar-right">
                   <li><a href="websvn/index.php"><span class="glyphicon glyphicon-list"></span> Websvn</a></li>
                   <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Paramètres</a></li>
                   <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>
                 </ul>
               </div>
             </nav>
           </div>
           <legend class="text-center">Hostname</legend>
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
       <footer>
           <div class="container">
               <div class="row">
                     <p>&copy; 2017 B2M SAS</p>
                 </div>
               </div>
             </div>
       </footer>
       <?php
       }
       else
       {
         header('Location:login.php');
       }
       ?>
   </body>
</html>
