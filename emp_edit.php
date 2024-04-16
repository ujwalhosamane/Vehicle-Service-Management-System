<?php
  session_start();
if(!isset($_SESSION['Email'])){  
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
        <h1>Employee Edit</h1><hr style="height:2px;border-width:0;color:gray;background-color:gray;width:75%">
      </center>
      <?php 

	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        $Branch = $_POST['Branch'];
        $Dept = $_POST['Department'];
        $Emp_No = $_POST['Emp_No'];
        $Name = $_POST['Name'];
        $Phone = $_POST['Phone'];
        $DOB = $_POST['DOB'];
        $gender = $_POST['gender'];
        $Emp_Email = $_POST['Emp_Email'];
        $Pass = $_POST['Password'];

        $Emp_No1 = $_SESSION['value'];
        $emp_query1 = "SELECT * FROM `employee` WHERE `Emp_No` = '$Emp_No1' limit 1";
        $emp_res = mysqli_query($conn, $emp_query1);

        if(is_numeric($Phone)){
            $query1 = "SELECT * FROM employee WHERE Emp_No = '$Emp_No' AND Email_Id = '$Emp_Email' AND Emp_Name = '$Name' AND Phone = '$Phone' AND DOB = '$DOB' AND `Emp_No` != '$Emp_No1' limit 1";
            if(($result1 = mysqli_query($conn, $query1)) && mysqli_num_rows($result1) > 0){
                echo "<p class='wrong'>Given data is already present...</p>";
            }else{
                $query2 = "SELECT * FROM employee WHERE Emp_No = '$Emp_No' AND `Emp_No` != '$Emp_No1' limit 1";
                if(($result2 = mysqli_query($conn, $query2)) && mysqli_num_rows($result2) > 0){
                    echo "<p class='wrong'>Employee ID already assigned to someone</p>";
                }else{
                    $query3 = "SELECT * FROM employee WHERE (Email_Id = '$Emp_Email' OR Phone = '$Phone') AND `Emp_No` != '$Emp_No1' limit 1";
                    if(($result3 = mysqli_query($conn, $query3)) && mysqli_num_rows($result3) > 0){
                        echo "<p class='wrong'>Either mobile or email detail is already present!!</p>";
                    }else{
                        $query4 = "SELECT Branch_Id FROM branch WHERE Branch_Name = '$Branch' limit 1";
                        $query5 = "SELECT Dept_No FROM department WHERE Dname = '$Dept' limit 1";
                        if(($result4 = mysqli_query($conn, $query4)) && ($result5 = mysqli_query($conn, $query5)) && mysqli_num_rows($result4) > 0 && mysqli_num_rows($result5) > 0){
                            $row4 = $result4->fetch_row();
                            $Branch_No = $row4[0];
                            $row5 = $result5->fetch_row();
                            $Dept_No = $row5[0];
                            $query6 = "UPDATE `employee` SET `Emp_No`='$Emp_No',`Emp_Name`='$Name',`Phone`='$Phone',`DOB`='$DOB',`Gender`='$gender',`Email_Id`='$Emp_Email',`password`='$Pass',`Branch_Id`='$Branch_No',`Dept_No`='$Dept_No' WHERE `Emp_No` = '$Emp_No1'";
                            if($result6 = mysqli_query($conn, $query6)){
                                echo "<script> alert('Updated Successfully');
                                location.replace('action.php'); 
                                    </script>";
                            }else{
                                echo "<p class='wrong'>Something went wrong!!!</p>";
                            }
                        }else{
                            echo "<p class='wrong'>Something went wrong!!!</p>";
                        }
                    }
                }
                
            }
        }else{
            echo "<p class='wrong'>Enter valid mobile number</p>";
        }
    }
    $Emp_No = $_SESSION['value'];
    $emp_query1 = "SELECT * FROM `employee` WHERE `Emp_No` = '$Emp_No' limit 1";
    $emp_res = mysqli_query($conn, $emp_query1);
    while($emp_row = $emp_res->fetch_row()){
?>
      <div class="center">
      <label for="Branch">Branch : </label>
      <select name="Branch" id="Branch"required>
      <?php $sql_query1 = "SELECT Branch_name,Branch_Id FROM branch " ;
            $sql_result1 = mysqli_query($conn,$sql_query1);

            while ($row1 = $sql_result1->fetch_row()) {
                echo "<option ";
                echo 'value = "'. $row1[0] .'"';
                if($emp_row[7] == $row1[1]){
                echo ' selected>'.$row1[0].'</option>';}
                else{
                    echo '>'.$row1[0].'</option>';
                }
              
            }
            echo '</select><br><br><br>'; ?> 
        
        <label for="Dept">Department : </label>
        <select name="Department" id="Dept"required>
      <?php $sql_query2 = "SELECT * FROM department " ;
            $sql_result2 = mysqli_query($conn,$sql_query2);

            while ($row2 = $sql_result2->fetch_row()) {
                echo "<option ";
                echo 'value = "'. $row2[0] .'"';
                if($emp_row[8] == $row2[1]){
                echo ' selected>'.$row2[0].'</option>';}
                else{
                    echo '>'.$row2[0].'</option>';
                }
              
            }
            echo '</select><br><br><br>'; ?> 

        <label>Employee ID :</label>
        <input type="text" name="Emp_No" placeholder="eg., 1234" size="6" value="<?php echo "$emp_row[0]";?>" required />
        <br>

        <label> Name :</label>
        <input type="text" name="Name" placeholder="Name" value="<?php echo "$emp_row[1]";?>" required />

        <label><br>Phone :</label>

        <input type="text" name="Phone" placeholder="eg., 1234567890" size="10" value="<?php echo "$emp_row[2]";?>" required/>
        <br>

        <br>

        <label> Date Of Birth :</label>
        <input type="date" name="DOB" placeholder="DD/MM/YYYY" value="<?php echo "$emp_row[3]";?>" required />

        <br><br><br>

        <label> Gender : </label>
        <input type="radio" value="Male" name="gender" <?php if('Male'== $emp_row[4]){echo "checked";}?>> Male
        <input type="radio" value="Female" name="gender" <?php if('Female'== $emp_row[4]){echo "checked";}?>> Female
        <input type="radio" value="Other" name="gender" <?php if('Other'== $emp_row[4]){echo "checked";}?>> Other


        
        <br><br><br>
        <label> Email :</label>
        <input type="email" name="Emp_Email" placeholder="xyz@xyz.com" size="20" value="<?php echo "$emp_row[5]";?>" required />
        <br>
        <label> Password :</label>
        <input type="password" name="Password" placeholder="**********"size="15" value="<?php echo "$emp_row[6]";}?>" required />

        <br>
        <button type="submit" class="registerbtn">Submit</button>
      </div>
    </div>
  </form>
  </div>
</body>

</html>