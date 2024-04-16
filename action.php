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
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-image: url(./bg1.jpg);
    }


    form {
      margin: auto;
      width: 90%;
      overflow: hidden;
      align-items: stretch;
      border-radius: 10px;
    }

    * {
      box-sizing: border-box;
    }

    input {
      width: 75%S;
    }

    .container {
      padding: 4px;
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

    input[type=radio] {
      display: block;
      border: none;
      width: 20rem;
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

    .button1 {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="background">
    <form method="post">
      <div class="container">
        <center>
          <h1>EDIT THE DETAILS</h1>
          <hr style="height:2px;border-width:0;color:gray;background-color:gray;width:75%">
        </center>
        <?php

        include("connection.php");



        ?>
        <div class="center">
          <label for="Table" style="font-size:25px;"><strong>Select Table : </strong></label>
          <input type="radio" value="customer" name="Table"> Customer<br>
          <input type="radio" value="service" name="Table"> Service<br>
          <input type="radio" value="vehicle" name="Table"> Vehicle<br>
          <input type="radio" value="employee" name="Table"> Employee<br>

          <br><br><br>

          <label for="Action" style="font-size:25px;"><strong>Select Action Type : </strong></label>
          <br> <input type="radio" value="edit" name="Action" checked> Edit<br>
          <input type="radio" value="delete" name="Action"> Delete<br>
          <button type="submit" class="registerbtn">Register</button>
        </div>


        <?php
        if (isset($_POST['service'])) {
          $array = $_POST['service'];
          $arrayLength = count($array);
          $i = 0;
          while ($i < $arrayLength) {
            $Service_No = $array[$i];
            $sql_query = "DELETE FROM `services` WHERE `services`.`Service_No` =  '$Service_No'";
            if ($sql_result = mysqli_query($conn, $sql_query)) {
              $i++;
            } else {
              echo "<p class='wrong'>Some error occured!!</p>";
            }
          }
        } elseif (isset($_POST['customer'])) {
          $array = $_POST['customer'];
          $arrayLength = count($array);
          $i = 0;
          while ($i < $arrayLength) {
            $Customer_Id = $array[$i];
            $sql_query = "DELETE FROM `customer` WHERE `customer`.`Customer_Id` =  '$Customer_Id'";
            if ($sql_result = mysqli_query($conn, $sql_query)) {
              $i++;
            } else {
              echo "<p class='wrong'>Some error occured!!</p>";
            }
          }
        } elseif (isset($_POST['vehicle'])) {
          $array = $_POST['vehicle'];
          $arrayLength = count($array);
          $i = 0;
          while ($i < $arrayLength) {
            $Vehicle_No = $array[$i];
            $sql_query = "DELETE FROM `vehicle` WHERE `vehicle`.`Vehicle_No` =  '$Vehicle_No'";
            if ($sql_result = mysqli_query($conn, $sql_query)) {
              $i++;
            } else {
              echo "<p class='wrong'>Some error occured!!</p>";
            }
          }
        } elseif (isset($_POST['employee'])) {
          $array = $_POST['employee'];
          $arrayLength = count($array);
          $i = 0;
          while ($i < $arrayLength) {
            $Emp_No = $array[$i];
            $sql_query = "DELETE FROM `employee` WHERE `employee`.`Emp_No` =  '$Emp_No'";
            if ($sql_result = mysqli_query($conn, $sql_query)) {
              $i++;
            } else {
              echo "<p class='wrong'>Some error occured!!</p>";
            }
          }
        } elseif (isset($_POST['emp'])) {
          $_SESSION['value'] = $_POST['emp'];
          header("location:emp_edit.php");
        } elseif (isset($_POST['ser'])) {
          $_SESSION['value'] = $_POST['ser'];
          header("location:ser_edit.php");
        } elseif (isset($_POST['cus'])) {
          $_SESSION['value'] = $_POST['cus'];
          header("location:cus_edit.php");
        } elseif (isset($_POST['veh'])) {
          $_SESSION['value'] = $_POST['veh'];
          header("location:veh_edit.php");
        }


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          echo '<hr style="height:2px;border-width:0;color:gray;background-color:gray;width:75%">';
          $action_type = $_POST['Action'];
          $action_table = $_POST['Table'];
          if ($action_type == 'delete') {
            if ($action_table == 'service') { ?>


              <form method="POST">
                <?php
                $query = "SELECT * FROM services ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }
                echo '<th>Select</th>';
                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }
                  echo '<td><input type="checkbox" name="service[]" value="' . $row['Service_No'] . '"/>    &nbsp;   </td>';
                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Delete">
              </form>

            <?php
            } elseif ($action_table == 'customer') {
            ?>


              <form method="POST">
                <?php
                $query = "SELECT * FROM customer ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }
                echo '<th>Select</th>';
                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }
                  echo '<td><input type="checkbox" name="customer[]" value="' . $row['Customer_Id'] . '"/>    &nbsp;   </td>';
                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Delete">
              </form>

            <?php

            } elseif ($action_table == 'vehicle') {
            ?>


              <form method="POST">
                <?php
                $query = "SELECT * FROM vehicle ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }
                echo '<th>Select</th>';
                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }
                  echo '<td><input type="checkbox" name="vehicle[]" value="' . $row['Vehicle_No'] . '"/>    &nbsp;   </td>';
                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Delete">
              </form>

            <?php

            } elseif ($action_table == 'employee') {
            ?>


              <form method="POST">
                <?php
                $query = "SELECT * FROM employee ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }
                echo '<th>Select</th>';
                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }
                  echo '<td><input type="checkbox" name="employee[]" value="' . $row['Emp_No'] . '"/>    &nbsp;   </td>';
                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Delete">
              </form>

            <?php

            } else {
              echo "<p class='wrong'>Some error occured!!</p>";
            }
          } elseif ($action_type == 'edit') {
            if ($action_table == 'service') {
            ?>
              <form method="POST">
                <?php
                $query = "SELECT * FROM `services` ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                echo '<th style="width:9%;">Select</th>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }

                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  echo '<td><input type="radio" style="width:50%;" name="ser" value="' . $row['Service_No'] . '"/>    &nbsp;   </td>';
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }

                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Edit">
              </form>

            <?php

            } elseif ($action_table == 'employee') {
            ?>
              <form method="POST">
                <?php
                $query = "SELECT * FROM `employee` ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                echo '<th style="width:9%;">Select</th>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }

                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  echo '<td><input type="radio" style="width:50%;" name="emp" value="' . $row['Emp_No'] . '"/>    &nbsp;   </td>';
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }

                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Edit">
              </form>

            <?php

            } elseif ($action_table == 'customer') {
            ?>
              <form method="POST">
                <?php
                $query = "SELECT * FROM `customer` ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                echo '<th style="width:9%;">Select</th>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }

                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  echo '<td><input type="radio" style="width:50%;" name="cus" value="' . $row['Customer_Id'] . '"/>    &nbsp;   </td>';
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }

                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Edit">
              </form>

            <?php

            } elseif ($action_table == 'vehicle') {
            ?>
              <form method="POST">
                <?php
                $query = "SELECT * FROM `vehicle` ";
                $res = mysqli_query($conn, $query);
                $all_property = array();

                echo '<table class="data-table"><thead>';
                echo '<th style="width:9%;">Select</th>';
                while ($property = mysqli_fetch_field($res)) {
                  echo '<th>' . $property->name . '</th>';
                  array_push($all_property, $property->name);
                }

                echo '</thead>';

                while ($row = mysqli_fetch_array($res)) {
                  echo "<tr>";
                  echo '<td><input type="radio" style="width:50%;" name="veh" value="' . $row['Vehicle_No'] . '"/>    &nbsp;   </td>';
                  foreach ($all_property as $item) {
                    echo '<td>' . $row[$item] . '</td>';
                  }

                  echo '</tr>';
                }
                echo "</table>";
                ?><input type="submit" class="button1" value="Edit">
              </form>

        <?php

            }
          } else {
            echo "<p class='wrong'>Some error occured!!</p>";
          }
        }
        ?>




      </div>
    </form>
  </div>
</body>
<style>
  table,
  td,
  th {
    border: 1px solid;
  }

  th,
  td {
    padding: 10px;
    text-align: left;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
</style>

</html>