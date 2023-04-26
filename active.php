<!DOCTYPE html>
<html lang="en">
<?php
require_once "./connect.php";
$isValid = false;
if (isset($_GET['email']) && isset($_GET['token'])) {
  $query = "SELECT * FROM account where email = '$_GET[email]' AND activate_token = '$_GET[token]' AND activated = 0";
  $result = mysqli_query($conn, $query);
  $isValid = mysqli_num_rows($result) == 1;
  if ($isValid) {
    $query = "UPDATE account SET activated = 1 where email = '$_GET[email]' ";
    mysqli_query($conn, $query);
  }
}
?>

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
        <h4>Account Activation</h4>
        <?php
        if ($isValid) {
        ?>
          <p class="text-success">Congratulations! Your account has been activated.</p>
          <p>Click <a href="login.php">here</a> to login and manage your account information.</p>
        <?php
        } else {

        ?>
          <p class="text-danger">This is not a valid url or it has been expired.</p>
          <p>Click <a href="login.php">here</a> to login.</p>
        <?php
        }

        ?>


        <a class="btn btn-success px-5" href="login.php">Login</a>
      </div>
    </div>
    <!-- 
    <div class="row">
      <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
        <h4>Account Activation</h4>
        <p class="text-danger">This is not a valid url or it has been expired.</p>
        <p>Click <a href="login.php">here</a> to login.</p>
        <a class="btn btn-success px-5" href="login.php">Login</a>
      </div>
    </div> -->
  </div>
</body>

</html>