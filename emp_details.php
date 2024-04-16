<?php
session_start();
if (!isset($_SESSION['Email'])) {
  header("location:login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    form {
      margin: auto;
      width: 60%;
      overflow: hidden;
      align-items: stretch;
      box-shadow: 0 0 20px 6px #090b6f85;
      border-radius: 10px;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-color: whitesmoke;
    }

    * {
      box-sizing: border-box;
    }

    input {
      width: 75%S;
    }

    .container {
      padding: 4px;
      border-radius: 10px;
      margin: 25px;
      background-color: white;
      display: flex;
      flex-flow: column;
    }

    label {
      font-weight: bolder;
    }

    input[type=text] {
      padding: 15px;
      margin: 5px 0 22px 0;
      display: block;
      border: none;
      background: #f1f1f1;
      border: 3px solid #ccc;
      width: 30rem;
      margin-top: 6px;
    }

    input[type=email] {
      padding: 15px;
      margin: 5px 0 22px 0;
      display: block;
      border: none;
      background: #f1f1f1;
      border: 3px solid #ccc;
      width: 30rem;
      margin-top: 6px;
    }

    input[type=password] {
      padding: 15px;
      margin: 5px 0 22px 0;
      display: block;
      border: none;
      background: #f1f1f1;
      border: 3px solid #ccc;
      width: 30rem;
      margin-top: 6px;
    }

    input[type=text]:focus {
      background-color: #ddd;
      outline: none;
      border: 3px solid #555;
    }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    div {
      padding: 10px 0;
    }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    .registerbtn {
      background-color: #04AA6D;
      color: white;
      padding: 16px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      opacity: 0.9;
    }

    .registerbtn:hover {
      opacity: 1;
    }

    .center {
      display: inline-block;
      text-align: left;
      margin: auto;
    }

    .background .container .center #branch {
      box-sizing: content-box;
      height: 5%;
    }

    .background .container .wrong {
      color: red;
      text-align: center;
      font-size: 125%;
    }
  </style>
</head>

<body>
  <div class="background">
    <form method="post">
      <div class="container">
        <center>
          <h1>New Employee Register</h1>
          <hr style="height:2px;border-width:0;color:gray;background-color:gray;width:75%">
        </center>
        <?php

        include("connection.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          include("store_emp.php");
        }
        ?>
        <div class="center">
          <label for="Branch">Branch : </label>
          <select name="Branch" id="Branch" required>
            <option value=none option>Branch Name</option>

            <?php include("branch.php"); ?>

            <label for="Dept">Department : </label>
            <select name="Department" id="Dept" required>
              <option value=none option>Department</option>

              <?php include("department.php") ?>

              <label>Employee ID :</label>
              <input type="text" name="Emp_No" placeholder="eg., 1234" size="6" required />
              <br>

              <label> Name :</label>
              <input type="text" name="Name" placeholder="Name" required />

              <label><br>Phone :</label>

              <input type="text" name="Phone" placeholder="eg., 1234567890" size="10" required />
              <br>

              <br>

              <label> Date Of Birth :</label>
              <input type="date" name="DOB" placeholder="DD/MM/YYYY" required />

              <br><br><br>

              <label> Gender : </label>
              <input type="radio" value="Male" name="gender" checked> Male
              <input type="radio" value="Female" name="gender"> Female
              <input type="radio" value="Other" name="gender"> Other



              <br><br><br>
              <label> Email :</label>
              <input type="email" name="Emp_Email" placeholder="xyz@xyz.com" size="20" required />
              <br>
              <label> Password :</label>
              <input type="password" name="Password" placeholder="**********" size="15" required />

              <br>
              <button type="submit" class="registerbtn">Submit</button>
        </div>
      </div>
    </form>
  </div>
</body>

</html>