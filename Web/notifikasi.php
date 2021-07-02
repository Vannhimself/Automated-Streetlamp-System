<?php 
    $id = $_GET['id'];
    include "dist/db.php";

    $update_query = "UPDATE notifikasi SET notif_status = $id WHERE notif_status=0";
    if (mysqli_query($conn, $update_query))
    {
        echo "Record updated successfully";
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($connect);
    }
    die;

?>