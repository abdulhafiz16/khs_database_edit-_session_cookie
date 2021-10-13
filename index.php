<?php 
	require 'function.php';
	session_start();
	$nim=$_SESSION['nim'];
	if(!isset($_SESSION['login'])){
		header('Location: login.php');
        exit;
	}
	$sql="SELECT nama FROM mahasiswa WHERE nim=$nim";
	$result=mysqli_query($koneksi,$sql);
	$data=mysqli_fetch_array($result);

 ?>

<html>
	<head>
		<title>Study Card</title>
		<link rel="stylesheet" href="cssindex.css">
		<link rel="stylesheet" href="css3.css">
	</head>

	<body>
		<div class="bg">
			<div class="ktk"><h2>Study Card</h2></div>
			<form action="khs.php" method="post">
			<table border="0" class="top" >
					<tr>
						<td><b>Name </b></td>
						<td><b> : </b></td>
						<td><input  style="width: 97.5%;" type="text" name="nama" value="<?php echo $data['nama']; ?>" readonly></td>
					</tr>
					<tr>
						<td><b>StudentID  </b> </td>
						<td><b> : </b></td>
						<td><input style="width: 97.5%;" type="text" name="nim" value="<?php echo $nim; ?>" readonly></td>
					</tr>
				</table>
			</form>
			<table style="width: 100%; margin-bottom: 5px;">
				<form action="cetak.php" method="post">
				<tr>
					<td colspan="3">
						<input type="submit" name="submit" value="Existing KHS Prints">
					</td>
				</tr>
				</form>
				<tr>
					<td><h3 style="padding:5px;margin-bottom: 0; margin-top:10px; background-color: lightblue; color: #13324d;">New value input</h3></td>
				</tr>
			</table>
			<form action="khs.php" method="post">
		<table border="0" cellpadding="5" cellspacing="0" class="border">
			
			<tr style="font-weight: bold;">
				<td>No.</td>
				<td>Nama Mata Kuliah</td>
				<td>Nilai</td>
			</tr>
			<tr>
				<td>1</td>
				<td><input type="text" name="mk1" placeholder ="Subject Input"></td>
				<td><input type="text" name="nm1"></td>
			</tr>
			<tr>
				<td>2</td>
				<td><input type="text" name="mk2" placeholder="Subject Input"></td>
				<td><input type="text" name="nm2"></td>
			</tr>
			<tr>
				<td>3</td>
				<td><input type="text" name="mk3" placeholder="Subject Input"></td>
				<td><input type="text" name="nm3"></td>
			</tr>
			<tr>
				<td>4</td>
				<td><input type="text" name="mk4" placeholder="Subject Input"></td>
				<td><input type="text" name="nm4"></td>
			</tr>
			<tr>
				<td>5</td>
				<td><input type="text" name="mk5" placeholder="Subject Input"></td>
				<td><input type="text" name="nm5"></td>
			</tr>
			<tr>
				<td>6</td>
				<td><input type="text" name="mk6" placeholder="Subject Input"></td>
				<td><input type="text" name="nm6"></td>
			</tr>
			<tr>
				<td>7</td>
				<td><input type="text" name="mk7" placeholder="Subject Input"></td>
				<td><input type="text" name="nm7"></td>
			</tr>
			<tr>
				<td>8</td>
				<td><input type="text" name="mk8" placeholder="Subject Input"></td>
				<td><input type="text" name="nm8"></td>
			</tr>
			<tr>
				<td>9</td>
				<td><input type="text" name="mk9" placeholder="Subject Input"></td>
				<td><input type="text" name="nm9"></td>
			</tr>
			<tr>
				<td>10</td>
				<td><input type="text" name="mk10" placeholder="Subject Input"></td>
				<td><input type="text" name="nm10"></td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="submit" value="PRINT NEWNSTUDY CARD">
				</td>
			</tr>
			<tr>	
				<td colspan="3"><a href="logout.php" class="out">LOGOUT</a></td>
			</tr>
			</form>
		</table>
	</div>
	</body>
</html>