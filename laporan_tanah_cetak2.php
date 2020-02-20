<?php
if(empty($_POST['mutasi'])){
	echo'
	<script type="text/javascript">
            alert("Tidak ada data yang dipilih!");
            window.history.back();
    </script>
	';
}
$id=$_POST['mutasi'];

$jumlah=count($id);

if ($jumlah>0) {
	echo'
		<script type="text/javascript">
                alert("Data berhasil di simpan!");
                window.location.href="detail_transaksi.php";
        </script>
	';
}else{
	echo'
		<script type="text/javascript">
                alert("Data berhasil as");
                window.history.back()";
        </script>
	';
}


ob_start();
include "conn.php";
function tgl_indo($tanggal){
	$bulan = array (
		1 =>'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<style>
 .header{font-size: 16px;}
 .table{font-size: 12px;}
 .table tr th{font-size: 14px; text-align: center;}
</style>
<page backtop="5mm" backtop="10mm" backleft="10mm" backright="20mm">
<table cellspacing="0">
	<tr>
		<th rowspan="5" style="width: 50px; height: 60px"><!-- <img src="images/pemkot.png"/> --></th>
	</tr>
	<tr>
		<td style="width: 590px"><p style="text-align: center; padding-top: -10px; font-size: 16px">PEMERINTAH KOTA SURABAYA</p></td>
	</tr>
	<tr>
		<td style="width: 590px"><p style="text-align: center; padding-top: -10px; font-size: 16px">KECAMATAN RUNGKUT</p></td>
	</tr>
	<tr>
		<td style="width: 590px"><p style="text-align: center; padding-top: -15px; font-weight: bold; font-size: 18px">KELURAHAN MEDOKAN AYU</p></td>
	</tr>
	<tr>
		<td style="width: 590px"><p style="text-align: center; padding-top: -10px; font-size: 12px">Jl. Medokan Asri Utara IV No. 35 Telp. (031) 8708980 Fax. 8708980 Surabaya</p></td>
	</tr>
</table>
<hr/>

<table >
	<tr>
		<td colspan="2"><p style="text-align: center; font-weight: bold; text-decoration: underline; font-size: 14px">SURAT KETERANGAN</p></td>
	</tr>
	<tr>
		<td colspan="2"><p style="text-align: center; padding-top: -15px">Nomor : 593/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/436.9.3.6/<?php echo date('Y'); ?></p></td>
	</tr>
	<tr>
		<td colspan="2" style="width: 630px"><br><br>Dengan asal usul berdasarkan Buku C Kelurahan Medokan Ayu sebagai berikut:<br></td>
	</tr>
	<tr>
		<td style="width: 1px;"></td>
		<td style="width: 98%"></td>
	</tr>
</table>
<br>

	 <?php 
	 	include ('conn.php');
	 	if (empty($id)) {
	 		echo'
				<script type="text/javascript">
		                alert("Tidak ada data yang dipilih!");
		                window.history.back();
		        </script>
			';
	 	}
	 	$sql2="SELECT * FROM lurah 
	 		   WHERE tgl_masuk in (SELECT max(tgl_masuk) 
			   FROM lurah)";
		$rs2=mysqli_query($conn,$sql2);
		$row2=mysqli_fetch_assoc($rs2);

	 	$number=1;
                                    $query4="SELECT id_mutasi2, 
                                                 t.kohir as kohir,  
                                                 tt.tgl_regis as tanggal_regis, 
                                                 tt.luas as luas,
                                                 tt.id_tanah as id_tanah, 
                                                 s.nama_satuan as nama_satuan, 
                                                 t.nama_lengkap as dulu,
                                                 t.gol as gol, 
                                                 tt.kohir as kohir2,
                                                 tt.nama_lengkap as skrg,
                                                 m.dulu as dulu2,
                                                 skrg as skrg2,
                                                 t.nomor as nomor,
                                                 t.persil as persil,
                                                 k.nama_kelas as nama_kelas,
                                                 t.id_jb as id_jb,
                                                 t.id_transaksi as id_trans
                                 FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                                                join tanah tt on m.skrg=tt.id_tanah
                                                join satuan s on t.id_satuan=s.id_satuan
                                                join kelas k on t.id_kelas=k.id_kelas

                                 WHERE id_mutasi2 IN(".implode(",", $id).")"; 
                                $r4=mysqli_query($conn, $query4);
                                $jum4=mysqli_num_rows($r4);
                                echo "<table>";
                                  while($mutasi4 = mysqli_fetch_array($r4)) {
                                                echo '  
                                                    <tr>
                                                        <td style="padding-right:10px"><b>'.$number.'.</b><br></td>
                                                        <td>Pada tanggal '.$mutasi4['tanggal_regis'].', oleh '.$mutasi4['dulu'].' ';
                                                        if ($mutasi4['id_trans']==1) {
                                                        	echo'
                                                        	dijual kepada '.$mutasi4['skrg'].'
                                                        	';
                                                        }elseif ($mutasi4['id_trans']==2) {
                                                        	echo'
                                                        	dihibahkan kepada '.$mutasi4['skrg'].'
                                                        	';
                                                        }elseif ($mutasi4['id_trans']==3) {
                                                        	echo'
                                                        	diwariskan kepada '.$mutasi4['skrg'].'
                                                        	';
                                                        }elseif ($mutasi4['id_trans']==4) {
                                                        	echo'
                                                        	diwaqafkan kepada '.$mutasi4['skrg'].'
                                                        	';
                                                        }elseif ($mutasi4['id_trans']==5) {
                                                        	echo'
                                                        	dimutasikan kepada '.$mutasi4['skrg'].'
                                                        	';
                                                        }
                                        				if ($mutasi4['id_jb']==3) {
						                                		echo '  berdasarkan Akta Jual Beli Nomor '.$mutasi4['nomor'].' ';
						                                };                
                                                        echo ' terbit Kohir/C '.$mutasi4['kohir'].' Persil '.$mutasi4['persil'].' Kelas '.$mutasi4['nama_kelas'].' luas &plusmn; '.$mutasi4['luas'].' m2<br></td>
                                                    </tr>';$number=$number+1;
                                        }   
                                        echo "</table>";
        

	 	

	 	    
                                    ?>

<table>
	<tr>
		<td><p style="text-align: justify;">
			Dengan data berdasarkan catatan yang ada di Buku Letetr C, apabila di kemudian hari terdapat kekeliruan dan/atau ketidaksesuian sebagaimana tersebut diatas maka Surat Keterangan ini tidak bisa dijadikan dasar sebagai persyaratan pendaftaran tanah sebagaimana diatur dalam Peraturan Pemerintah No.24 Tahun 1997 tentang Pendaftaran Tanah Maupun dijadikan pendukung pembuktian hak atas tanah dan akan diadakan perbaikan atau pemebetulan sebagaimana mestinya.</p>
		</td>
	</tr>
</table>

	
<div style="position: absolute; bottom: 0px;">
<table>
	<tr>
	<td style="width: 300px" rowspan="4"></td>
		<td style="width: 300px;"><div style="padding-left: 125px;">Surabaya, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>


	</tr>
	<tr>
		<td><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --><div style="padding-left: 200px;">LURAH</div><br><br><br><br><br><br><br>
			<div style="padding-left: 100px;"><b><u><?php echo $row2['nama_lurah']; ?></u></b></div>


		</td>
		
	</tr>
	
</table>
</div>
</page>

<?php
	$content= ob_get_clean();
require_once"includes/html2pdf/html2pdf.class.php"; //letak html2pdf kamu
try {
	$html2pdf =new HTML2PDF('P','A4','en');	//P=Potrait
											//A4=Ukuran A4
											//en= Bahasa English
	
	$html2pdf->writeHTML($content, isset($GET['vuehtml']));

	/*$html2pdf->Image('images/pemkot.png', 10, 10, 80);*/
	$html2pdf-> Output('LaporanTanah.pdf', 'FI'); 
} catch (HTML2PDF_exception  $e) {
	echo $e;
	exit;
}
?>
