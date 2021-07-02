<?php
	session_start();

	include "dist/db.php";

	$username			= $_POST['username'];
	$password			= $_POST['password'];

	$sql = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
			
	$cek = mysqli_num_rows($sql);

	if($cek > 0){
	    if ($username == "admin" || $username == "superadmin") {
    		$_SESSION['username'] = $username;
    		$_SESSION['status'] = "login";
    		header("location:home-admin.php");
	    } else {
	        $_SESSION['username'] = $username;
    		$_SESSION['status'] = "login";
    		header("location:dashboard.php?id=0");
	    } 
	}else{
		header("location:index.php?pesan=gagal");
	}

?>