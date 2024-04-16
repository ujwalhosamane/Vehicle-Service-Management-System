<?php
    session_start();
  if(isset($_SESSION['Email'])){
      header("location:index.php");
  }
  ?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Page in HTML with CSS Code Example</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="box-form">
    <form method="post">
      <div class="right">
        <h5>Login</h5>
        <!--	<p>Don't have an account? <a href="#">Creat Your Account</a> it takes less than a minute</p>	-->
        <?php

        include("connection.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          //something was posted
          $email = $_POST['email'];
          $password = $_POST['pswrd'];

          if (!empty($email) && !empty($password)) {

            //read from database
            $query = "select * from employee where email_id = '$email' limit 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
              if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password && $user_data['Branch_Id'] === "101" && $user_data['Dept_No'] === "12") {
                  $_SESSION['Email'] = $email;
                  $_SESSION['usr_type'] = "admin";
                  header("Location: index.php");
                  die;
                } elseif ($user_data['password'] === $password) {
                  $_SESSION['Email'] = $email;
                  unset($_SESSION['usr_type']);
                  header("Location: index.php");
                }
              }
            }

            echo "<p class='wrong'>Invalid email or password!</p>";
          } else {
            echo "<p class='wrong'>Invalid email or password!</p>";
          }
        }

        ?>
        <div class="inputs">
          <label for="email"><b>Email</b></label>
          <br>
          <input type="email" placeholder="Email Id" name="email" required>
          <br><br><br>
          <label for="pswrd"><b>Password</b></label>
          <br>
          <input type="password" placeholder="Password" name="pswrd" required>
        </div>
        <br>
        <!--<button><a href="./login.php">Login</a></button>-->
        <input type="submit" name="submit" class="button" placeholder="Logi">
      </div>

    </form>
  </div>
  <!-- partial -->

</body>

<style>
  body {
    background-image: url(./images/bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: "Open Sans", sans-serif;
    color: #333333;
    color: black;
  }

  .box-form {
    margin: 0 auto;
    width: 50%;
    backdrop-filter: blur(10px);
    background: transparent;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex: 1 1 100%;
    align-items: stretch;
    justify-content: space-between;
    box-shadow: 0 0 20px 6px #090b6f85;
  }

  @media (max-width: 980px) {
    .box-form {
      flex-flow: wrap;
      text-align: center;
      align-content: center;
      align-items: center;
    }
  }

  form {
    margin: auto;
  }

  .box-form div {
    height: auto;
  }

  .box-form .left {
    color: black;
    margin: auto;
    width: 40%;
  }

  .box-form .left .overlay {
    padding: 30px;
    width: 100%;
    height: 100%;
    background: #5961f9ad;
    overflow: hidden;
    box-sizing: border-box;
  }

  .box-form .left .overlay h1 {
    font-size: 7.2vmax;
    line-height: 1;
    font-weight: 900;
    margin-top: 40px;
    margin-bottom: 20px;
  }

  .box-form .right {
    padding: 40px;
    overflow: hidden;
    display: flex;
    flex-flow: column;
    align-items: center;
  }

  @media (max-width: 980px) {
    .box-form .right {
      width: 100%;
    }
  }

  .box-form .right h5 {
    font-size: 4rem;
    text-align: center;
    text-decoration: underline;
  }

  .box-form .right p {
    font-size: 14px;
    color: #B0B3B9;
  }

  .box-form .right .inputs {
    overflow: hidden;
  }

  .box-form .right input {
    padding: 10px;
    margin-top: 25px;
    border-radius: 5px;
    font-size: 16px;
    border: none;
    outline: none;
    border-bottom: 2px solid #B0B3B9;
  }

  .box-form .right .remember-me--forget-password {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .box-form .right .remember-me--forget-password input {
    margin: 0;
    margin-right: 7px;
    width: auto;
  }

  .box-form .right .button {
    color: #fff;
    font-size: 16px;
    padding: 12px 35px;
    border-radius: 50px;
    display: inline-block;
    border: 0;
    outline: 0;
    box-shadow: 0px 4px 20px 0px #49c628a6;
    background-image: linear-gradient(135deg, #70F570 10%, #49C628 100%);
  }

  .remember-me--forget-password label {
    display: block;
    position: relative;
    margin-left: 30px;
  }

  .remember-me--forget-password label::before {
    content: ' \f00c';
    position: absolute;
    font-family: FontAwesome;
    background: transparent;
    border: 3px solid #70F570;
    border-radius: 4px;
    color: transparent;
    left: -30px;
    transition: all 0.2s linear;
  }

  .remember-me--forget-password label:hover::before {
    font-family: FontAwesome;
    content: ' \f00c';
    color: #fff;
    cursor: pointer;
    background: #70F570;
  }

  .inputs label {
    position: relative;
    right: -2%;
    font-size: 20px;
  }

  label:hover::before .text-checkbox {
    background: #70F570;
  }

  label span.text-checkbox {
    display: inline-block;
    height: auto;
    position: relative;
    cursor: pointer;
    transition: all 0.2s linear;
  }

  label input[type="checkbox"] {
    display: none;
  }

  /*linear-gradient(135deg, #FAB2FF 10%, #1904E5 100%);*/

  ul.A {
    list-style-type: square;
    font-size: 28px;
  }

  ul.B {
    font-size: 18px;
  }

  ul.C {
    font-size: 18px;
  }

  ul p {
    font-size: 18px;
  }

  .button:hover {
    opacity: 0.8;
  }
</style>

</html>