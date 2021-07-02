<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMART PJU-Simpan Data</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">
    
<?php
	if ($_POST['save'] == "save") {
        $id_petugas     = $_POST['id_petugas'];
		$id            	= $_POST['id'];
		$nama           = $_POST['nama'];
		$propinsi       = $_POST['prop'];
        $kota           = $_POST['kota'];
        $kecamatan      = $_POST['kec'];
        $kelurahan      = $_POST['kel'];
		$jalan          = $_POST['jalan'];
		$prototipe      = $_POST['prototipe'];
		$lat  	        = $_POST['lat'];
		$long         	= $_POST['long'];
		$lokasi_kode    = $_POST['kel'];
		
		$sub_kota = substr($kota, 0, 2);
		$sub_kecamatan = substr($kecamatan, 0, 2);
// 		echo $propinsi." ";
// 		echo $sub_kota." ";
// 		echo $sub_kecamatan."<br>";
        
        include 'dist/db.php';
        
        $queryPropinsi = mysqli_query($conn, "SELECT * FROM inf_lokasi where lokasi_propinsi='$propinsi' and lokasi_kecamatan=0 and lokasi_kelurahan=0 and lokasi_kabupatenkota=0 order by lokasi_nama");
        $dataPropinsi=mysqli_fetch_array($queryPropinsi);
            $namaPropinsi = $dataPropinsi['lokasi_nama'];
        
        $queryKota = mysqli_query($conn, "SELECT * FROM inf_lokasi WHERE lokasi_propinsi='$propinsi' and lokasi_kecamatan=0 and lokasi_kelurahan=0 and lokasi_kabupatenkota='$sub_kota' ORDER BY lokasi_nama");
		$dataKota=mysqli_fetch_array($queryKota);
            $namaKota = $dataKota['lokasi_nama'];
            
        $queryKecamatan = mysqli_query($conn, "SELECT * FROM inf_lokasi WHERE lokasi_propinsi='$propinsi' and lokasi_kecamatan='$sub_kecamatan' and lokasi_kelurahan=0 and lokasi_kabupatenkota='$sub_kota' ORDER BY lokasi_nama");
		$dataKecamatan=mysqli_fetch_array($queryKecamatan);
            $namaKecamatan = $dataKecamatan['lokasi_nama'];
        
        $queryKelurahan = mysqli_query($conn, "SELECT * FROM inf_lokasi WHERE lokasi_kode='$kelurahan' ORDER BY lokasi_nama");
		$dataKelurahan=mysqli_fetch_array($queryKelurahan);
		    $namaKelurahan = $dataKelurahan['lokasi_nama'];
		
        // echo $id_petugas . "<br>";
        // echo $id . "<br>";
        // echo $nama . "<br>";
        // echo $namaPropinsi . "<br>";
        // echo $namaKota . "<br>";
        // echo $namaKecamatan . "<br>";
        // echo $namaKelurahan . "<br>";
        // echo $jalan . "<br>";
        // echo $lat . "<br>";
        // echo $long . "<br>";
        
        

		include "dist/db.php";
		$cekNoid = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM lampu_jalan WHERE id_lampu = '$id'"));

		if ($cekNoid > 0) {
            
			echo "
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
                                    ID Lampu sudah terpakai, silahkan cek kembali ID Lampu pada Box!
                                </h1>
                              </div>

                              <a href='tambah-data.php' class='btn btn-default btn-user btn-block'>
                                    Kembali
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
		} else {

			// $query = mysqli_query($conn, "INSERT INTO lampu_jalan (id_petugas, id_lampu, nama, lokasi, jalan, lat, long) 
                                    // VALUES ('$id_petugas', '$id', '$nama', '$lokasi', '$jalan', '$lat', '$long')");
      $query = mysqli_query($conn, "INSERT INTO lampu_jalan SET id_petugas='$id_petugas', id_lampu='$id', nama='$nama', propinsi='$namaPropinsi', kota='$namaKota', kecamatan='$namaKecamatan', kelurahan='$namaKelurahan', jalan='$jalan', jenis_prototipe='$prototipe', lat='$lat', longi='$long', lokasi_kode='$lokasi_kode'");

			if ($query) {
				echo "
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
                                    Tambah Data Berhasil !
                                </h1>
                              </div>

                              <a href='dashboard.php' class='btn btn-success btn-user btn-block'>
                                    Menu Dashboard
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";

			} else {
				echo "
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
                                    Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar!
                                </h1>
                              </div>

                              <a href='tambah-data.php' class='btn btn-danger btn-user btn-block'>
                                    Kembali
                              </a> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";

			}


		}


	}

?>
    </body>
</html>