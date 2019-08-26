<?php
include_once 'connect.php';
 session_start();

 if (isset($_SESSION['usr_id']) == "") {
     header("Location: login.php");
 }
$error = false;

// //check if form is submitted
 if (isset($_POST['createprod'])) {
     $prodname = mysqli_real_escape_string($conn, $_POST['prodname']);
     $category = mysqli_real_escape_string($conn, $_POST['category']);
     $description = mysqli_real_escape_string($conn, $_POST['description']);
//     //name can contain only alpha characters and space
     if (empty($prodname)) {
         $error = true;
         $name_error = "Name must contain only alphabets and space";
     }
     if (empty($category)) {
         $error = true;
         $cat_error = "Please Enter Valid Email ID";
     }
     if (empty($description)){
        $error = true;
        $dess_error = "Please fillup the address";
     }
     if (!$error) {
         if (mysqli_query($conn, "INSERT INTO product(prod_name,prod_cat,prod_desc) VALUES('" . $prodname . "', '" . $category . "','". $description ."')")) {
             header("Location: createprod.php");
         } else {
             $errormsg = "Error in product entry...Please try again later!";
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

  <title>Inovice</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        
        <div class="sidebar-brand-text mx-3">Inovice</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span>Dashboard</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="createcust.php">
          <span>Create Customer</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="createprod.php">
          <span>Create Product</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="createino.php">
          <span>Creat Inovice</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewino.php">
          <span>View Inovice</span></a>
      </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php $username=$_SESSION['usr_name'];  echo $username; ?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
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
                    <h1 class="h4 text-gray-900 mb-4">Create Product</h1>
                  </div>
                  <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control " name="prodname" required value="<?php if ($error) echo $username; ?>"  placeholder="Product Name...">
                      <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                    <div class="form-group">
                      <select name="category" class="form-control" placeholder="category">
                        <option>Select Category</option>
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                        <option value="4">Category 4</option>
                        <option value="5">Category 5</option>
                        <option value="6">Category 6</option>
                        <option value="7">Category 7</option>          
                      </select>
                      <span class="text-danger"><?php if (isset($cat_error)) echo $cat_error; ?></span>
                    </div>
                    <div class="form-group">
                      <textarea name="description" class="form-control " rows="2" cols="155" placeholder="Description..."></textarea>
                      <span class="text-danger"><?php if (isset($dess_error)) echo $dess_error; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-user btn-block" name="createprod" value="Create">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
        <!-- /.container-fluid -->
      <!-- End of Main Content -->

     
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
