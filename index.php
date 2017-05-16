<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
  <title>Rancid Web</title>
</head>
<body>
  <?php
  if (!empty($_SESSION['logged_in']))
  {
    ?>
    <!-- <div class="row"> -->
    <!-- <div class="col-md-offset-4 col-md-3 text-center">
    <h1>Rancid Web</h1>
  </div> -->
  <!-- <div class="col-md-offset-1 col-lg-1">
  <button type="button" class="btn btn-default btn-sm" OnClick="location.href='websvn/index.php'">
  <span class="glyphicon glyphicon-list"></span> Websvn
</button>
</div>
<div class="col-lg-1">
<button type="button" class="btn btn-default btn-sm" OnClick="location.href='settings.php'">
<span class="glyphicon glyphicon-cog"></span> Paramètres
</button>
</div>
<div class="col-lg-1">
<button type="button" class="btn btn-default btn-sm" OnClick="location.href='logout.php'">
<span class="glyphicon glyphicon-off"></span> Déconnexion
</button>
</div>
</div>-->
<div class="container">
  <div class="row">
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
</div>
<div class="container">
  <form action="add_device.php" method="post" name="add_device">  <!-- Formulaire ajout d'un device -->
    <legend>Ajouter un équipement</legend>
    <div class="row">
      <div class="col-md-offset-1 col-md-4">
        <div class="form-group">
          <label class="control-label" for="adresse_ip">Adresse IP <em>*</em></label>
          <input type="text" class="form-control" name="ip_device" placeholder="192.168.0.0" autofocus="" required=""/>
        </div>
      </div>
      <div class="col-md-offset-2 col-md-4">
        <div class="form-group">
          <label class="control-label" for="nom">Nom de l'équipement <em>*</em></label>
          <input type="text" class="form-control" name="name_device" placeholder="Device Name" required=""/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-offset-1 col-md-4">
        <div class="form-group">
          <label class="control-label" for="authentification">Authentification <em>*</em></label>
          <input type="text" class="form-control" name="user_device" placeholder="Username" required=""/>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
          <label class="control-label" for="password_device">Mot de passe ssh/telnet <em>*</em></label>
          <input type="password" class="form-control" name="password_device" placeholder="Password" required=""/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-offset-1 col-md-4">
        <div class="form-group">
          <label for="auto_enable">Auto-enable :</label>
          <input type="radio" class="form-control radio-inline" name="autoenable_device" value="oui" id="oui" checked="checked" onclick="passwordEnable()"/>
          <label for="oui" class="text-radio">Oui</label>
          <input type="radio" class="form-control radio-inline" name="autoenable_device" value="non" id="non" onclick="passwordEnable()"/>
          <label for="non" class="text-radio">Non</label>
        </div>
      </div>
      <div class="col-md-offset-2 col-md-4">
        <div id="password_enable" class="form-group">
          <label class="control-label" for="password_enable">Mot de passe enable <em>*</em></label>
          <input id="disabledInput" class="form-control" type="password" name="password_enable" placeholder="Password" required="" disabled/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-offset-1 col-md-4">
        <div class="form-group">
          <label for="connectivite">Connectivité :</label>
          <input type="radio" class="form-control radio-inline" name="connection_device" value="ssh" id="ssh" checked="checked"/>
          <label for="ssh" class="text-radio">SSH</label>
          <input type="radio" class="form-control radio-inline" name="connection_device" value="telnet" id="telnet"/>
          <label for="telnet" class="text-radio">Telnet</label>
        </div>
      </div>
      <div class="col-md-offset-2 col-md-4">
        <div class="form-group">
          <label class="control-label" for="modele_device">Modèle équipement</label>
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
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <button type="submit" class="btn btn-default btn-sm center-block">
            <span class="glyphicon glyphicon-plus-sign"></span> Ajouter
          </button>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="container">
  <div class="row">
    <form action="delete_device.php" method="post" name="delete_device"> <!-- Formulaire de suppression d'un device -->
      <legend>Supprimer un équipement</legend>
      <?php
      shell_exec("cut -d \; -f 1 /usr/local/rancid/var/networking/router.db > data/name_device.txt"); // On récupère les noms des switchs déjà créé et on les stockent dans un fichier
      $name = file('data/name_device.txt');
      foreach($name as $name_del) // On parcours le fichier et on affiche chaque nom
      {
        echo ' <div class="col-md-offset-1 col-md-2">
        <label class="control-label" for="'.$name_del.'">'.$name_del.'</label>
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
    </form>
  </div>
  <div class="row">
    <div class="col-md-offset-4 col-md-4">
      <div class="form-group">
        <button type="button" class="btn btn-default btn-sm center-block" Onclick="deleteDevice()">
          <span class="glyphicon glyphicon-trash"></span> Supprimer
        </button>
      </div>
    </div>
  </div>
</div>
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
<script src="code.js"></script>
</body>
</html>
