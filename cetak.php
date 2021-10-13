<?php 
  session_start();
  if(!isset($_SESSION['login'])){
    header('Location: login.php');
        exit;
  }
?>
<html>
	<head>
		<title>Study Card</title>
		<link rel="stylesheet" href="csskhs.css">
		<link rel="stylesheet" href="css3.css">
	<script src="jquery.min.js"></script>
	  <script type="text/javascript">
	    $(document).ready(function(){
	      $('#select_all').on('click',function()
	      {
	        if(this.checked)
	        {
	          $('.checkbox').each(function(){
	            this.checked = true;
	          });
	        }
	        else
	        {
	          $('.checkbox').each(function(){
	            this.checked = false;
	          });
	        }
	      });

	      $('.checkbox').on('click',function()
	      {
	        if($('.checkbox:checked').length == $('.checkbox').length)
	        {
	          $('#select_all').prop('checked',true);
	        }
	        else
	        {
	          $('#select_all').prop('checked',false);
	        }
	      });
	    });

	    function delete_confirm(){
	      if($('.checkbox:checked').length > 0)
	      {
	        var result = confirm("Are you sure to delete " + $('.checkbox:checked').length + " selected users?");
	        if(result){
	            return true;
	        }
	        else
	        {
	            return false;
	        }
	      }
	      else
	      {
	        alert('Select at least 1 record to delete.');
	        return false;
	      }
	    }
	  </script>
	</head>

	<body>
		<?php
				$nim=$_SESSION['nim'];
			    $statusMsg = "";
			    include_once("webvars.inc");
 			 	$koneksi=mysqli_connect($hostname, $db_user, $db_password, $select_db) or die("Connection failed".mysqli_connect_error());
 			 	if(isset($_POST['delete_submit']))
			    {
			      if(!empty($_POST['checked_nama_mk']))
			      {
			        $nim=$_SESSION['nim'];

					$nama_mkStr = ($_POST['checked_nama_mk']);
					$notif = implode(', ', $nama_mkStr);
					$jumlah_dipilih=count($nama_mkStr);
					for ($i=0; $i <$jumlah_dipilih ; $i++) { 
			        	$sql = "DELETE FROM nilai WHERE nama_mk = '$nama_mkStr[$i]' && nim='$nim'";
			        	$delete = mysqli_query($koneksi, $sql);
				        if($delete)
				        {
				          $statusMsg = "Selected Mata Kuliah $notif have been deleted successfully.";
				        }
				        else {
				          $statusMsg = "Some problem occurred when delete process performed, please try again.";
				        }
			    	}
			      }
			    }
			    else
			    {
			      if(isset($_POST['edit_submit']))
			      {

			        $mk= $_POST['edited_nama_mk'];
			        $nm = $_POST['edited_nilai_mk'];
			        $nim = $_POST['edited_nim'];
			        $query="UPDATE nilai SET nilai_mk='$nm' where  nama_mk='$mk'";
			        $edit = mysqli_query($koneksi, $query);

			        if($edit)
			        {
			          $statusMsg = "Data $mk has been successfully edited.";
			        }
			        else {
			          $statusMsg = "Some problem occurred when edit process performed, please try again.";
			        }
			      }
			    }
			    echo "$statusMsg <br>";
			    
			  ?>
			  <form action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="return delete_confirm();"/>
		<div class="bg" >
			<div class="ktk"><h2>Study Card</h2></div>
			<table border="0" class="top">
				<?php 
				$query2="SELECT Nim,Nama FROM mahasiswa WHERE Nim='$nim'";
				$result2=mysqli_query($koneksi,$query2);
				$bio=mysqli_fetch_array($result2);
				 ?>
					<tr>
						<td><b>Nama </b></td>
						<td><b> : </b></td>
						<td><?php echo $bio["Nama"]; ?></td>
					</tr>
					<tr>
						<td><b>NIM </b> </td>
						<td><b> : </b> </td>
						<td><?php echo $bio["Nim"]; ?></td>
					</tr>
				</table>
		<table border="0" cellpadding="5" cellspacing="0" class="border">
			<tr class="header">
				<td align="center"><input type="checkbox" id="select_all" value=""></td>
				<td>No.</td>
				<td style="text-align: center;">Subject Name</td>
				<td>Nilai</td>
				<td align="center">Action</td>
			</tr>
			
			<tr>
				<td>
					<table>
						<?php
							$query4="SELECT nama_mk, nilai_mk FROM nilai WHERE Nim='$nim'";
				 			$result4=mysqli_query($koneksi,$query4);
						    if (mysqli_num_rows($result4) > 0)
						    {
						      while($row = mysqli_fetch_array($result4))
						      {
						  ?>
						        <tr>
						          <td align="center"><input type="checkbox" name="checked_nama_mk[]" class="checkbox" value="<?php echo $row['nama_mk']; ?>"></td>
						        </tr>

						   <?php
						      }
						    }
						    else
						    {
						  ?>
						        <tr>
						          <td colspan="6" align="center">No Record Found.</td>
						        </tr>
						  <?php
						    }?>
					</table>
				</td>
				<td>
					<table border="0">
						<?php 
						$query="SELECT nama_mk FROM nilai WHERE Nim='$nim'";
						$result=mysqli_query($koneksi,$query);
						$i=1;
						while ($data=mysqli_fetch_array($result)) { 
						echo "<tr><td>".$i."</td></tr>";
						$i++;
					} ?>
					</table>
				</td>
				<td class="mk">
					<table border="0" class="mk1">
						<?php 
						$query4="SELECT nama_mk FROM nilai WHERE Nim='$nim'";
				 		$result4=mysqli_query($koneksi,$query4);
				 		if (mysqli_num_rows($result4)>0) {
				 			while($data=mysqli_fetch_array($result4)) { 
						 		echo "<tr><td>".$data['nama_mk']."</td></tr>";
						    }
						}else{
							echo "0.result";
						} 
						?>
					</table>
					
				</td>
				<td>
					<table border="0" class="nm">
					<?php 
					 $query5="SELECT nilai_mk FROM nilai WHERE Nim='$nim'";
				 	 $result5=mysqli_query($koneksi,$query5);
				 	 if(mysqli_num_rows($result5)>0){
						 $hasil=0;
						 while ($data=mysqli_fetch_array($result5)) {
						 	if($data['nilai_mk']>85){
						 		echo "<tr><td>A</td></tr>";
						 		$data['nilai_mk']=4;
						 	}else if(($data['nilai_mk']<=85)&&($data['nilai_mk']>70)){
						 		echo "<tr><td>B</td></tr>";
						 		$data['nilai_mk']=3;
						 	}
						 	else if(($data['nilai_mk']<=70)&&($data['nilai_mk']>55)){
						 		echo "<tr><td>C</td></tr>";
						 		$data['nilai_mk']=2;
						 	}
						 	else if(($data['nilai_mk']<=55)&&($data['nilai_mk']>45)){
						 		echo "<tr><td>D</td></tr>";
						 		$data['nilai_mk']=1;
						 	}else if($data['nilai_mk']<=45){
						 		echo "<tr><td>E</td></tr>";
						 		$data['nilai_mk']=0;
						 	}
						 	$hasil=$hasil+$data['nilai_mk'];
						 }
						 	$i=0;
						 	$query4="SELECT nama_mk FROM nilai WHERE Nim='$nim'";
				 			$result4=mysqli_query($koneksi,$query4);
						 	while ($data=mysqli_fetch_array($result4)) {
						 		$i++;
						 	}
						 	$akhir=$hasil/$i;
						 	$query1="UPDATE mahasiswa SET ipk=$akhir WHERE nim='$nim'";
							$result1=mysqli_query($koneksi,$query1);
						 	
				 	 }else{
				 	 	echo "0.result";
				 	 }
					 ?>
					</table>
				</td>
				<td>
					<table>
						<?php
							$query4="SELECT nama_mk FROM nilai WHERE Nim='$nim'";
				 			$result4=mysqli_query($koneksi,$query4);
						    if (mysqli_num_rows($result4) > 0)
						    {
						      while($data = mysqli_fetch_array($result4))
						      {
						  ?>
						        <tr>
						          <td align="center"><a href='edit_data.php?nama_mk=<?php echo $data['nama_mk']; ?>'>Edit</a></td>
						        </tr>

						   <?php
						      }
						    }
						    else
						    {
						  ?>
						        <tr>
						          <td colspan="6" align="center">no record found.</td>
						        </tr>
						  <?php
						    }?>
					</table>
				</td>
			</tr>
			<tr class="footer">
				<td></td>
				<td colspan="2" ><b>Cumulative Value Index</b></td>
				<td style="text-align: center;font-weight: bold;text-align: left;">
					<?php
					 $query4="SELECT nama_mk FROM nilai WHERE Nim='$nim'";
				 		$result4=mysqli_query($koneksi,$query4);
				 		if (mysqli_num_rows($result4)==0) {
				 			$query1="UPDATE mahasiswa SET ipk=0 WHERE nim='$nim'";
							$result1=mysqli_query($koneksi,$query1);
						}
						$query="SELECT ipk FROM mahasiswa WHERE nim='$nim'";
						$result4=mysqli_query($koneksi,$query);
				    	$select=mysqli_fetch_array($result4);
						printf("%.2f",$select[0]);
					?>

				</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5"><input type="submit" name="delete_submit" value="DELETE"></td>
			</tr>
			<tr>	
				<td colspan="5"><a href="logout.php" class="out">LOGOUT</a></td>
			</tr>
			<?php 
			mysqli_close($koneksi);
			?>
		</table>
	</div>
	</body>
</html>