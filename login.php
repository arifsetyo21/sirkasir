<?php 
session_start();
require 'functions.php';

if (isset($_POST["login"])) {

  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);
  $login    = htmlspecialchars($_POST["login"]);
  
  $result = mysqli_query($conn, "SELECT * FROM karyawan WHERE username = '$username'");

  if ( mysqli_num_rows($result) ) {
    
    //cek password
    $row = mysqli_fetch_assoc($result);
    if ($password == $row["password"]) {
      $id_karyawan = $row["id_karyawan"];
      $_SESSION["login"] = $_POST["login"];
      $_SESSION["id_karyawan"] = $id_karyawan;
  
      if ($row["bagian"] == "kasir") {
        header("Location: dashboard-kasir.php");
        exit;
      } elseif ( $row["bagian"] == "petugas") {
        header("Location: petugas.php");
        exit;   
      } elseif ($row["bagian"] == "admin") {
        header("Location: admin.php");
        exit;
      } else {
        header("Location: login.php");
        exit;
      }
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
 <script defer src="assets/js/all.js"></script>
</head>

<body>
 <section class="section hero is-light is-fullheight">

  <div class="hero-body">
   <div class="container has-text-centered">

    <div class="column is-4 is-offset-4">
     
     <div class="box">
      <h3 class="title has-text-grey">Login</h3>
      <p class="subtitle has-text-grey">Login to Proceed.</p>
      
      <form action="" method="post">

       <div class="field">
        <div class="control has-icons-left has-icon-right">
         <input type="text" class="input" placeholder="Username" name="username" autofocus required>
         <span class="icon is-small is-left">
          <i class="fa fa-user"></i>
         </span>
        </div>
       </div>

       <div class="field">
        <div class="control has-icons-left has-icon-right">
         <input type="password" class="input" placeholder="Password" name="password" required>
         <span class="icon is-small is-left">
          <i class="fa fa-lock"></i>
         </span>
        </div>
       </div>

       <div class="field">
        <button class="button is-block is-info is-fullwidth" name="login">login</button>
       </div>

      </form>
     </div>
     
    </div>

   </div>
  </div>

 </section>
</body>

</html>