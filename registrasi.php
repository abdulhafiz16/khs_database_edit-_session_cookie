<?php 
  require 'function.php';
  if(isset($_POST['register'])){

    if(registrasi($_POST)>0){
      echo "<script>
                alert('user baru berhasil ditambahkan!');
            </script>";
        header('Location: login.php');
        exit;
    }else{
      echo mysqli_error($koneksi);
    }
  }
 ?>

<html>
<head>
	<title>Study Card Registration </title>
    <title> </title>
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
	<div class="ktk" style="width: 600px;"><h2>Study Card Registration</h2></div>
	<table border="0" cellpadding="2" cellspacing="5" class="border" style="font-family: verdana;font-weight: bold;">
      <tr style="background-color: #e5e9e9;">
        <td style="text-align: left;">NIM </td>
        <td style="width: 2px;">:</td>
        <td><input type="text"  name="nim" value="" placeholder="NIM Input"></td>
      </tr>
      <tr style="background-color: #e5e9e9;">
        <td style="text-align: left;">Name </td>
        <td style="width: 2px;">:</td>
        <td><input type="text"  name="nama" value="" placeholder="Name Input"></td>
      </tr>
      <tr>
        <td style="text-align: left;width: 100px;">Password</td>
        <td style="width: 2px;">:</td>
        <td style="width: 150px;"><input type="password" name="password" value="" placeholder="Password Input"></td>
      </tr>
      <tr>
        <td style="text-align: left;width: 100px;">Confirm Password</td>
        <td style="width: 2px;">:</td>
        <td style="width: 100px;"><input type="password" name="password2" value="" placeholder="Password Input"></td>
      </tr>
    </table>
    <input type=submit name=register value=REGISTRASI style="margin-top: 5px";>
	</form>
</div>
</body>
</html>