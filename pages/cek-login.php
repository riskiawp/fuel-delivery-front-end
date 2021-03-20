<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
require 'functions.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"SELECT * FROM tabel_user WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if($data['peran']=="Admin"){

        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['peran'] = "Admin";
        // alihkan ke halaman dashboard admin
        header("location:dashboard-admin.php");

    // cek jika user login sebagai pegawai
    }else if($data['peran']=="Driver"){
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['peran'] = "Driver";
        // alihkan ke halaman dashboard pegawai
        header("location:dashboard-driver.php");

    // cek jika user login sebagai pengurus
    }else if($data['peran']=="Supervisor"){
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['peran'] = "Supervisor";
        // alihkan ke halaman dashboard pengurus
        header("location:halaman_pengurus.php");

    }else{

        // alihkan ke halaman login kembali
        header("location:index.php?pesan=gagal");
    }	
}else{
    header("location:index.php?pesan=gagal");
}

?>