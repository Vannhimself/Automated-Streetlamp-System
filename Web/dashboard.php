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
  
  <!-- Select2 -->
  <link rel="stylesheet" href="css/select2.min.css"/>

  <!-- Custom styles for this tables -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Script Auto Refresh -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>

  <!-- Script Js Google Maps -->
  <script src="http://maps.googleapis.com/maps/api/js"></script>

  <!-- Script Reload - Google Maps -->
<!--   <script type="text/javascript">
    var auto_refresh = setInterval(
      function () {
        $('#load-history').load('tables.php').fadeIn("slow");
      }, 40000);
  </script>
 -->

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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard Monitoring Maps</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row Untuk Menu Dashboard -->

          <div class="row">

            <!-- Monitoring Maps -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                        <form method="GET" align="right">
                          Pilih ID Lampu :
                          <select id="mySelect" onchange="myFunctions()">
                            <!-- <option>Pilih ID Lampu</option> -->
                            <option value=""></option>
                            <option value="0">Tampilkan Semua Lampu!</option>
                              <?php
        
                                include 'dist/db.php';
                                $sql=("SELECT * FROM lampu_jalan WHERE id_petugas='$id_petugas'");
                                $result=mysqli_query($conn, $sql);
                                $no=1;
                                  if ($result) {
                                    while($show=mysqli_fetch_array($result)) {
                                      $id = $show['id_lampu'];
                                      $namaLampu    = $show['nama'];
                                      echo "<option value=\"".$id."\">#" .$id. " " .$namaLampu. "</option>";
                                      $no++;    
                                        
                                    }
                                  }
        
                              ?>                      
                          </select>
                        </form>
                </h6>
                </div>
                <!-- <div class="col-100"> -->
                
                <!-- </div> -->
                <div id="load-google" action="maps.php">
                  <div id="googleMaps" style="width:100%; height: 484px; position:relative;"></div>
                </div>
              </div>
            </div>
            
            <!-- KETERANGAN KONDISI LAMPU -->
            <div class="col-xl-3 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Keterangan Lamppu</h6>
                    </div>
                    <div class="card-body">
                      <img src="img/on.png"> Lampu Menyala<br><br>
                      <img src="img/off.png"> Lampu Tidak Menyala<br><br>
                      <img src="img/bahaya.png"> Alat Gagal Mengirim Data<br><br>
                    </div>
                </div>
            </div>


          <!-- /. row -->
          <!-- Content Row -->


              
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
            <span class="fa fa-window-close" aria-hidden="true"></span>
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

  <!-- Select myFunctions -->
   <script>
      function myFunctions() {
          var x = document.getElementById("mySelect").value;
          console.log("nilai x = "+x);    
          window.location.href = "dashboard.php?id=" + x;    
      }
   </script>

   <!-- Google Maps Script -->
   <script>
    function initialize() {  
        var map;
        var bounds = new google.maps.LatLngBounds();
        var myStyles =[
		    {
		        featureType: "poi",
		        elementType: "labels",
		        stylers: [
		              { visibility: "off" }
		        ]
		    }
		];
        var mapOptions = {
            mapTypeId: 'roadmap',
            clickableIcons: false,
        	styles : myStyles
            
        };

        // var image1 = 'img/no-image.jpg';
                        
        // Display a map on the web page
        map = new google.maps.Map(document.getElementById("googleMaps"), mapOptions);
        map.setTilt(50);

        // // Multiple markers location, latitude, and longitude
        // var markers = [
        //     <?php 
        //     $query = "SELECT * FROM lampu_jalan";
        //     $data = mysqli_query($conn, $query);
        //     while($row = mysqli_fetch_array($data)){
        //         echo '["'.$row['nama'].'", '.$row['lat'].', '.$row['long'].',"'.$row['nama'].'"]';
        //     }
        //     ?>
        // ];

        // Multiple markers location, latitude, and longitude
        var markers = [
            <?php
            $id = $_GET['id'];  

            if($id == 0){
              $query="SELECT * FROM lampu_jalan WHERE id_petugas='$id_petugas'";  
            }else{
              $query="SELECT * FROM lampu_jalan WHERE id_lampu='$id' AND id_petugas='$id_petugas'";  
            } 
            
            // $query = "SELECT * FROM lampu_jalan";
            $data = mysqli_query($conn, $query);
            
            while($row = mysqli_fetch_array($data)){
                $id_lampu = $row['id_lampu'];
                $cekLampu = mysqli_query($conn, "SELECT * FROM history WHERE id_lampu = $id_lampu ORDER BY id DESC LIMIT 1");
                    $getLampu   = mysqli_fetch_array($cekLampu);
                
                echo '[ "'.$row['nama'].'", "'.$id_lampu.'", "'.$getLampu['status'].'", '.$row['lat'].', '.$row['longi'].'],';
            }
            ?>
        ];

        // Info window content
        var infoWindowContent = [
            <?php
             $id = $_GET['id'];  

            if($id == 0){
              $query2="SELECT * FROM lampu_jalan WHERE id_petugas='$id_petugas'";  
            }else{
              $query2="SELECT * FROM lampu_jalan WHERE id_lampu='$id' AND id_petugas='$id_petugas'";  
            }  
            // $query2 = "SELECT * FROM lampu_jalan";
            $data2 = mysqli_query($conn, $query2);
            
            $ambilHistory = mysqli_query($conn, "SELECT * FROM history WHERE id IN (SELECT MAX(id) FROM history GROUP BY id_lampu)");
            $hasilLampu   = mysqli_fetch_array($ambilHistory);
              $id_lampu   = $hasilLampu['id_lampu'];
        
            while($row = mysqli_fetch_array($data2)){
                
                $id_lampu = $row['id_lampu'];
                $ambilLampu = mysqli_query($conn, "SELECT * FROM history WHERE id_lampu = $id_lampu ORDER BY id DESC LIMIT 1");
                $baruLampu   = mysqli_fetch_array($ambilLampu);
                    $baterai    = $baruLampu['baterai'];
                    $statusLampu = $baruLampu['status'];
                    $panelSurya  = $baruLampu['panel'];
                    $waktuLampu = $baruLampu['waktu'];
                    $awal  = strtotime($waktuLampu);
                    $akhir = time(); // waktu sekarang
                    $diff  = $akhir - $awal;
                    $jam   = floor($diff / (60 * 60));
                    $menit = $diff - $jam * (60 * 60);
                    
                if ($row['jenis_prototipe'] == 'induk') {
                    $jenisPrototipe = "GSM Shield SIM900 + NRF24L01 Receiver";
                } else $jenisPrototipe = "NRF24L01 Transmitter";

            ?>
                ['<div class="info_content" style="text-align:justified">' +
                    '<h1><?php echo $row['nama'];?> #<?php echo $id_lampu;?></h1>'+
                    '<table>'+
                        '<div style="margin-left: 10px;">'+
                        '<table>'+
                            // Lokasi Lampu
                            // '<tr>'+
                            //     '<td style="font-weight: bold;font-size: 20px;">Lokasi</td>'+
                            //     '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                            //     '<td style="font-size: 15px;"><?php echo $row['propinsi'];?></td>'+
                            // '</tr>'+
                            // '<tr>'+
                            //     '<td><br></td>'+
                            // '</tr>'+
                            // Waktu Lampu
                            // '<tr>'+
                            //     '<td style="font-weight: bold;font-size: 20px;">Waktu</td>'+
                            //     '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                            //     '<td style="font-size: 15px;"><?php echo floor( $menit / 60 ) . ' menit'; ?></td>'+
                            // '</tr>'+
                            // '<tr>'+
                            //     '<td><br></td>'+
                            // '</tr>'+
                            // Kondisi Lampu
                            '<tr>'+
                                '<td style="font-weight: bold;font-size: 20px;">Kondisi</td>'+
                                '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                                '<td style="font-size: 15px;"><?php echo $statusLampu; ?></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><br></td>'+
                            '</tr>'+
                            // Alamat Lampu
                            '<tr>'+
                                '<td style="font-weight: bold;font-size: 20px;">Alamat</td>'+
                                '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                                '<td style="font-size: 14px;"><?php echo $row['jalan'];?></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><br></td>'+
                            '</tr>'+
                            // KECAMTAN Lampu
                            '<tr>'+
                                '<td style="font-weight: bold;font-size: 20px;">Kecamatan</td>'+
                                '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                                '<td style="font-size: 15px;"><?php echo $row['kecamatan']; ?></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><br></td>'+
                            '</tr>'+
                            // KELURAHAN Lampu
                            '<tr>'+
                                '<td style="font-weight: bold;font-size: 20px;">Kelurahan</td>'+
                                '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                                '<td style="font-size: 15px;"><?php echo $row['kelurahan']; ?></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><br></td>'+
                            '</tr>'+
                            // JENIS PROTOTIPE Lampu
                            '<tr>'+
                                '<td style="font-weight: bold;font-size: 20px;">Jenis Prototipe</td>'+
                                '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                                '<td style="font-size: 15px;"><?php echo $jenisPrototipe ?></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><br></td>'+
                            '</tr>'+
                            // Baterai Lampu
                            '<tr>'+
                                '<td style="font-weight: bold;font-size: 20px;">Baterai</td>'+
                                '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                                '<td style="font-size: 15px;"><?php echo $baterai;?>%</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><br></td>'+
                            '</tr>'+
                            // Panel Surya
                            '<tr>'+
                                '<td style="font-weight: bold;font-size: 20px;">Panel</td>'+
                                '<td style="font-weight: bold;font-size: 20px;"> : </td>'+
                                '<td style="font-size: 15px;"><?php echo $panelSurya;?>V</td>'+
                            '</tr>'+
                        '</table>'+
                        '</td>'+
                        '</tr>'+
                    '</table>'+
                 '</div>'],
            <?php 
            }
            ?>
        ];

        // Add multiple markers to map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        var imageon = 'img/on.png';
        var imageoff = 'img/off.png';
        
        // Place each marker on the map 
        <?php 
        // $on = "Menyala";
        // $off = "Tidak Menyala";
        
        ?>
            for( i = 0; i < markers.length; i++ ) {
                // var image = 'img/'+markers[i][4]+'.png';
                
                var position = new google.maps.LatLng(markers[i][3], markers[i][4]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i][0],
                    // icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
                    // icon: imageon
                    zIndex: markers[i][1],
                    icon: 'img/' + markers[i][2] + '.png'
                    // icon: image
                });
                
                // Add info window to marker    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent(infoWindowContent[i][0]);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));

                // Center the map to fit all markers on the screen
                map.fitBounds(bounds);
            }


        // Set zoom level
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(18);
            google.maps.event.removeListener(boundsListener);
        });
      }

      // Load initialize function
      google.maps.event.addDomListener(window, 'load', initMap);

    </script>
    
  <!-- Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEGGw0nGGqnYP2LR53UaoHHor_HCSdVeQ&libraries=places&callback=initialize"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  
  <!-- Script Reload - Google Maps -->
  <?php 
    $id = $_GET['id'];  
  ?>
  <script type="text/javascript">
    var auto_refresh = setInterval(
      function () {
        $('#load-google').load('maps.php?id=<?php echo $id ?>&username=<?php echo $username ?>').fadeIn("slow");
      }
      , 30000); // 300000 milisecond
  </script>
  
  <!-- select 2 map -->
  <script src="js/select/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#mySelect").select2({
            <?php
              $id = $_GET['id'];  

              if($id == 0){
                $query3="SELECT * FROM lampu_jalan";  
              }else{
                $query3="SELECT * FROM lampu_jalan WHERE id_lampu='$id'";  
              }

              $data3 = mysqli_query($conn, $query3);
              $namaLampu2 = mysqli_fetch_array($data3);
                $nama2 = $namaLampu2['nama'];
              if ($id == 0) {?>
                placeholder: "Tampilkan Semua Lampu!"
        <?php } else { ?>
              placeholder: "<?php echo '#'. $id . ' ' ; ?> <?php echo $nama2; ?>"
        <?php } ?>
          });
      });
  </script>
  
  
</body>

</html>
