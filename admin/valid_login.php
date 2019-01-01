<?php 
session_start();

include_once '../konek.php';
 
   if(isset($_POST['submit'])){

        $user=$_POST['username'];
        $pass=$_POST['pass'];

        $query=$dbkonek->query("select * from user where username='$user' limit 1");
        while ($result=mysqli_fetch_array($query)) {
            $db_p=$result['password'];
            $db_u=$result['username'];
            $db_id_user = $result['id_user'];
        }

        if(password_verify($pass,$db_p)){

            $_SESSION["user"]="$user";
            $_SESSION["pass"]="$pass";
            $_SESSION['id_user'] = "$db_id_user";
            $_SESSION["admin"] = "admin";

            echo"login sukses;";
            header("Location: index.php");
        }else{
                
            echo "<script type='text/javascript'>
                alert('username dan password tidak cocok');
                </script>
                ";
        }
    
    }
           
	?>

</body>
</html>