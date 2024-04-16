<?php
    $Branch = $_POST['Branch'];
    $Dept = $_POST['Department'];
    $Emp_No = $_POST['Emp_No'];
    $Name = $_POST['Name'];
    $Phone = $_POST['Phone'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];
    $Emp_Email = $_POST['Emp_Email'];
    $Pass = $_POST['Password'];

    if(is_numeric($Phone)){
        $query1 = "SELECT * FROM employee WHERE Emp_No = '$Emp_No' AND Email_Id = '$Emp_Email' AND Emp_Name = '$Name' AND Phone = '$Phone' AND DOB = '$DOB'limit 1";
        if(($result1 = mysqli_query($conn, $query1)) && mysqli_num_rows($result1) > 0){
            echo "<p class='wrong'>Given data is already present...</p>";
        }else{
            $query2 = "SELECT * FROM employee WHERE Emp_No = '$Emp_No' limit 1";
            if(($result2 = mysqli_query($conn, $query2)) && mysqli_num_rows($result2) > 0){
                echo "<p class='wrong'>Employee ID lready ssigned to someone</p>";
            }else{
                $query3 = "SELECT * FROM employee WHERE Email_Id = '$Emp_Email' limit 1";
                if(($result3 = mysqli_query($conn, $query3)) && mysqli_num_rows($result3) > 0){
                    echo "<p class='wrong'>Email Already Present</p>";
                }else{
                    $query4 = "SELECT Branch_Id FROM branch WHERE Branch_Name = '$Branch' limit 1";
                    $query5 = "SELECT Dept_No FROM department WHERE Dname = '$Dept' limit 1";
                    if(($result4 = mysqli_query($conn, $query4)) && ($result5 = mysqli_query($conn, $query5)) && mysqli_num_rows($result4) > 0 && mysqli_num_rows($result5) > 0){
                        $row4 = $result4->fetch_row();
                        $Branch_No = $row4[0];
                        $row5 = $result5->fetch_row();
                        $Dept_No = $row5[0];
                        $query3 = "INSERT INTO `employee` (`Emp_No`, `Emp_Name`, `Phone`, `DOB`, `Gender`, `Email_Id`, `password`, `Branch_Id`, `Dept_No`) VALUES ('$Emp_No', '$Name', '$Phone', '$DOB', '$gender', '$Emp_Email', '$Pass', '$Branch_No', '$Dept_No')";
                        if($result3 = mysqli_query($conn, $query3)){
                            echo "<script> alert('Submitted Successfully \\n Branch : '+'$Branch'+ '\\n Department : '+'$Dept'+'\\n Employee Id : '+'$Emp_No');
                            location.replace('index.php'); 
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