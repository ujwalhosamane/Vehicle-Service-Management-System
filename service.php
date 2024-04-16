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
      border-radius: 10px;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-image: url(./bg1.jpg);
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
          <h1>Service Registration Form</h1>
          <hr style="height:2px;border-width:0;color:gray;background-color:gray;width:75%">
        </center>
        <?php

        include("connection.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $Branch = $_POST['Branch'];
          $Service_Type = $_POST['Service_type'];
          $Date = $_POST['Date'];
          $Payment_Status = $_POST['Payment'];
          $Amount = $_POST['Amount'];
          $Vehicle_Number = $_POST['Vehicle_Number'];
          $_SESSION['Date'] = $Date;
          $_SESSION['Vehicle_Number'] = $Vehicle_Number;

          $query1 = "select Vehicle_No from vehicle where  Vehicle_No = '$Vehicle_Number' limit 1";
          $result = mysqli_query($conn, $query1);

          $query7 = "select * from services where  Vehicle_No = '$Vehicle_Number' AND `Payment_Status` = 'Pending' limit 1";
          if (mysqli_num_rows($veh_check = mysqli_query($conn, $query7)) > 0) {

            echo "<p class='wrong'>Old payment is pending for this vehicle</p>";
          } else {
            if ($result) {
              if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['Vehicle_No'] === $Vehicle_Number) {

                  if (is_numeric($Amount)) {
                    $query2 = "SELECT Branch_Id FROM branch WHERE Branch_Name = '$Branch' limit 1";
                    $query3 = "SELECT Vehicle_No FROM vehicle WHERE Vehicle_No = '$Vehicle_Number' limit 1";
                    if (($result1 = mysqli_query($conn, $query2)) && ($result2 = mysqli_query($conn, $query3)) && mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0) {
                      $row1 = $result1->fetch_row();
                      $Branch = $row1[0];
                      $row2 = $result2->fetch_row();
                      $Vehicle_Number = $row2[0];
                      $query4 = "INSERT INTO `services` (`Service_No`, `Service_Type`, `Date`, `Amount`, `Payment_Status`, `Brach_Id`, `Vehicle_No`) VALUES (NULL, '$Service_Type', '$Date', '$Amount', '$Payment_Status', '$Branch', '$Vehicle_Number')";
                      $res = mysqli_query($conn, $query4);
                      if ($res) {
                        include("confirmation1.php");
                        echo "<script> alert('Submitted Successfully \\n Service Number for Vehicle '+'$Vehicle_Number'+' is '+'$Service_Number');
                            location.replace('index.php'); 
                                </script>";
                      } else {
                        echo "<p class='wrong'>Something went wrong!!!</p>";
                      }
                    } else {
                      echo "<p class='wrong'>Something went wrong!!!</p>";
                    }
                  } else {
                    echo "<p class='wrong'>Invalid Amount value entered...</p>";
                  }
                } else {
                  echo "<p class='wrong'>Vehicle Number not registered with us...</p>";
                }
              } else {
                echo "<p class='wrong'>Vehicle Number not registered with us...</p>";
              }
            }
          }
        }

        ?>
        <div class="center">
          <label for="Branch">Branch : </label>
          <select name="Branch" id="Branch" required>
            <option value=none option>Branch Name</option>
            <?php include("branch.php"); ?>

            <label> Service Type:</label>
            <input type="text" name="Service_type" placeholder="Service Name" size="20" required />
            <br>

            <label> Date :</label>
            <input type="date" name="Date" placeholder="DD/MM/YYYY" required />

            <br><br><br>


            <label> Payment Status </label>
            <input type="radio" value="Pending" name="Payment" checked> Pending
            <input type="radio" value="Successful" name="Payment"> Successful


            <label><br><br> <br>Amount to be paid :</label>

            <input type="text" name="Amount" placeholder="Rs.1234" size="7" required />
            <br>

            <label> Vehicle Number :</label>
            <input type="text" name="Vehicle_Number" placeholder="eg.,KA10AZ1234" size="10" required />

            <br>
            <button type="submit" class="registerbtn">Register</button>
        </div>
      </div>
    </form>
  </div>
</body>

</html>