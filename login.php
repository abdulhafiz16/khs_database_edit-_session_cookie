<?php 
  require 'function.php';
  session_start();
  
  //cek cookie
  if(isset($_COOKIE['key']) && isset($_COOKIE['nm'])){
    $nm=$_COOKIE['nm'];
    $key=$_COOKIE['key'];

    //ambil nim berdasarkan nama
    $cek1="SELECT nim FROM mahasiswa WHERE nama='$nm'";
    $result= mysqli_query($koneksi,$cek1);
    $data=mysqli_fetch_array($result);

    //cek cookie
    if($key=== hash('sha256', $data['nim'])){
        $_SESSION['login']=true;
        $_SESSION['nim']=$data['nim'];
    }
  }


  if(isset($_SESSION['login'])){
    header('Location: index.php');
        exit;
  }
  if(isset($_POST['login'])){

    $_SESSION['nim']=$_POST['nim'];
    $nim= $_SESSION['nim'];
    $password=$_POST['password'];

    $cek1="SELECT nim,nama,password FROM mahasiswa WHERE nim='$nim'";
    $result= mysqli_query($koneksi,$cek1);

    //cek username
    if(mysqli_num_rows($result)==1){

      //cek password
      $data=mysqli_fetch_array($result);
      if(password_verify($password,$data['password'])){
        
        //set session
        $_SESSION['login']=true;

        //cek remember me
        if(isset($_POST['remember'])){
          //buat cookie
          setcookie('nm',$data['nama'],time()+60);
          setcookie('key',hash('sha256', $nim),time()+60);
        }

        header('Location: index.php');
        exit;

      }
    }

    $eror=true;
  }

 ?>

<html>
<head>
  <title>Login Study Card </title>
  <link rel="stylesheet" href="csskhs.css">
  <link rel="stylesheet" href="cssindex.css">
  <style>
      input[type=password]{
        width: 100%;
        padding: 2px 8px;
        margin:2px ;
        background-color: #fffff2;
        border-style: inset;
        height: 28px;
        font-family: Calibri;
        box-sizing: border-box;
        border-radius: 0.5em;
        color: #253b45;
        position: relative;
        font-size: 16px;
      }
    </style>
</head>

<body>
<div class="bg" >
  <form method="post" action="">
  <div class="ktk" style="width: 600px;"><h2>Login Study Card</h2></div>

  <?php if (isset($eror)) { ?>
    <b style="color: red; font-style: italic;"> Unsername/ Wrong Password!</b>

  <?php } ?>

  <table border="0" cellpadding="2" cellspacing="5" class="border" style="font-family: verdana;font-weight: bold;">
      <tr style="background-color: #e5e9e9;">
        <td style="text-align: left;">NIM </td>
        <td style="width: 2px;">:</td>
        <td><input type="text"  name="nim" value="" placeholder="Masukan NIM"></td>
      </tr>
      <tr>
        <td style="text-align: left;width: 100px;">Password </td>
        <td style="width: 2px;">:</td>
        <td style="width: 150px;"><input type="password" name="password" value="" placeholder="Masukan Password"></td>
      </tr>
      <tr>
        <td style="width: 100px;"></td>
        <td style="width: 2px;"><input type="checkbox" name="remember" value=""></td>
        <td style="text-align: left;width: 150px;"> Remember Me </td>
      </tr>
    </table>
    <center><input type=submit name=login value=LOGIN style="margin-top: 5px ;width:96%;";></center>
  </form>
  <form action="registrasi.php">
    <center><input type=submit name=register value=REGISTRASI style="margin-top: 5px; width:96%;";></center>
  </form>
</div>
</body>
</html>