<?php

$server_name="localhost";

$username="root";

$password="";

$database_name="vehicle_service_management_db";

$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
    {
        die("Connection Failed:" . mysqli_connect_error());
    }
