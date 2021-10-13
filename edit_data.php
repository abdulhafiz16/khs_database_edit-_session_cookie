<?php 
  session_start();
  if(!isset($_SESSION['login'])){
    header('Location: login.php');
        exit;
  }

 ?>
<html>
  <head>
    <title> Student Value Edit </title>
    <link rel="stylesheet" href="csskhs.css">
    <link rel="stylesheet" href="cssindex.css">
    <link rel="stylesheet" href="css3.css">
  </head>
  <body>
    <div class="bg" >
    <form action='khs.php' method='POST'>
      <?php
        $nim=$_SESSION['nim'];
        $selected_nama_mk = $_GET['nama_mk'];
      ?>
      <div class="ktk" style="width: 600px;"><h2>Value Edit <?php echo $selected_nama_mk; ?> </h2></div>
      <?php  
        include_once("webvars.inc");
        $koneksi = mysqli_connect($hostname, $db_user, $db_password, $select_db)
          or die("Connection failed: " . mysqli_connect_error());
        $query = "SELECT nim, nama_mk, nilai_mk FROM nilai where nama_mk = '$selected_nama_mk'&& nim='$nim'";
        $result = mysqli_query($koneksi, $query);
        if (mysqli_num_rows($result) > 0)
        {
          while($data = mysqli_fetch_array($result))
          {
            ?>
            <table border="0" cellpadding="2" cellspacing="5" class="border" style="font-family: verdana;font-weight: bold;">
              <tr style="background-color: #e5e9e9;">
                <td style="text-align: left;">NIM </td>
                <td style="width: 2px;">:</td>
                <td><input type="text"  name="edited_nim" value="<?php echo $data['nim']; ?>" readonly></td>
              </tr>
              <tr style="background-color: #e5e9e9;">
                <td style="text-align: left;">Subject Name </td>
                <td style="width: 2px;">:</td>
                <td><input type="text"  name="edited_nama_mk" value="<?php echo $data['nama_mk']; ?>" readonly></td>
              </tr>
              <tr>
                <td style="text-align: left;width: 100px;">Value</td>
                <td style="width: 2px;">:</td>
                <td style="width: 150px;"><input type="text"  name="edited_nilai_mk" value="<?php echo $data['nilai_mk']; ?>"></td>
              </tr>
            </table>
            <?php
          }
        }
        else
        {
          echo "Unexpected Error";
        }
        mysqli_close($koneksi);
      ?>
      <center><input type=submit name=edit_submit value=EDIT style="margin-top: 5px; width:96%;";></center>
      <table>
        <tr>  
          <td colspan="5"><a href="logout.php" class="out">LOGOUT</a></td>
        </tr>
      </table>
    </form>
  </div>
  </body>
</html>
