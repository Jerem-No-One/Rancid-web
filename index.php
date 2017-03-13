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
       <div>
         <h1>Rancid Web</h1>
         <img src="images/settings.jpg" type="button" onclick="location.href='settings.php'" style="cursor:pointer;">
       </div>
       <form action="add_device.php" method="post" class="add_device" name="add_device">  <!-- Formulaire ajout d'un device -->
         <filedset>
           <legend>Ajouter un équipement</legend>
             <p>
             <div>
               <label for="adresse_ip">Adresse IP <em>*</em></label>
               <input type="text" name="ip_device" placeholder="192.168.0.0" autofocus="" required=""/></br>
             </div>
             <div>
               <label for="nom">Nom de l'équipement<em>*</em></label>
               <input type="text" name="name_device" placeholder="Device Name" required=""/></br>
             </div>
             <div>
               <label for="authentification">Authentification <em>*</em></label>
               <input type="text" name="user_device" placeholder="Username" required=""/></br>
             </div>
             <div>
               <label for="password_device">Mot de passe ssh/telnet <em>*</em></label>
               <input type="password" name="password_device" placeholder="Password" required=""/></br>
             </div>
             <div id="password_enable" class="hidden">
               <label class="password_enable" for="password_enable">Mot de passe enable</label>
               <input class="password_enable" type="password" name="password_enable"/></br>
             </div>
             <div>
               <label for="modele_device">Modèle équipement</label>
               <select name="modele_device">  <!-- Select dynamique -->
             </div>
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
             <div>
               <label for="auto_enable">Auto-enable :</label>
               <input type="radio" name="autoenable_device" value="oui" id="oui" checked="checked" onclick="passwordEnable()"/>
               <label for="oui">Oui</label>
               <input type="radio" name="autoenable_device" value="non" id="non" onclick="passwordEnable()"/>
               <label for="non">Non</label></br>
             </div>
             <div>
               <label for="connectivite">Connectivité :</label>
               <input type="radio" name="connection_device" value="ssh" id="ssh" checked="checked" />
               <label for="ssh">SSH</label>
               <input type="radio" name="connection_device" value="telnet" id="telnet" />
               <label for="telnet">Telnet</label></br>
             </div>
             <div>
               <input type="submit" value="Ajouter" />
             </div>
             </p>
         </filedset>
       </form>
       <form action="delete_device.php" method="post" name="delete_device"> <!-- Formulaire de suppression d'un device -->
         <fieldset>
           <legend>Supprimer un équipement</legend>
             <p>
             <div>
                 <?php
                 shell_exec("cut -d \; -f 1 /usr/local/rancid/var/networking/router.db > data/name_device.txt"); // On récupère les ip des switchs déjà créé et on les stockent dans un fichier
                 $name = file('data/name_device.txt');
                 foreach($name as $name_del) // On parcours le fichier et on affiche chaque ip
                 {
                   echo '<div><input type="checkbox" name="choix[]" id="'.$name_del.'" value="'.$name_del.'"><label for="'.$name_del.'">'.$name_del.'</label><br></div>';
                 }
                 ?>
                 <br>
             </div>
             <div>
              <input type="button" Onclick="deleteDevice()" value="Supprimer">
              <input type="button" OnClick="javascript:window.location.reload()" value="Actualiser">
             </div>
             </p>
          </fieldset>
       </form>
       <a href='logout.php'>Déconnexion</a>
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
