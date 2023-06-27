<?php
include 'condb.php';
session_start();
if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $tag = "Admin";

   $select = mysqli_query($conn, "SELECT * FROM accounts WHERE Email = '$email' AND account_Password = '$pass'") or die('query failed');
   $admin = mysqli_query($conn, "SELECT * FROM accounts WHERE Email = '$email' AND account_Password = '$pass' AND account_Tag = '$tag'") or die('query failed');

   if(mysqli_num_rows($select) >0){ 
    header('location:records.php');
    $_SESSION['username'] = $email; 
      if(mysqli_num_rows($admin) > 0){
          header('location:dashboard.php');
          $_SESSION['username'] = $email;
        } 
      }
      else{ 
        $message[] = 'incorrect email or password!'; 
        } 
} 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="home.css" />
    <link rel="icon" href="img/UMakLogo.png" />
    <title>UMAK Verification System</title>
  </head>
  <body style="background-image: url(img/UMakBG.jpg)">
    <div class="blueContainer"></div>
    <img class="umaklogo" src="img/UMakLogo.png" alt="UMak Logo" />
    <img src="img/white-bg.jpg" alt="" class="whiteContainer" />
    <div class="logIn">
      <div class="upperText">
        <div class="yellowText"><p class="big">ALUMNI</p></div>
        <p class="small">VERIFICATION SYSTEM</p>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <p class="username">EMAIL</p>

        <input
          class="userInput"
          type="text"
          name="username"
          placeholder="Enter Email"
          required
        />

        <p class="password">PASSWORD</p>
        <input
          class="input-text"
          id="password"
          type="password"
          name="password"
          placeholder="Enter Password"
          required
        />
        <i class="fa fa-eye-slash" id="togglePassword"></i>

        <div class="buttonCenter">
          <input
            type="submit"
            class="submitButton"
            name="submit"
            value="LOG IN"
          />
        </div>
      </form>

      <script>
        // const togglePassword = document.querySelector("#togglePassword");
        // const password = document.querySelector("#password");

        // togglePassword.addEventListener("click", function () {
        //   // toggle the type attribute
        //   const type =
        //     password.getAttribute("type") === "password" ? "text" : "password";
        //   password.setAttribute("type", type);

        //   // toggle the icon
        //   this.classList.toggle("fa fa-eye");
        // });

        // // const showHidePassword = () => {
        // //   if (password.type == "password"){
        // //     password.type = "text";
        // //     togglePassword.classList.add("fa-eye-slash");
        // //   }
        // //   else {
        // //     password.type = "password";
        // //     togglePassword.classList.remove("fa-eye-slash");
        // //   }
        // // };
        // // togglePassword.addEventListener("click", showHidePassword);

        // // prevent form submit
        // const form = document.querySelector("form");
        // form.addEventListener("submit", function (e) {
        //   e.preventDefault();
        // });
      </script>
      
    </div>
  </body>
</html>
