<?php 
session_start();
require 'functions.php';

if (isset($_POST["login"])) {

  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);
  $login    = htmlspecialchars($_POST["login"]);
  
  $result[] = mysqli_query($conn, "SELECT * FROM karyawan WHERE username = '$username'");
  $result[] = mysqli_query($conn, "SELECT * FROM penjual WHERE username = '$username'");
  // var_dump($result);

  if ( mysqli_num_rows($result[0])) {
    
    //cek password
    $row = mysqli_fetch_assoc($result[0]);
    if ($password == $row["password"]) {
      $id_karyawan = $row["id_karyawan"];
      $_SESSION["login"] = true;
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
  } elseif ( mysqli_num_rows($result[1]) ) {
    $row = mysqli_fetch_assoc($result[1]);
    if ($password == $row["password"]) {
      $id_penjual = $row["id_penjual"];
      $_SESSION["login"] = true;
      $_SESSION["id_penjual"] = $id_penjual;
      $_SESSION["user"] = "employe";

      header("Location: dashboard-penjual.php");
      }else {
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
      <p class="title is-1">Sign In</p>
      <p class="subtitle is-3">for our seller & employee</p>
      <div class="tab-content">
       <div class="tab-pane is-active" id="pane-1" class="level">
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