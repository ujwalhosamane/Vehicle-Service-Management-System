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
          <h1> CAR SERVICE REGISTERING FORM</h1>
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
          $vno = $_POST['Vehicle_Number'];
          $type = $_POST['Type'];
          $mname = $_POST['Model_Name'];
          $yof = $_POST['Year_Of_Manufacture'];
          $km = $_POST['Km'];
          $color = $_POST['Color'];
          $query3 = "SELECT * FROM customer WHERE Name = '$name' and Gender = '$gender' and (Phone = '$phone' OR Email_Id = '$email')and City = '$city' ";
          $query6 = "SELECT * FROM customer WHERE Email_Id = '$email' OR Phone = '$phone' limit 1";
          if (($result1 = mysqli_query($conn, $query3)) && mysqli_num_rows($result1) > 0) {
            $query4 = "SELECT Vehicle_No FROM vehicle WHERE Vehicle_No = '$vno' limit 1";
            if ((mysqli_num_rows($result2 = mysqli_query($conn, $query4)) > 0)) {
              echo "<p class='wrong'>Given data is already present...</p>";
            } else {

              $query = "select customer_id from customer where email_id = '$email' limit 1";
              $result = mysqli_query($conn, $query);
              if ($result) {
                if ($result && mysqli_num_rows($result) > 0) {
                  $row = $result->fetch_row();
                  $customer_id = $row[0];
                  $sql_query2 = "INSERT INTO vehicle (`Vehicle_No`, `Type`, `Model_Name`, `Year_Of_Manufacture`, `KM`, `Color`,`Customer_Id`) VALUES ('$vno', '$type', '$mname', '$yof', '$km', '$color','$customer_id')";
                } else {
                  echo "<p class='wrong'>Data not inserted</p>";
                }
              } else {
                echo "<p class='wrong'>Data not inserted</p>";
              }
              if (mysqli_query($conn, $sql_query2)) {
                include("confirmation.php");
                echo "<script> alert('Submitted Successfully \\n Customer ID for the person '+'$name'+' is '+'$customer_id');
              location.replace('index.php'); 
              </script>";
              } else {
                echo "<p class='wrong'>Data not inserted</p>";
              }
            }
          } else {
            if (mysqli_num_rows($result6 = mysqli_query($conn, $query6)) > 0) {
              echo "<p class='wrong'>Either mobile or email deatil is already present!!</p>";
            } else {
              $sql_query1 = "INSERT INTO customer  (`Customer_Id`, `Name`, `Gender`, `Phone`, `City`, `Email_Id`) VALUES (NULL,'$name','$gender','$phone','$city','$email') ";
              if (mysqli_query($conn, $sql_query1)) {
                $query = "select customer_id from customer where email_id = '$email' limit 1";
                $result = mysqli_query($conn, $query);
                $query5 = "SELECT Vehicle_No FROM vehicle WHERE Vehicle_No = '$vno' limit 1";
                if (mysqli_num_rows($result3 = mysqli_query($conn, $query5)) > 0) {

                  echo "<p class='wrong'>Vehicle details already given...!</p>";
                } else {
                  if ($result) {
                    if ($result && mysqli_num_rows($result) > 0) {
                      //$user_data = mysqli_fetch_assoc($result);
                      $row = $result->fetch_row();
                      $customer_id = $row[0];
                      $sql_query2 = "INSERT INTO vehicle (`Vehicle_No`, `Type`, `Model_Name`, `Year_Of_Manufacture`, `KM`, `Color`,`Customer_Id`) VALUES ('$vno', '$type', '$mname', '$yof', '$km', '$color','$customer_id')";
                    } else {
                      echo "Data Not Insterted";
                    }
                  } else {
                    echo "Data Not Insterted";
                  }
                  if (mysqli_query($conn, $sql_query2)) {
                    include("confirmation.php");
                    echo "<script> alert('Submitted Successfully \\n Customer ID for the person'+'$name'+' is '+'$customer_id');
              location.replace('index.php'); 
              </script>";
                  } else {
                    echo "Data Not Insterted";
                  }
                }
              }
            }
          }
        }
        ?>




        <div class="center">
          <label> Name :</label>
          <input type="text" name="Name" placeholder="Name" size="20" required />
          <br>

          <label> Gender : </label>
          <input type="radio" value="Male" name="gender" checked> Male
          <input type="radio" value="Female" name="gender"> Female
          <input type="radio" value="Other" name="gender"> Other


          <label><br><br> <br>Phone :</label>

          <input type="text" name="phone" placeholder="phone no." size="10" / required>
          <br>
          <label> Email :</label>
          <input type="text" name="Email" placeholder="eg.,abc@xyz.com" size="4" required />

          <br>

          <label> City :</label>
          <input type="text" name="City" placeholder="City" size="20" required />
          <br>
          <label> Vehicle Number :</label>
          <input type="text" name="Vehicle_Number" placeholder="eg.,KA10AZ1234" size="10" required />

          <br><br>
          <label> Vehicle Type :</label>

          <select name="Type" required>
            <option value="Type">Type</option>
            <option value="Sedan" option>Sedan</option>
            <option value="SUV">SUV</option>
            <option value="MUV">MUV</option>
            <option value="HatchBack">HatchBack</option>
          </select>

          <br><br><br>
          <label> Model Name :</label>
          <input type="text" name="Model_Name" placeholder="Model Name" size="20" required />

          <br>
          <label> Year Of Manufacture :</label>
          <input type="text" name="Year_Of_Manufacture" placeholder="yyyy" size="4" required />
          <br>
          <label> Km Completed :</label>
          <input type="text" name="Km" placeholder="Km completed" size="6" required />
          <br>
          <label> Color :</label>
          <input type="text" name="Color" placeholder="eg.,Black,Red etc." completed" size="6" required />
          <button type="submit" class="registerbtn">Register</button>
        </div>
      </div>
    </form>
  </div>
</body>

</html>