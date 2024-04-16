<?php
    $customer_query = "select customer_id from customer where email_id = '$email' limit 1";
    if(($customer_result = mysqli_query($conn, $customer_query)) && mysqli_num_rows($customer_result)){
        $cust_row = $customer_result -> fetch_row();
        $customer_id = $cust_row[0];  
    }