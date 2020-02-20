<?php
include "conn.php";
$aksi = $_REQUEST['aksi'];
switch ($aksi) {
	
	case 'hapus':
		$id = $_REQUEST['key'];

		$sql="DELETE FROM jenis_jualbeli WHERE id_jb='".$id."'";
		$rs=mysqli_query($conn,$sql);
		if($rs){
			echo '<script>
				alert("Data Berhasil Hapus");
				window.location="d_jenis.php";
			</script>';
		}else{
			echo '<script>
				alert("Data Gagal di Hapus");
				window.location="d_jenis.php";
			</script>';
		}
		break;

	case 'hapus2':
		$id = $_REQUEST['key'];

		$sql="DELETE FROM jenis_transaksi WHERE id_transaksi='".$id."'";
		$rs=mysqli_query($conn,$sql);
		if($rs){
			echo '<script>
				alert("Data Berhasil Hapus");
				window.location="d_jenis.php";
			</script>';
		}else{
			echo '<script>
				alert("Data Gagal di Hapus");
				window.location="d_jenis.php";
			</script>';
		}
		break;


			}
?>
<!-- <meta http-equiv="refresh"content="0;URL=index.php?module=buku"/> -->