<?php
    $id_lampu = $_GET['id'];
	$username = $_GET['username'];

	include "dist/db.php";
	$cekId = mysqli_query($conn, "SELECT * FROM lampu_jalan WHERE id_lampu='$id_lampu'");

	$hasil = mysqli_fetch_array($cekId);
		$id = $hasil['id_lampu'];
		
    $tampilNama=mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
    $hasilNama=mysqli_fetch_array($tampilNama);
        $nama = $hasilNama['nama'];
        $id_petugas = $hasilNama['id_petugas'];
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- <title>SMART PJU - Dashboard</title> -->

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this tables -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Script Auto Refresh -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>

  <!-- Script Js Google Maps -->
  <script src="http://maps.googleapis.com/maps/api/js"></script>


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <!-- <div id="content"> -->

        <!-- Begin Page Content -->
        <!-- <div class="container-fluid"> -->

          <!-- Content Row Untuk Menu Dashboard -->

          <div class="row">

            <!-- Monitoring Maps -->
            <div class="col-xl-12 col-lg-7">
                <div id="googleMaps" style="width:100%;height: 484px;position:relative;"></div>
            </div>

          </div>
          <!-- /. row -->

        <!-- </div> -->
        <!-- /.container-fluid -->

      <!-- </div> -->
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

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
            $id = $id;  

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
            $id = $id;  

            if($id == 0){
              $query2="SELECT * FROM lampu_jalan";  
            }else{
              $query2="SELECT * FROM lampu_jalan WHERE id_lampu='$id'";  
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
                    
                if (floor( $menit / 60 ) >= '5') {
                    $gantiStatus = "bahaya";
                    $updateLampu = mysqli_query($conn, "UPDATE history SET status='$gantiStatus' WHERE id_lampu = $id_lampu ORDER BY id DESC LIMIT 1");
                } 
                
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
        var imagebahaya = 'img/bahaya.png';
        
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

</body>

</html>
