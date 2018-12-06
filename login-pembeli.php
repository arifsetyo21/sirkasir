<?php 
session_start();
require 'functions.php';

if (isset($_POST["login"])) {

  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);
  $login    = htmlspecialchars($_POST["login"]);
  
  $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username'");
  // var_dump($result);

  if ( mysqli_num_rows($result)) {
    
    //cek password
    $row = mysqli_fetch_assoc($result);
    if ($password == $row["password"]) {
      $id_pelanggan = $row["id_pelanggan"];
      $_SESSION["login"] = true;
      $_SESSION["id_pelanggan"] = $id_pelanggan;
      $_SESSION["user"] = "pembeli";
  
        header("Location: dashboard-pembeli.php");
        exit;
      } else {
      echo "<script>
          alert('password tidak cocok');
            </script>";
      }
    } else {
      echo "<script>
      alert('username tidak ditemukan');
      </script>";
    }
  
    
}

 ?>
<!DOCTYPE html>
<html>

<head>
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1" />
 <title>Login!</title>
 <link rel="stylesheet" href="assets/css/bulma.min.css" />
 <link rel="stylesheet" href="assets/css/tabs.css" />
 <script defer src="assets/js/all.js"></script>
</head>

<body>
 <section class="section hero is-light is-fullheight">

  <div class="hero-body is-paddingless">
   <div class="container has-text-centered">

    <div class="column is-4 is-offset-4">
     
     <div style="padding:25px">
      <img src="assets/img/logo.png" alt="">
     </div>
     
     <div class="box">
      
      <div class="tabs is-boxed is-centered main-menu is-fullwidth" id="nav">
       <ul>
        <li data-target="pane-1" id="1" style="width:50%" class="is-active">
         <a>
          <span class="icon is-small"><i class="fas fa-utensils"></i></span>
          <span>Makan Sini</span>
         </a>
        </li>
        <li data-target="pane-2" id="2" style="width:50%">
         <a>
          <span class="icon is-small"><i class="fas fa-shopping-bag"></i></span>
          <span>Bungkus</span>
         </a>
        </li>
       </ul>
      </div>

      <div class="tab-content">
       <div class="tab-pane is-active" id="pane-1" class="level">
        <form action="" method="post">
         <div class="field">
          <div class="control has-icons-left has-icons-right">
           <input type="text" class="input" placeholder="Meja" autofocus name="meja">
           <span class="icon is-medium">
            <i class="fa fa-th-large"></i>
           </span>
          </div>
         </div>

         <div class="field">
          <div class="control has-icons-left">
           <input type="text" class="input" placeholder="User ID" autofocus name="username">
           <span class="icon is-medium is-left">
            <i class="fa fa-user"></i>
           </span>
          </div>
         </div>

         <div class="field">
          <div class="control has-icons-left">
           <input type="password" class="input" placeholder="Password" name="password">
           <span class="icon is-medium is-left">
            <i class="fa fa-lock"></i>
           </span>
          </div>
         </div>

         <div class="field">
          <button class="button is-block is-info is-fullwidth" name="login">Login</button>
         </div>

        </form>
       </div>

       <div class="tab-pane" id="pane-2">
        <form action="" method="post">

         <div class="field">
          <div class="control has-icons-left">
           <input type="text" class="input" placeholder="User ID" autofocus name="username">
           <span class="icon is-medium is-left">
            <i class="fa fa-user"></i>
           </span>
          </div>
         </div>

         <div class="field">
          <div class="control has-icons-left">
           <input type="password" class="input" placeholder="Password" name="password">
           <span class="icon is-medium is-left">
            <i class="fa fa-lock"></i>
           </span>
          </div>
         </div>

         <div class="field">
          <button class="button is-block is-info is-fullwidth" name="login">Login</button>
         </div>

        </form>
       </div>
      </div>
      
     </div>
     
    </div>

   </div>
  </div>

 </section>

 <script src="assets/js/bulma.js"></script>
 <script src="assets/js/tabs.js"></script>

</body>

</html>