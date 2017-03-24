<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <title>Login</title>
  </head>
  <script type="text/javascript" src="code.js"></script>
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
         <div class="container">
           <div class="row">
             <div class="text-center">
               <h1>Authentification</h1>
             </div>
           </div>
           <div class="row">
             <div class="text-center">
               <input type="text" name="username" placeholder="Username" autofocus="" required=""/>
             </div>
           </div>
           <div class="row">
             <div class="text-center">
               <input type="password" name="password" placeholder="Password" required=""/>
             </div>
           </div>
           <div class="row">
             <div class="text-center">
               <input type="submit" value="Connexion" class="btn btn-default btn-sm"/>
             </div>
           </div>
         </div>
       </form>
       <?php
     }
    ?>
  </body>
</html>
