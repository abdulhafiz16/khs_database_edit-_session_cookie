<?php 
	include_once("webvars.inc");
  $koneksi=mysqli_connect($hostname, $db_user, $db_password, $select_db) or die("Connection failed".mysqli_connect_error());

  function registrasi($data){
  	global $koneksi;

  	$nim=strtolower(stripslashes($data['nim']));
  	$nama=stripslashes($data['nama']);
    $password=mysqli_real_escape_string($koneksi,$data['password']);
    $password2=mysqli_real_escape_string($koneksi,$data['password2']);

    //cek username sudah ada atau belum
    $cek="SELECT nim from mahasiswa where nim='$nim'";
    $result=mysqli_query($koneksi,$cek);

    if(mysqli_fetch_assoc($result)){
    	echo "<script>
                alert('NIM sudah terdaftar!');
            </script>";
            return false;
    }


    //cek konfirmasi password
    if($password!==$password2){
      echo "<script>
                alert('konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    //enskripsi password
    $password=password_hash($password, PASSWORD_DEFAULT);
    
    //tambahakn userbaru ke databas
    $masuk="INSERT INTO mahasiswa (nim,nama,password) VALUES ('$nim','$nama','$password')";
    $result=mysqli_query($koneksi,$masuk);

    return mysqli_affected_rows($koneksi);
  }


 ?>