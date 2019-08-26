<?php
 session_start();

 if (isset($_SESSION['usr_id'])) {
     header("Location: index.php");
 }

 include_once 'connect.php';

 //set validation error flag as false
 $error = false;

// //check if form is submitted
 if (isset($_POST['submit'])) {
     $username = mysqli_real_escape_string($conn, $_POST['username']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $address = mysqli_real_escape_string($conn, $_POST['address']);
     $password = mysqli_real_escape_string($conn, $_POST['password']);
     $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

//     //name can contain only alpha characters and space
     if (!preg_match("/^[a-zA-Z ]+$/", $username)) {
         $error = true;
         $name_error = "Name must contain only alphabets and space";
     }
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $error = true;
         $email_error = "Please Enter Valid Email ID";
     }
     if (empty($address)){
        $error = true;
        $address_error = "Please fillup the address";
     }
     if (strlen($password) < 6) {
         $error = true;
         $password_error = "Password must be minimum of 6 characters";
     }
     if ($password != $cpassword) {
         $error = true;
         $cpassword_error = "Password and Confirm Password doesn't match";
     }
     if (!$error) {
         if (mysqli_query($conn, "INSERT INTO user(username,email,password,address) VALUES('" . $username . "', '" . $email . "', '" . md5($password) . "', '". $address ."')")) {
             header("Location: login.php");
         } else {
             $errormsg = "Error in registering...Please try again later!";
         }
     }
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create An Account!</h1>
                  </div>
                  <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" required value="<?php if ($error) echo $username; ?>"  placeholder="User Name...">
                      <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" placeholder="Enter Email Address..." required value="<?php if ($error) echo $email; ?>">
                      <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="address" placeholder="Address..." required value="<?php if ($error) echo $address; ?>">
                      <span class="text-danger"><?php if (isset($address_error)) echo $address_error; ?></span>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                      <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="cpassword" placeholder="Confirm Password">
                      <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Register">
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Already Have an account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
