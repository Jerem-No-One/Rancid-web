<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Login</title>
  </head>
  <body>
    <?php
    session_start();
    if (!empty($_POST) && $_POST['password'] && $_POST['password'] === "password" && $_POST['username'] === "user") // Envoi de l'authentification si l'utilisateur n'est pas identifié
    {
      $_SESSION['logged_in'] = true;
       header('Location:index.php');
     }
     else
     {
       ?>
       <form method="post">
         <fieldset>
           <h1>Authentification</h1>
           <div><input type="text" name="username" placeholder="Username" autofocus="" required=""/></div>
           <div><input type="password" name="password" placeholder="Password" required=""/></div>
           <div><input type="submit" value="Connexion" class="btn btn-default btn-sm"/></div>
         </fieldset>
       </form>
       <?php
     }
    ?>
  </body>
</html>
