<?php
	//Koneksi Database
    include "koneksi.php";

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE `tb_member` SET 
												`id_member`='$_POST[id]',
												`nik`='$_POST[tnik]',
												`nama`='$_POST[tnama]',
												`jenis_kelamin`='$_POST[tjenis_kelamin]',
												`alamat`='$_POST[talamat]',
												`no_hp`='$_POST[tno_hp]',
												`divisi`='$_POST[tdivisi]',
												`roles`='$_POST[troles]' WHERE 1
											
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='admin.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='admin.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO tb_member (nik, nama, jenis_kelamin, alamat, no_hp, divisi, roles)
										    VALUES ('$_POST[tnik]', 
										  		 	'$_POST[tnama]', 
										  		 	'$_POST[tjenis_kelamin]', 
										  		 	'$_POST[talamat]',
													'$_POST[tno_hp]',
												   	'$_POST[tdivisi]',
												  	'$_POST[troles]')
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='admin.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='admin.php';
				     </script>";
			}
		}


		
	}


	//Pengujian jika tombol Edit / Hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit Data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id_member = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$vNIK = $data['nik'];
				$vnama = $data['nama'];
				$vjenis_kelamin = $data['jenis_kelamin'];
				$valamat = $data['alamat'];
                $vno_hp = $data['no_hp'];
				$vdivisi = $data['divisi'];
				$vroles = $data['roles'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			
			$hapus = mysqli_query($koneksi, "DELETE FROM tb_member WHERE id_member = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='admin.php';
				     </script>";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container">

	<h1 class="text-center">Data Member CN eSports</h1>
	<h2 class="text-center">Welcome</h2>

	
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
		Form Input Data Member
		<a href="index.php"><button class="btn-danger float-right ">Logout</button></a><br />
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>NIK</label>
	    		<input type="text" name="tnik"class="form-control" value="<?=@$vNIK?>" placeholder="Input Your NIK" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Name</label>
	    		<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Your Name" required>
			</div>
			
			<div class="form-group">
	    		<label>Gender</label>
	    		<select class="form-control" name="tjenis_kelamin">
	    			<option value="<?=@$vjenis_kelamin?>"><?=@$vjenis_kelamin?></option>
	    			<option value="Laki-Laki">Male</option>
	    			<option value="Perempuan">Female</option>
	    		</select>
	    	</div>

	    	<div class="form-group">
	    		<label>Address</label>
	    		<textarea class="form-control" name="talamat"  placeholder="Input Your Address"><?=@$valamat?></textarea>
			</div>

			<div class="form-group">
	    		<label>No HP</label>
	    		<input type="text" name="tno_hp" value="<?=@$vno_hp?>" class="form-control" placeholder="Input Your No Hp" required>
			</div>

			<div class="form-group">
	    		<label>Division</label>
	    		<input type="text" name="tdivisi" value="<?=@$vdivisi?>" class="form-control" placeholder="Input Your Division" required>
			</div>
		
			<div class="form-group">
	    		<label>Roles</label>
	    		<textarea class="form-control" name="troles"  placeholder="Input Your Roles"><?=@$vtestimoni?></textarea>
			</div>

	    	<button type="submit" class="btn btn-success" name="bsimpan">Save</button>
	    	<button type="reset" class="btn btn-danger" name="breset">Clear</button>

	    </form>
	  </div>
	</div>

	
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
			Data Member 
		<!-- untuk print -->
		<a href="print.php"><button class="btn-warning float-right">Report Print</button></a><br />
		<!--akhir print --->    
	  </div>
	  <div class="card-body">
	    
	    <table class="table table-bordered table-striped">
			<tr>
                <th>No</th>
                <th>NIK</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>No Hp</th>
                <th>Divisi</th>
                <th>Roles</th>
                <th>Aksi</th>
            </tr>
	    	<?php
	    		$no = 1;
	    		$tampil = mysqli_query($koneksi, "SELECT * from tb_member order by id_member desc");
	    		while($data = mysqli_fetch_array($tampil)) :

			?>
			<!-- open -->




			<!-- close -->
	    	<tr>
				<td><?=$no++;?></td>
                <td><?=$data['nik']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['jenis_kelamin']?></td>
                <td><?=$data['alamat']?></td>
                <td><?=$data['no_hp']?></td>
                <td><?=$data['divisi']?></td>
                <td><?=$data['roles']?></td>
	    		<td>
	    			<a href="admin.php?hal=edit&id=<?=$data['id_member']?>" class="btn btn-warning"> Edit </a>
	    			<a href="admin.php?hal=hapus&id=<?=$data['id_member']?>" 
					   onclick="return confirm('Are You Sure Want Delete This?')" class="btn btn-danger"> Delete </a>

	    		</td>
	    	</tr>
	    <?php endwhile;  ?>
	    </table>

	  </div>
	</div>
	

</div>



<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>