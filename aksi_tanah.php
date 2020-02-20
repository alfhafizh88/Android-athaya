<html>
<head>
	<script type="text/javascript">
	var param="";
		function ajak(){
			$.ajax({
				url:"aksi_tanah.php",
				async:true, 
				type:'GET',
				data:param,
				success:function(hasil){
					//alert(hasil);
					$("#area_tanah").html(hasil);

				}
			});
		}
		function hapus_bbm(kode){
			param="k="+kode+"&aksi=hapus";
			ajak();
			/*alert(data);*/
		}
</script>
</head>
<body>
</body>
</html>
<?php
	include("conn.php");
	if ($_GET['aksi']=='simpan') {
		$kueri="INSERT INTO buku values('".$_GET['k']."','".$_GET['nm']."','".$_GET['ml']."', '".$_GET['sl']."','' , '".$_GET['kt']."','Aktif' )";
	}elseif ($_GET['aksi']=='hapus') {
		$kueri="DELETE  FROM buku WHERE id_buku='".$_GET['k']."'";
	}elseif ($_GET['aksi']=='ubah') {
		$kueri="UPDATE buku set nama='".$_GET['nm']."', mulai='".$_GET['ml']."', selesai='".$_GET['sl']."', ket='".$_GET['kt']."' WHERE id_buku='".$_GET['k']."'";
		echo $kueri;

	}elseif($_GET['aksi']=='load_bbm'){
		$kueri="SELECT jenis, status='".$_GET['id_buku_sub']."' FROM buku order by id_buku desc";
		$rs=mysqli_query($conn, $kueri);
            if ($rs) {
                while ($row=mysqli_fetch_array($rs)) {
                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                }
        	}
	}
	
	
	$hasil=mysqli_query($conn, $kueri);
	if ($hasil) 
		echo "<script type='text/javascript'>
                alert('Data berhasil di '".$_GET['aksi']."'!');
                setTimeout(\"location.href='index.php'\", 0);
             </script>";
	else
		echo "Data Gagal di'".$_GET['aksi']."'";
    echo $kueri;


                            $query="SELECT id_buku, nama_buku, mulai, selesai, kurang, ket
                                    FROM buku  ORDER BY nama_buku";
                                    $hasil = mysqli_query($conn, $query);   
                                    print_r($hasil);

                        echo '
                                        <div class="table-responsive">
<table>
                        <form action="index.php" method="POST"></form>
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Buku</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Kurang</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        ';
                        $jum=mysqli_num_rows($hasil);
                        while($baris = mysqli_fetch_array($hasil)) {
                            echo
                            '<tbody>
                            <tr>
                                <td>'.$baris[0].'</td>
                                <td>'.$baris['nama_buku'].'</td>
                                <td>'.$baris['mulai'].'</td>
                                <td>'.$baris['selesai'].'</td>
                                <td>'.$baris['kurang'].'</td>
                                <td>'.$baris['ket'].'</td>
                                <td><input type="button" value="Hapus" class="btn bg-red btn-block btn-xs waves-effect" onclick="hapus_buku('.$baris[0].')"/>
                                <input type="button" class="btn bg-green btn-block btn-xs waves-effect" value="Ubah" onclick="ubahData('.$baris[0].', \''.$baris['nama_buku'].'\', \''.$baris['mulai'].'\', \''.$baris['selesai'].'\', \''.$baris['ket'].'\')" /></td>
                            </tr> 
                            </tbody>
                            </table>
</div>                        

	<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->

<script src="js/pages/tables/jquery-datatable.js"></script>
<script src="js/admin.js"></script>
<script src="js/pages/index.js"></script>
<script src="js/pages/forms/advanced-form-elements.js"></script>

                            ';
                        }
                        ?>
