<?php
	include 'conn.php';
	$id=$_GET['id'];
	$sql="DELETE FROM buku WHERE id_buku='".$id."'";
	$rs=mysqli_query($conn,$sql);
	if($rs){
		echo '<script>
			alert("Data Berhasil Hapus");
			window.location="d_buku.php";
		</script>';
	}else{
		echo '<script>
			alert("Data Gagal di Hapus");
			window.location="d_buku.php";
		</script>';
	}
?>