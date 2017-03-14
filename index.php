<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Rancid Web</title>
  </head>
  <body>
    <?php
    if (!empty($_SESSION['logged_in']))
    {
       ?>
       <div class="container">
         <div class="row">
           <h1>Rancid Web</h1>
           <div class="col-lg-11">
             <button type="button" class="btn btn-default btn-sm" onclick="location.href='settings.php'">
               <span class="glyphicon glyphicon-cog"></span> Paramètres
             </button>
           </div>
           <div class="col-lg-1">
             <button class="btn btn-default btn-sm" OnClick="location.href='logout.php'">
               <span class="glyphicon glyphicon-off"></span> Déconnexion
             </button>
           </div>
         </div>
         <div class="row">
         <form action="add_device.php" method="post" class="form" name="add_device">  <!-- Formulaire ajout d'un device -->
           <filedset>
             <legend>Ajouter un équipement</legend>
               <div class="form-group">
                 <label for="adresse_ip" class="col-lg-2">Adresse IP</label>
                 <div class="col-lg-2">
                   <input type="text" class="form-control" name="ip_device" placeholder="192.168.0.0" autofocus="" required=""/></br>
                 </div>
               </div>
               <div class="form-group">
                 <label for="nom" class="col-lg-2 control-label">Nom de l'équipement</label>
                 <div class="col-lg-2">
                   <input type="text" class="form-control" name="name_device" placeholder="Device Name" required=""/></br>
                 </div>
               </div>
               <div class="form-group">
                 <label for="authentification" class="col-lg-2">Authentification</label>
                 <div class="col-lg-2">
                   <input type="text" class="form-control" name="user_device" placeholder="Username" required=""/></br>
                 </div>
               </div>
               <div class="form-group">
                 <label for="password_device" class="col-lg-2">Mot de passe ssh/telnet</label>
                 <div class="col-lg-2">
                   <input type="password" class="form-control" name="password_device" placeholder="Password" required=""/></br>
                 </div>
               </div>
               <div id="password_enable" class="form-group">
                 <label for="password_enable" class="col-lg-2">Mot de passe enable</label>
                  <div class="col-lg-2">
                    <input id="disabledInput" class="form-control" type="password" name="password_enable" placeholder="Password" disabled/></br>
                  </div>
               </div>
               <div class="form-group">
                 <label for="modele_device" class="col-lg-2">Modèle équipement</label>
                 <div class="col-lg-2">
                   <select name="modele_device" class="form-control"> <!-- Select dynamique -->

                      <?php
                      shell_exec("cut -d \; -f 1 /usr/local/rancid/etc/rancid.types.base | uniq > data/modele.txt"); // On récupère les modèles qui sont les configurations de rancid et on les sockent dans un fichier
                      shell_exec(" sed -i -e '/#/ d' data/modele.txt"); // On supprime les caractères # du fichier créé
                      $modele = file('data/modele.txt');
                      foreach($modele as $modele_device) // On parcours le fichier et on affiche chaque modèle
                      {
                        echo '<option value="'.$modele_device.'">'.$modele_device.'</option>';
                      }
                      ?>
                   </select></br>
                 </div>
               </div>
               <div class="form-group">
                 <label for="auto_enable" class="col-lg-2">Auto-enable :</label>
                 <div class="checkbox-inline">
                   <label>
                     <input type="radio" name="autoenable_device" value="oui" id="oui" checked="checked" onclick="passwordEnable()"/> Oui
                   </label>
                 </div>
                 <div class="checkbox-inline">
                   <label>
                     <input type="radio" name="autoenable_device" value="non" id="non" onclick="passwordEnable()"/> Non
                   </label>
                 </div>
               </div>
               <div class="form-group">
                 <label for="connectivite" class="col-lg-2">Connectivité :</label>
                 <div class="checkbox-inline">
                   <label>
                     <input type="radio" name="connection_device" value="ssh" id="ssh" checked="checked"/> SSH
                   </label>
                 </div>
                 <div class="checkbox-inline">
                   <label>
                     <input type="radio" name="connection_device" value="telnet" id="telnet"/> Telnet
                   </label>
                 </div>
               </div>
               <div class="col-lg-1">
                 <input type="submit" class="btn btn-default btn-sm" value="Ajouter"/>
               </div>
           </div>
         </filedset>
       </form>
       <div class="container">
         <form action="delete_device.php" method="post" name="delete_device"> <!-- Formulaire de suppression d'un device -->
           <fieldset>
             <legend>Supprimer un équipement</legend>
               <div>
                   <?php
                   shell_exec("cut -d \; -f 1 /usr/local/rancid/var/networking/router.db > data/name_device.txt"); // On récupère les noms des switchs déjà créé et on les stockent dans un fichier
                   $name = file('data/name_device.txt');
                   foreach($name as $name_del) // On parcours le fichier et on affiche chaque nom
                   {
                     echo '<div>
                            <label for="'.$name_del.'">'.$name_del.'</label>
                            <input type="checkbox" name="choix[]" id="'.$name_del.'" value="'.$name_del.'">
                           </div>';
                     /*echo '<div>
                            <label for="'.$name_del.'">'.$name_del.'</label>
                            <button class="btn btn-warning btn-xs" Onclick="deleteDevice()" value="'.$name_del.'">
                            <span class="glyphicon glyphicon-trash"></span>
                            </button><br>
                           </div>';*/
                   }
                   ?>
                 </br>
               </div>
               <div class="col-lg-1">
                 <button type="button" class="btn btn-default btn-sm" OnClick="javascript:window.location.reload()">
                  <span class="glyphicon glyphicon-refresh"></span> Actualiser
                 </button>
               </div>
               <div class="col-lg-1">
                 <button type="button" class="btn btn-default btn-sm" Onclick="deleteDevice()">
                   <span class="glyphicon glyphicon-trash"></span> Supprimer
                 </button>
               </div>
            </fieldset>
         </form>
       </div>
       <?php
        }
        else
        {
          header('Location:login.php');
        }
        ?>
    <script src="code.js"></script>
  </body>
</html>
