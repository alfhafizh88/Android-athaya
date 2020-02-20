<?php
include("conn.php");
$persil = $_POST['persil']; // Ambil data persil dan masukkan ke variabel persil
$luas = $_POST['luas']; // Ambil data nama dan masukkan ke variabel nama
$kelas = $_POST['kelas']; // Ambil data tanah dan masukkan ke variabel tanah


$persil2 = $_POST['persil'];
$index = 0; // Set index array awal dengan 0
        
$count=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tanah WHERE kohir = '".$_POST['kohir']."'"));

    if ( $count > 0 ) {
    echo '<script type="text/javascript">
                alert("Kohir '.$_POST['kohir'].' sudah tersedia sebelumnya!");
                window.location.href = "warga/tanah.php";
          </script>';
    
    }else{


// Proses simpan ke Database
$query = "INSERT INTO tanah VALUES";

if(!file_exists("picture")){
            mkdir("picture");
}
$ekstensi_diperbolehkan = array('pdf','');
/*$nama = $_FILES['txtfoto']['name'];
$x = explode('.', $nama);
$ekstensi = strtolower(end($x));*/
$tgl2=date("Y-m-d h:i:sa");

$asal_foto = $_FILES ['txtfoto']['tmp_name'];
$ukuran = $_FILES['txtfoto']['size'];
$hasil_foto = $_FILES ['txtfoto']['name'];
$x = explode('.', $hasil_foto);
$nama_baru=$hasil_foto;
$ekstensi = strtolower(end($x));
move_uploaded_file($asal_foto, "picture/".$nama_baru);

if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    if($ukuran < 10000000){  
    $index = 0; // Set index array awal dengan 0
    $index2=1;
        foreach($persil as $datapersil){ // Kita buat perulangan berdasarkan persil sampai data terakhir
        $q=mysqli_query($conn, "SELECT max(id_tanah)+$index2 from tanah");
            $r=mysqli_fetch_row($q);
            $maxid=$r[0]; 
            
            $query .= "('',
                        '1',
                        '".$_POST['kohir']."', 
                        '".$_POST['buku']."', 
                        '".$_POST['nama']."',
                        '".$_POST['alamat']."',
                        '".$_POST['maps']."',
                        '".$_POST['provinsi']."',
                        '".$_POST['kota']."',
                        '".$_POST['notaris']."',
                        '".$_POST['nomor']."',
                        '".$_POST['tanggal']."',
                        '".$datapersil."',
                        '".$kelas[$index]."',
                        '".$luas[$index]."',
                        '".$_POST['satuan']."', 
                        '".$_POST['tanggal_r']."',
                        'picture/$nama_baru',
                        '".$maxid."',
                        '".$_POST['akun']."',
                        now(),
                        '0',
                        '".$_POST['akun']."',
                        '".$_POST['opsi']."'
                        ),";
                     /*   $maxid++;*/
                     $index2++;
            $index++;
        }

            // Kita hilangkan tanda koma di akhir query
            // sehingga kalau di echo $query nya akan sepert ini : (contoh ada 2 data siswa)
            // INSERT INTO siswa VALUES('1011001','Rizaldi','Laki-laki','089288277372','Bandung'),('1011002','Siska','Perempuan','085266255121','Jakarta');
            $query = substr($query, 0, strlen($query) - 1).";";

            // Eksekusi $query
            $res=mysqli_query($conn, $query);


            


        // Buat sebuah alert sukses, dan redirect ke halaman awal (index.php)
        if ($res) {
            echo "<script>alert('Data berhasil disimpan');window.location = 'warga/tanah.php';</script>";
        }else{
            echo "<script>alert('Data gagal ditambahkan')</script>";
            echo print_r($query);
        }

    }else{
        echo '<script>alert("Ukuran File terlalu besar!.")</script>';
    }
}else{
    echo '<script>alert("HANYA EKSTENSI FILE PDF YANG DI PERBOLEHKAN")</script>';   
}


    /*$query="INSERT into tanah values ('',
                                    '".$_POST['kohir']."', 
                                    '".$_POST['buku']."', 
                                    '".$_POST['nama']."',
                                    '".$_POST['alamat']."',
                                    '".$_POST['provinsi']."',
                                    '".$_POST['kota']."',
                                    '".$_POST['notaris']."',
                                    '".$_POST['nomor']."',
                                    '".$_POST['tanggal']."',
                                    '".$_POST['persil']."',
                                    '', 
                                    '".$_POST['kelas']."',
                                    '".$_POST['luas2']."', 
                                    '".$_POST['satuan']."', 
                                    '".$_POST['tanggal_r']."',
                                    '".$_POST['foto']."',
                                    '".$_POST['opsi']."')";
    $hasil=mysqli_query($conn,$query);*/
}

?>