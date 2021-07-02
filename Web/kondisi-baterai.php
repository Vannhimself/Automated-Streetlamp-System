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

  <title>SMART PJU - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- CSS untuk Circular Progress Bar -->
  <link href="css/css-circular-prog-bar.css" media="all" rel="stylesheet" />

  <!-- CSS untuk Speedmeter Bar -->
  <link href="css/css-speedmeter.css" media="all" rel="stylesheet" />

  <!-- Custom styles for this tables -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Script Auto Refresh -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>

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
      <li class="nav-item active">
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
      <li class="nav-item">
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
            <h1 class="h3 mb-0 text-gray-800">Kondisi Baterai</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu Dashboard -->

          <div class="row">

          </div>
          <!-- /. row -->

          <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kondisi Baterai</h6>
              </div>
              <div id="load-history">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>ID Lampu</th>
                          <th>Nama Lampu</th>
                          <th>Kondisi Baterai (%)</th>
                          <th>Kondisi Panel Surya (V)</th>
                          <!-- <th>Action</th> -->
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>ID Lampu</th>
                          <th>Nama Lampu</th>
                          <th>Kondisi Baterai (%)</th>
                          <th>Kondisi Panel Surya (V)</th>
                          <!-- <th>Action</th> -->
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php

                        // $dataHistory = mysql_query("SELECT * FROM history ORDER BY id_lampu");
                        $dataHistory = mysqli_query($conn, "SELECT * FROM history WHERE id IN (SELECT MAX(id) FROM history GROUP BY id_lampu)");


                        while($history = mysqli_fetch_array($dataHistory)){
                          $id_lampu = $history['id_lampu'];
                          $ambilLokasi = mysqli_query($conn, "SELECT * FROM lampu_jalan WHERE id_lampu='$id_lampu'");
                          $dataLokasi = mysqli_fetch_array($ambilLokasi);
                              $panel = (int) $history['panel'];
                              $nilaiPanel = $panel;

                      ?>

                        <tr>
                          <td><?php echo $history['id_lampu']; ?></td>
                          <td><?php echo $dataLokasi['nama']; ?></td>
                          <!-- <td><?php echo $history['baterai'];  ?>%</td> -->
                          <!-- <td>
                            <div class="progress mb-2">
                              <div class="progress-bar" role="progressbar" style="width: <?php echo $history['baterai'];  ?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $history['baterai'];  ?> %</div>
                            </div>
                          </td> -->
                          <?php if ($history['baterai'] > 50) { ?>
                            <td align="center">
                              <div class="progress-circle over50 p<?php echo $history['baterai'];?>">
                                 <span><?php echo $history['baterai'];?>%</span>
                                 <div class="left-half-clipper">
                                    <div class="first50-bar"></div>
                                    <div class="value-bar"></div>
                                 </div>
                              </div>
                            </td>
                          <?php } else {?>
                            <td align="center">
                              <div class="progress-circle p<?php echo $history['baterai'];?>">
                                 <span><?php echo $history['baterai'];?>%</span>
                                 <div class="left-half-clipper">
                                    <div class="first50-bar"></div>
                                    <div class="value-bar"></div>
                                 </div>
                              </div>
                            </td>
                          <?php } ?>

                          <?php if ($history['panel'] > 6) { 
                              
                            ?>
                            <td align="center">
                              <div class="progress-speed over50 p<?php echo $nilaiPanel; ?>">
                                 <span><?php echo $history['panel'];?>V</span>
                                 <div class="right-half-clipper">
                                    <div class="second50-bar"></div>
                                    <div class="speed-bar"></div>
                                 </div>
                              </div>
                            </td>
                          <?php } else {?>
                            <td align="center">
                              <div class="progress-speed p<?php echo $nilaiPanel;?>">
                                 <span><?php echo $history['panel'];?>V</span>
                                 <div class="right-half-clipper">
                                    <div class="second50-bar"></div>
                                    <div class="speed-bar"></div>
                                 </div>
                              </div>
                            </td>
                          <?php } ?>
                          <!-- td align="center">
                            <div id="gauge2" class="gauge-container two"></div>
                          </td> -->


                          <!-- <td>
                            <div class="progress mb-2">
                              <div class="progress-bar" role="progressbar" style="width: <?php echo $history['panel'];?>;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><?php echo $history['panel'];  ?> V</div>
                            </div>
                          </td> -->
                          <!-- <td><?php echo $history['panel'];    ?>V</td> -->
                          <!-- <td class="tools" align="center"><a href="tabel-history-detail.php?id_lampu=<?=$history['id_lampu'];?>" title="Lihat Data Lampu" class="btn btn-info"> -->
                          <!-- <span class="fa fa-search"></span></a></td> -->
                        </tr>
                      <?php
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
