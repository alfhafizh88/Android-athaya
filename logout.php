<?php
session_start();
if (isset($_SESSION['namauser'])) {
	session_destroy();
echo "<script>window.alert('Anda berhasil logout.');
                window.location=('index.php')</script>";        
}
?>
