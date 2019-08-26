<?php
include_once 'connect.php';
 session_start();

 if (isset($_SESSION['usr_id']) == "") {
     header("Location: login.php");
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
      <li class="nav-item">
        <a class="nav-link" href="createino.php">
          <span>Creat Inovice</span></a>
      </li>
      <li class="nav-item active">
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
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card mb-4 ">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-center">All Invoice</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM `inovice`");
                  $count=mysqli_num_rows($sql);
                  echo $count;
                  ?>
                  <tr>
                    <?php
                    if(mysqli_num_rows($sql)== 0){
                      echo "<th>No Inovice found</th> ";

                   echo " </tr>";

                    }
                    
                    else {

                  echo "<thead>
                    <tr>
                      
                      <th>ID</th>
                      <th>Customer Name</th>
                      <th>Email</th>
                      <th>Discount</th>
                      <th>Order Date</th>
                      <th>Delivery To</th>
                      <th>Total</th>
                      <th>Currency</th>
                      <th>View</th>
                      <th>Payment</th>
                    </tr>
                  </thead>";
                  
                   while($row = mysqli_fetch_assoc($sql)){

                    $id = $row['inovice_id'];
                    $cust_id = $row['cust_id'];
                    $currency = $row['currency'];
                    $date = $row['date'];
                    echo $id;

                    $sql1 = mysqli_query($conn, "SELECT cust_name,cust_email FROM `customer`WHERE cust_id=".$cust_id."");
                      while($co = mysqli_fetch_assoc($sql1)) {
                        $cust_name = $co['cust_name'];
                        $cust_email = $co['cust_email'];
                        # code...
                      }

                  echo "
                    <tbody>
                    <tr>
                      <td>".$id."</td>
                      <td>".$cust_name."</td>
                      <td>".$cust_email."</td>

                      <td>".$row['pro_discount']."</td>
                      <td>".$date."</td>
                      <td>".$cust_name."</td>
                      <td>".$row['Pro_total']."</td>
                      <td>".$currency."</td>
                      <td><a href='fullview.php?id=".$id."'> View </a></td>
                      <td><a href='payment.php?id=".$id."'> Payment </a></td>
                    </tr> ";  

                    
                  
                   }
                   echo "</tbody>";
                  

                  }
                  ?>
                </table>
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
