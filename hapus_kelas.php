<?php
	include 'conn.php';
	$id=$_GET['key'];
	$sql="DELETE FROM kelas WHERE id_kelas='".$id."'";
	$rs=mysqli_query($conn,$sql);
	if($rs){
		echo '<script>
			alert("Data Berhasil Hapus");
			window.location="d_kelas.php";
		</script>';
	}else{
		echo '<script>
			alert("Data Gagal di Hapus");
			window.location="d_kelas.php";
		</script>';
	}
?>