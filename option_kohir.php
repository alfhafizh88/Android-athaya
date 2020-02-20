

<?php
// Load file koneksi.php
include "conn.php";

// Ambil data ID Provinsi yang dikirim via ajax post
$id_provinsi = $_POST['buku'];

// Buat query untuk menampilkan data kota dengan provinsi tertentu (sesuai yang dipilih user pada form)
$sql = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='".$id_provinsi."' ORDER BY nama_buku");

// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih


while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
	$html = "<label class='form-label' style='color: black'>No Kohir</label><input type='number' class='contoh1' placeholder='(No.   ".$data['mulai']." - No. ".$data['selesai'].")' name='kohir' min='".$data['mulai']."' max='".$data['selesai']."' style='width:100%; radius:2px'>"; // Tambahkan tag option ke variabel $html
}

$callback = array('data_kohir'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
