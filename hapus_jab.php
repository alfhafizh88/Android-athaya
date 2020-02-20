<?php
	include 'conn.php';
	$id=$_GET['key'];
	$sql="DELETE FROM jabatan WHERE id_jabatan='".$id."'";
	$rs=mysqli_query($conn,$sql);
	if($rs){
		echo '<script>
			alert("Data Berhasil Hapus");
			window.location="d_jabatan.php";
		</script>';
	}else{
		echo '<script>
			alert("Data Gagal di Hapus");
			window.location="d_jabatan.php";
		</script>';
	}
?>