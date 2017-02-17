<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Rancid Web</title>
  </head>
  <body>
    <?php
    if (!isset($_POST['password']) OR $_POST['password'] != "password") // Envoi de l'authentification si l'utilisateur n'est pas identifié
    {
    ?>
    <form action="index.php" method="post" class="align-center">
      <p>Veuillez saisir le mot de passe :</p>
      <div><input type="password" name="password" /></div>
      <div><input type="submit" value="Valider" /></div>
    </form>
    <?php
    /*}
    elseif(isset($_POST['password']) AND $_POST['password'] != "b2msab2msa")  // Mauvais mot de passe
    {
      echo '<p>Mot de passe incorrect</p>';
      echo '<input type="button" value="Retour" onclick="history.go(-1)">';*/
    }
    elseif(isset($_POST['password']) AND $_POST['password'] == "password") // Envoi du formulaire pour l'utilisateur authentifié
    {
       ?>
       <h1>Rancid Web</h1>
       <form action="add_device.php" method="post" class="add_device">  <!-- Formulaire ajout d'un device -->
         <script type="text/javascript">
         function passwordEnable() {
           if(document.getElementById('oui').checked == true){
             document.getElementById('password_enable').style.display = "none";
           }else if (document.getElementById('non').checked == true){
             document.getElementById('password_enable').style.display = "block";
           }
         }
         function deleteDevice() {
           var txt;
           var r = confirm("Voulez-vous vraiment suppimer?");
           if (r == true) {
             txt = "You pressed OK!";
           } else {
             txt = "You pressed Cancel!";
           }
           document.getElementById("demo").innerHTML = txt;
         }
         </script>
         <filedset>
           <legend class="titre">Ajouter un équipement</legend>
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
               <input type="password" name="password_device" required=""/></br>
             </div>
             <div id="password_enable">
               <label class="password_enable" for="password_enable">Mot de passe enable</label>
               <input class="password_enable" type="password" name="password_enable"/></br>
             </div>
             <div>
               <label for="modele_device">Modèle équipement</label>
               <select name="modele_device">  <!-- Select dynamique -->
             </div>
                  <?php
                  shell_exec("cut -d \; -f 1 /usr/local/rancid/etc/rancid.types.base | uniq > /var/www/rancid-web/data/modele.txt"); // On récupère les modèles qui sont les configurations de rancid et on les sockent dans un fichier
                  shell_exec(" sed -i -e '/#/ d' /var/www/rancid-web/data/modele.txt"); // On supprime les caractères # du fichier créé
                  $modele = file('/var/www/rancid-web/data/modele.txt');
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
       <form action="delete_device.php" method="post" class="delete_device"> <!-- Formulaire de suppression d'un device -->
         <fieldset>
           <legend class="titre">Supprimer un équipement</legend>
             <p>
             <div>
               <!--<label for="name">Nom de l'équipement</label></br>
               <select name="name_del">-->

                 <?php
                 shell_exec("cut -d \; -f 1 /usr/local/rancid/var/networking/router.db > /var/www/rancid-web/data/name_device.txt"); // On récupère les ip des switchs déjà créé et on les stockent dans un fichier
                 $name = file('/var/www/rancid-web/data/name_device.txt');
                 foreach($name as $name_del) // On parcours le fichier et on affiche chaque ip
                 {
                   #echo '<option value="'.$name_del.'">'.$name_del.'</option>';
                   echo '<div id="checkbox_css"><input type="checkbox" name="choix[]" id="'.$name_del.'" value="'.$name_del.'"><label for="'.$name_del.'">'.$name_del.'</label><br></div>';
                 }
                 ?>
               </select></br>
             </div>
             <div>
               <!--<input type="submit" value="Supprimer" />-->
               <input type="button" Onclick="deleteDevice()" value="Supprimer">

               <input type="button" OnClick="javascript:window.location.reload()" value="Actualiser">
             </div>
             </p>
          </fieldset>
       </form>
       <?php
        }
        ?>
  </body>
</html>
