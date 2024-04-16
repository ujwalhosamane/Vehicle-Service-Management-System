<?php
session_start();
if (!isset($_SESSION['Email'])) {
  header("location:login.php");
} else {
  $email = $_SESSION['Email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- sdhgcjs-->
  <title>Admin</title>
</head>

<body>
  <div class="background_">
    <div class="navbar1">
      <?php
      if (!isset($_SESSION['usr_type'])) {
        include("employee.php");
      } else {
        include("admin.php");
      }
      ?>
    </div>

    <div class="home" id="home">
      <img src="./images/index.jpg" alt="">
      <div class="content">
        <h1 style="font-weight:bold;">Welcome.<br></br> Have a Good Day, Creww!</h1>
        <h1 style="font-weight:bold;font-size: 35px">Customer Satisfaction is our Motto.</h1>
        <p style="font-weight:bold;font-size: 20px;"> </p>
      </div>
    </div>

    <div class="contact" id="contact">
      <br>
      <h2>Any Problems? Contact HO.</h2>
      <p></p>
      <br><br>
      <div class="footer">
        <p>
          <i class="fas fa-map-marker-alt"></i> Address <br />
          <?php
          include("connection.php");
          $query1 = "SELECT * FROM branch WHERE Branch_Id = '101' limit 1";
          if (($result1 = mysqli_query($conn, $query1)) && mysqli_num_rows($result1) > 0) {
            while ($row1 = $result1->fetch_row()) {
              $Phone = $row1[2];
              $Address = $row1[3];
            }
          }
          ?><span> <?php echo $Address; ?>
            <br />
            Karnataka, India(IN).
          </span>
        </p>
        <p>
          <i class="fas fa-phone-alt"></i> Mobile No: <br />
          <span> <?php echo $Phone; ?></span>
        </p>
        <p>
          <i class=" far fa-envelope"></i> Mail: <br />
          <span>contact.headoffice@sms.com</span>
        </p>
      </div>
    </div>
  </div>
</body>
<style>
  body {
    margin: 0px;
  }

  .home img {
    margin-top: 64px;
    width: 100%;
    height: 657px;
    opacity: 0.6;
  }

  .home .content {
    transform: translate(-50%, 50%);
    text-align: center;
    position: absolute;
    top: 40%;
    left: 50%;
    font-size: 25px;
  }

  .contact {
    text-align: center;
    border-top-style: solid;
  }

  .footer {
    display: inline-flex;
    text-align: center;
    align-items: center;
    margin: auto;
  }

  .footer p {
    margin-left: 2rem;
  }
</style>

</html>