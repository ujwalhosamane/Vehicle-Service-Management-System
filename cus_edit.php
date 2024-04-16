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
          <h1> Customer Edit Form</h1>
          <hr style="height:2px;border-width:0;color:gray;background-color:gray;width:75%">
        </center>

        <?php

        include("connection.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $name = $_POST['Name'];
          $gender = $_POST['gender'];
          $phone = $_POST['phone'];
          $city = $_POST['City'];
          $email = $_POST['Email'];

          $Customer_Id = $_SESSION['value'];
          $cus_query1 = "SELECT * FROM `customer` WHERE `Customer_Id` = '$Customer_Id' limit 1";
          $cus_res = mysqli_query($conn, $cus_query1);

          $query1 = "SELECT * FROM customer WHERE Name = '$name' and Gender = '$gender' and (Phone = '$phone' AND Email_Id = '$email')and City = '$city' AND `Customer_Id` != '$Customer_Id' ";
          if (($result1 = mysqli_query($conn, $query1)) && mysqli_num_rows($result1) > 0) {
            echo "<p class='wrong'>Data alredy present</p>";
          } else {
            $query2 = "SELECT * FROM customer WHERE (Phone = '$phone' OR Email_Id = '$email')AND `Customer_Id` != '$Customer_Id'";
            if (($result2 = mysqli_query($conn, $query2)) && mysqli_num_rows($result2) > 0) {
              echo "<p class='wrong'>Either mobile or email deatil is already present!!</p>";
            } else {
              if (is_numeric($phone)) {
                $query3 = "UPDATE `customer` SET `Name`='$name',`Gender`='$gender',`Phone`='$phone',`City`='$city',`Email_Id`='$email' WHERE `Customer_Id` = '$Customer_Id' ";
                if ($result3 = mysqli_query($conn, $query3)) {
                  echo "<script> alert('Submitted Successfully');
                location.replace('action.php'); 
              </script>";
                } else {
                  echo "<p class='wrong'>Some Error Occured!!</p>";
                }
              } else {
                echo "<p class='wrong'>Some Error Occured!!</p>";
              }
            }
          }
        }

        $Customer_Id = $_SESSION['value'];
        $cus_query1 = "SELECT * FROM `customer` WHERE `Customer_Id` = '$Customer_Id' limit 1";
        $cus_res = mysqli_query($conn, $cus_query1);
        while ($cus_row = $cus_res->fetch_row()) {
        ?>


          <div class="center">
            <label> Customer Id :</label>
            <input type="text" name="Name" placeholder="Name" size="20" value="<?php echo "$cus_row[0]"; ?>" disabled />
            <br>

            <label> Name :</label>
            <input type="text" name="Name" placeholder="Name" size="20" value="<?php echo "$cus_row[1]"; ?>" required />
            <br>

            <label> Gender : </label>
            <input type="radio" value="Male" name="gender" <?php if ('Male' == $cus_row[2]) {
                                                              echo "checked";
                                                            } ?>> Male
            <input type="radio" value="Female" name="gender" <?php if ('Female' == $cus_row[2]) {
                                                                echo "checked";
                                                              } ?>> Female
            <input type="radio" value="Other" name="gender" <?php if ('Other' == $cus_row[2]) {
                                                              echo "checked";
                                                            } ?>> Other


            <label><br><br> <br>Phone :</label>

            <input type="text" name="phone" placeholder="phone no." size="10" value="<?php echo "$cus_row[3]"; ?>" required>
            <br>
            <label> Email :</label>
            <input type="text" name="Email" placeholder="eg.,abc@xyz.com" size="4" value="<?php echo "$cus_row[5]"; ?>" required />

            <br>

            <label> City :</label>
            <input type="text" name="City" placeholder="City" size="20" value="<?php echo "$cus_row[4]";
                                                                              } ?>" required />
            <br>
            <button type="submit" class="registerbtn">Register</button>
          </div>
      </div>
    </form>
  </div>
</body>

</html>