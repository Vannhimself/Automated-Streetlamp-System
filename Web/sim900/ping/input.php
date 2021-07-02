<?php
$server = "localhost";
$name = "sarjanat_lampu";
$password = "AdminSarjana15";
$db = "sarjanat_lampu";

$conn = mysqli_connect($server, $name, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_lampu = $_GET['id'];
$ldr = $_GET['ldr'];
$volt = $_GET['batt'];
$panel = $_GET['panel'];

$waktu = date("Y-m-d H:i:s");

$batt = (int) $volt;
$nilaibatt = $batt * 8 + 36;

// echo $waktu." ";
// echo $ldr;

if ($ldr < 400){
    $stat = "off";
} else $stat = "on";

$insert  = "INSERT INTO history (id_lampu, baterai, status, panel, waktu) 
            VALUES ('$id_lampu','$nilaibatt', '$stat', '$panel', '$waktu')";

$query=mysqli_query($conn, $insert);

// $query=mysqli_query($conn,"UPDATE history SET 
//                     baterai='$batt', status='$stat', panel='$panel'
//                     WHERE id_lampu='$id'");

if ($query){
    echo "Pengiriman Data BERHASIL Terkirim!";
} else {
    echo "data GAGAL masuk";
}

?>