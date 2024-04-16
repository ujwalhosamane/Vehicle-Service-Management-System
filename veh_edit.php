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
          <h1> VEHICLE DETAILS EDIT FORM</h1>
          <hr style="height:2px;border-width:0;color:gray;background-color:gray;width:75%">
        </center>

        <?php

        include("connection.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $type = $_POST['Type'];
          $mname = $_POST['Model_Name'];
          $yof = $_POST['Year_Of_Manufacture'];
          $km = $_POST['Km'];
          $color = $_POST['Color'];

          $Vehicle_No = $_SESSION['value'];
          $veh_query1 = "SELECT * FROM `vehicle` WHERE `Vehicle_No` = '$Vehicle_No' limit 1";
          $veh_res = mysqli_query($conn, $veh_query1);
          while ($veh_row = $veh_res->fetch_row()) {
            $veh_query2 = "SELECT `Name` FROM `customer` WHERE `Customer_Id`= '$veh_row[6]' limit 1";
            $veh_res1 = mysqli_query($conn, $veh_query2);
            while ($veh_row1 = $veh_res1->fetch_row()) {
              $Customer_Id = $veh_row1[0];
            }
          }

          if (is_numeric($yof) && is_numeric($km)) {
            $veh_query3 = "UPDATE `vehicle` SET `Type`='$type',`Model_Name`='$mname',`Year_Of_Manufacture`='$yof',`KM`='$km',`Color`='$color' WHERE `Vehicle_No`='$Vehicle_No'";
            $veh_res3 = mysqli_query($conn, $veh_query3);
            if ($veh_res3) {
              echo "<script> alert('Submitted Successfully');
              </script>";
            } else {
              echo "<p class='wrong'>Some error occured!!</p>";
            }
          } else {
            echo "<p class='wrong'>Invalid entry for KM Completed or Year Of Manufacture</p>";
          }
        }
        $Vehicle_No = $_SESSION['value'];
        $veh_query1 = "SELECT * FROM `vehicle` WHERE `Vehicle_No` = '$Vehicle_No' limit 1";
        $veh_res = mysqli_query($conn, $veh_query1);
        while ($veh_row = $veh_res->fetch_row()) {

        ?>




          <div class="center">

            <label> Customer Name:</label>
            <input type="text" name="Model_Name" placeholder="Model Name" size="20" value="
        <?php $veh_query2 = "SELECT `Name` FROM `customer` WHERE `Customer_Id`= '$veh_row[6]' limit 1";
          $veh_res1 = mysqli_query($conn, $veh_query2);
          while ($veh_row1 = $veh_res1->fetch_row()) {
            echo "$veh_row1[0]";
          }

        ?>" disabled />
            <label> Vehicle Number :</label>
            <input type="text" name="Vehicle_Number" placeholder="Name" size="10" value="<?php echo "$veh_row[0]"; ?>" disabled />

            <br><br>
            <label> Vehicle Type :</label>

            <select name="Type" required>
              <?php if ('Sedan' == $veh_row[1]) { ?>
                <option value="Sedan">Sedan</option>
                <option value="SUV">SUV</option>
                <option value="MUV">MUV</option>
                <option value="HatchBack">HatchBack</option><?php } ?>
              <?php if ('SUV' == $veh_row[1]) { ?>
                <option value="SUV">SUV</option>
                <option value="HatchBack">HatchBack</option>
                <option value="MUV">MUV</option>
                <option value="Sedan">Sedan</option><?php } ?>
              <?php if ('MUV' == $veh_row[1]) { ?>
                <option value="MUV">MUV</option>
                <option value="HatchBack">HatchBack</option>
                <option value="SUV">SUV</option>
                <option value="Sedan">Sedan</option><?php } ?>
              <?php if ('HatchBack' == $veh_row[1]) { ?>
                <option value="HatchBack">HatchBack</option>
                <option value="Sedan">Sedan</option>
                <option value="SUV">SUV</option>
                <option value="MUV">MUV</option><?php } ?>
            </select>

            <br><br><br>


            <label> Model Name :</label>
            <input type="text" name="Model_Name" placeholder="Model Name" size="20" value="<?php echo "$veh_row[2]"; ?>" required />

            <br>
            <label> Year Of Manufacture :</label>
            <input type="text" name="Year_Of_Manufacture" placeholder="yyyy" size="4" value="<?php echo "$veh_row[3]"; ?>" required />
            <br>
            <label> Km Completed :</label>
            <input type="text" name="Km" placeholder="Km completed" size="6" value="<?php echo "$veh_row[4]"; ?>" required />
            <br>
            <label> Color :</label>
            <input type="text" name="Color" placeholder="eg.,Black,Red etc." size="6" value="<?php echo "$veh_row[5]";
                                                                                            } ?>" required />
            <button type="submit" class="registerbtn">Update</button>
          </div>
      </div>
    </form>
  </div>
</body>

</html>