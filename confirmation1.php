<?php
  $query = "select Service_No from services where Date = '$Date' and Vehicle_No = '$Vehicle_Number' limit 1";
  if(($service_result  = mysqli_query($conn, $query)) && mysqli_num_rows($service_result )>0){
    $row = $service_result -> fetch_row();
    $Service_Number = $row[0];
  }
  else{
    unset($Service_Number);
  }
