<?php
$server = "localhost";
$name = "sarjanat_lampu";
$password = "AdminSarjana15";
$db = "sarjanat_lampu";

$conn = mysqli_connect($server, $name, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_lampu = 1;
$ldr = $_GET['ldr'];
$batt = $_GET['volt'];


// $insert  = "INSERT INTO history (id_lampu, baterai, status, panel, waktu) 
//             VALUES ('$id_lampu','$batt', '$stat', '$panel', '$waktu')";

// $query=mysqli_query($conn, $insert);

$query = mysqli_query($conn, "UPDATE history SET baterai='$batt', status='$ldr' WHERE id_lampu='$id_lampu'");

if ($query){
    echo "data BERHASIL masuk";
} else {
    echo "data GAGAL masuk";
}

?>