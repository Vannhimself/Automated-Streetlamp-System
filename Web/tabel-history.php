<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMART PJU - Detail History Lampu</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this tables -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Script Js Google Maps -->
  <script src="http://maps.googleapis.com/maps/api/js"></script>


</head>

<body id="page-top">

  <?php
  include "dist/db.php";
    if (!isset($_SESSION['username'])) {
        die("
      <br><br><br><br>
      <div class='row justify-content-center'>
        <div class='col-xl-5 col-lg-12 col-md-9'>
          <div class='card o-hidden border-0 shadow-lg my-5'>
            <div class='card-body p-0'>
              <!-- Nested Row within Card Body -->
              <div class='row'>
                <div class='col-lg-12'>
                  <div class='p-5'>
                    <div class='text-center'>
                      <h1 class='h4 text-gray-900 mb-4'>
                      Akses Ilegal !<br>
                      Mohon Melakukan Login Terlebih Dahulu !
                      </h1>
                    </div>
                    
                    <a href='index.php' class='btn btn-danger btn-user btn-block'>
                    Ke Menu Login
                    </a> 

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
            ");
    }

    $username = $_SESSION['username'];

    $tampilNama=mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
    $hasil=mysqli_fetch_array($tampilNama);
        $nama = $hasil['nama'];
        $id_petugas = $hasil['id_petugas'];

    ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <span class="logo-lg"><img src='img/umc.png' alt='User Image' width="50px" height="50px"></span>
        </div>
        <div class="sidebar-brand-text mx-3">SMART PJU</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Monitoring Baterai -->
      <li class="nav-item">
        <a class="nav-link" href="kondisi-baterai.php">
          <i class="fas fa-fw fa-battery-full"></i>
          <span>Kondisi Baterai</span></a>
      </li>

      <!-- Nav Item - Tambah Data -->
      <li class="nav-item">
        <a class="nav-link" href="tambah-data.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Tambah Data Lampu</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="tabel-history.php">
          <i class="fas fa-fw fa-table"></i>
          <span>History Lampu</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
              
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?=$nama?>
                </span>
                <img class="img-profile rounded-circle" src="img/no-image.jpg">
              </a>
              
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">History Lampu</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu History Details -->

          <!-- DataTales Example -->
          <div id="load-history">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">History Lampu</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID Lampu</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Status Lampu</th>
                        <th>Kondisi Baterai (%)</th>
                        <th>Kondisi Panel Surya (V)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID Lampu</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Status Lampu</th>
                        <th>Kondisi Baterai (%)</th>
                        <th>Kondisi Panel Surya (V)</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php

                      // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                    //   $dataHistory = mysqli_query($conn, "SELECT * FROM history hy, petugas pt WHERE pt.id_petugas = $id_petugas AND hy.id IN (SELECT MAX(id) FROM history GROUP BY hy.id_lampu)");
                    
                      $dataHistory = mysqli_query($conn, "SELECT * FROM history WHERE id IN (SELECT MAX(id) FROM history GROUP BY id_lampu)");
                    //   echo $id_petugas;

                      while($history = mysqli_fetch_array($dataHistory)){
                         $username = $_SESSION['username'];

                        $tampilNama=mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
                        $hasil=mysqli_fetch_array($tampilNama);
                        $nama = $hasil['nama'];
                        $id_petugas = $hasil['id_petugas'];
                        
                        $id_lampu = $history['id_lampu'];
                        $ambilLampu = mysqli_query($conn, "SELECT * FROM lampu_jalan WHERE id_lampu = $id_lampu AND id_petugas = $id_petugas");
                        $dataLampu = mysqli_fetch_array($ambilLampu);
                          $id_lampuBaru = $dataLampu['id_lampu'];
                          $namaLampu = $dataLampu['nama'];

                          $panel =  (int) $history['panel'];
                          $mathPanel = ($panel * 8) + 4;
                          // echo $mathPanel;
                         if ($id_lampu = $id_lampuBaru){
                    ?>
                      <tr>
                        <td><?php echo $id_lampuBaru; ?></td>
                        <td><?php echo $namaLampu;    ?></td>
                        <td><?php echo $history['waktu'];    ?></td>
                        <td><?php echo $history['status'];   ?></td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $history['baterai'];?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $history['baterai'];  ?>%; background-color: #07910a;">
                              <?php echo $history['baterai'];  ?>%
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $mathPanel?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $mathPanel?>%; background-color: #940b9c; ">
                              <?php echo $history['panel'];  ?> V
                            </div>
                          </div>
                        </td>
                        <td class="tools" align="center"><a href="tabel-history-detail.php?id_lampu=<?=$history['id_lampu'];?>" title="Lihat Data Lampu" class="btn btn-info">
                        <span class="fa fa-search"></span></a></td>
                      </tr>
                    <?php
                         }
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin mau Logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tekan tombol "Logout" dibawah jika  sudah siap untuk mengakhiri sesi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
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

  <!-- Datatables js -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Datatables -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
