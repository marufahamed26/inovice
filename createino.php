<?php
include_once 'connect.php';
 session_start();

 if (isset($_SESSION['usr_id']) == "") {
     header("Location: login.php");
 }
 $error = false;

 if(isset($_POST['prosave'])){
  $ino_cust = mysqli_real_escape_string($conn, $_POST['customername']);
  $ino_currency = mysqli_real_escape_string($conn, $_POST['currency']);
  $ino_date = mysqli_real_escape_string($conn, $_POST['date']);
  $ino_product = mysqli_real_escape_string($conn, $_POST['product']);
  $ino_quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
  $ino_price = mysqli_real_escape_string($conn, $_POST['price']);
  $ino_discount = mysqli_real_escape_string($conn, $_POST['discount']);
  $ino_total = mysqli_real_escape_string($conn, $_POST['totalprice']);

  if (empty($ino_cust)) {
         $error = true;
         $cust_error = "Select Customer Name";
         echo $error;
     }
     if (empty($ino_currency)) {
         $error = true;
         $currency_error = "Select Currency";
     }
     if (empty($ino_date)){
        $error = true;
        $date_error = "Select Date";
     }

     if (empty($ino_product)){
        $error = true;
        $product_error = "Select Product";
     }

     if (empty($ino_quantity)){
        $error = true;
        $quantity_error = "Enter Quantity";
     }

     if (empty($ino_price)){
        $error = true;
        $price_error = "Enter Price";
     }

     if (empty($ino_discount)){
        $error = true;
        $discount_error = "Enter Discount";
     }

     if (empty($ino_total)){
        $error = true;
        $total_error = "Total";
     }
     
     if (!$error) {
      
         if (mysqli_query($conn, "INSERT INTO `inovice`(`cust_id`, `currency`, `date`, `ino_product`, `pro_quantity`, `pro_price`, `pro_discount`, `Pro_total`) VALUES ('". $ino_cust."','". $ino_currency."','". $ino_date."','". $ino_product."','". $ino_quantity."','". $ino_price."','". $ino_discount."','". $ino_total."')")) {
             header("Location: createino.php");
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
      <li class="nav-item">
        <a class="nav-link" href="createprod.php">
          <span>Create Product</span></a>
      </li>
      <li class="nav-item active">
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
<form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Begin Page Content -->
        <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card ">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create A Inovice</h1>
                  </div>
                  
                    <div class="form-group">
                      <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label class="">Customer</label>
                  </div>
                  <div class="col-sm-12">
                    <select name="customername" class="form-control" placeholder="category">
                      <option>Select Customer</option>
                      <?php
                      $sql = mysqli_query($conn, "SELECT cust_id,cust_name FROM `customer` WHERE 1 ");
                      while ($row = mysqli_fetch_assoc($sql)) {
                        echo "<option value='". $row['cust_id'] ."'>" .$row['cust_name'] ."</option>" ;
                        # code...
                      }
                      ?>
                      </select>
                      <span class="text-danger"><?php if (isset($cust_error)) echo $cust_error; ?>
                  </div>
                </div>
                    </div>
                    <div class="form-group">
                      <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label class="">Currency</label>
                  </div>
                  <div class="col-sm-12">
                    <select name="currency" class="form-control" placeholder="category">
                        <option>Select Currency</option>
                        <option value="doller">Doller</option>
                        <option value="euro">Euro</option>
                        <option value="taka">Taka</option>          
                      </select>
                      <span class="text-danger"><?php if (isset($currency_error)) echo $currency_error; ?>
                  </div>
                </div>
                    </div>
                    <div class="form-group">
                      <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label class="">Date</label>
                  </div>
                  <div class="col-sm-12">
                    <input type="date" class="form-control" name="date">
                    <span class="text-danger"><?php if (isset($date_error)) echo $date_error; ?>
                  </div>
                </div>
                    </div>
                    
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>



  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card mb-4 ">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-center">Sales Inovice Items</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Item Description</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Discount %</th>
                      <th>Total</th>
                      <th>Done</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                      <td>
                        <select name="product">
                          <option>Select Product</option>
                          <?php
                      $sql = mysqli_query($conn, "SELECT prod_name FROM `product` WHERE 1 ");
                      while ($row = mysqli_fetch_assoc($sql)) {
                        echo "<option value='". $row['prod_name'] ."'>" .$row['prod_name'] ."</option>" ;
                        # code...
                      }
                      ?>
                        </select>
                        <span class="text-danger"><?php if (isset($product_error)) echo $product_error; ?>
                      </td>
                      <td>
                        <input type="number" name="quantity" class="input qunty">
                        <span class="text-danger"><?php if (isset($quantity_error)) echo $quantity_error; ?>
                      </td>
                      <td>
                        <input type="number" name="price" class="input pri">
                        <span class="text-danger"><?php if (isset($price_error)) echo $price_error; ?>
                      </td>

                      <td>
                        <input type="number" name="discount" class="input disc">
                        <span class="text-danger"><?php if (isset($discount_error)) echo $discount_error; ?>
                      </td>
                      <td>
                        <input type="number" name="totalprice" id="total" >
                        <span class="text-danger"><?php if (isset($total_error)) echo $total_error; ?>
                      </td>
                      <td>
                        <input type="submit" name="prosave" value="Add"></td>
                    </tr>   

                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </form>
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

  <script type="text/javascript">
    $(document).ready(function(){
    $(".input").keyup(function(){
          var val1 = +$(".qunty").val();
          var val2 = +$(".pri").val();
          var val3 = +$(".disc").val();
          var val5 = val3/100;
          var val4 = (val1*val2)*val5;
          var val6 = (val1*val2)-val4;

          $("#total").val(val6);
   });
});
  </script>


</body>

</html>
