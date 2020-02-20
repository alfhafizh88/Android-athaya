<?php
session_start();
include("conn.php");
include('pagination.php');
function encrypt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

function decrypt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }

if(isset($_POST['simpan'])) {

$kohir = $_POST['kohir']; // Ambil data kohir dan masukkan ke variabel kohir
$luas = $_POST['luas']; // Ambil data nama dan masukkan ke variabel nama
$kelas = $_POST['kelas']; // Ambil data tanah dan masukkan ke variabel tanah


$kohir2 = $_POST['kohir'];
$index = 0; // Set index array awal dengan 0
        
$count=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tanah WHERE kohir = '".$_POST['kohir']."'"));

    if ( $count > 0 ) {
    echo '<script type="text/javascript">
                alert("Kohir '.$_POST['kohir'].' sudah tersedia sebelumnya!");
                window.location.href = "tanah.php";
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
        foreach($kohir as $datakohir){ // Kita buat perulangan berdasarkan kohir sampai data terakhir
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
                        '".$datakohir."',
                        '".$kelas[$index]."',
                        '".$luas[$index]."',
                        '".$_POST['satuan']."', 
                        '".$_POST['tanggal_r']."',                        
                        'picture/$nama_baru',                        
                        '".$maxid."',
                        '".$_POST['akun']."',
                        now(),
                        '1',
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
            echo "<script>alert('Data berhasil disimpan');window.location = 'tanah.php';</script>";
        }else{
            echo "<script>alert('Gagal')</script>";

            
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
                                    '".$_POST['kohir']."',
                                    '', 
                                    '".$_POST['kelas']."',
                                    '".$_POST['luas2']."', 
                                    '".$_POST['satuan']."', 
                                    '".$_POST['tanggal_r']."',
                                    '".$_POST['foto']."',
                                    '".$_POST['opsi']."')";
    $hasil=mysqli_query($conn,$query);*/
}

    /*if ($hasil && $hasil2) {*/
        
        /*echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
             </script>';*/
    /*}*/
}else if (isset($_POST['ubah'])) {
    $kueri="UPDATE buku set nama='".$_POST['nama']."', mulai='".$_POST['mulai']."', selesai='".$_POST['selesai']."', ket='".$_POST['ket']."' WHERE id_buku='".$_POST['kode']."'";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
    $query="SELECT  nama_aplikasi
            FROM desain";
    $hasil = mysqli_query($conn, $query);  
    $jum=mysqli_num_rows($hasil);
    while($baris = mysqli_fetch_array($hasil)) {
        echo "<title>".$baris['nama_aplikasi']."</title>";
    }
    ?>

    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Colorpicker Css -->
    <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="plugins/nouislider/nouislider.min.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<?php
    $sql="SELECT  tema FROM desain WHERE pengguna='Admin'";
    $rs=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($rs);
    ?>
<body class="<?php echo $row['tema']; ?>">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->

    <?php include('top.php') ?>

    <!-- #Top Bar -->
    <section>
         <?php include('left.php') ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <?php include('right.php') ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            
            <div class="block-header">
                <h2>
                    <ol class="breadcrumb breadcrumb-col-pink">
                                <li><a href="javascript:void(0);">Home</a></li>
                                <li class="active">Laporan Kohir</li>
                    </ol>
                </h2>
            </div>

            <!-- Advanced Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Cetak Laporan Kohir
                                <small>Laporan ini dicetak berdasarkan kohir tanah</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Cari Kohir</b>
                                    </p>
                                    <form action="lap_kohir_cetak.php" method="POST">     
                                    <select class="form-control show-tick" data-live-search="true" name="kohir">
                                        <option value="">Pilih Kohir</option>
                                        <?php
                                        // Load file koneksi.php
                                        include "conn.php";
                                        
                                        // Buat query untuk menampilkan semua data siswa
                                        $sql = mysqli_query($conn, "SELECT distinct(kohir) FROM tanah WHERE status='1' order by kohir");
                                
                                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                            echo "<option value='".$data['kohir']."'>".$data['kohir']."</option>";
                                        }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="col-md-3">
                                    <br>
                                    <input type="submit" value="Cetak" name="submit" class="btn btn-info waves-effect" data-toggle="tooltip" data-placement="right" title="Cetak"/>
                                    </div>
                                    </form>
                                
                            </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- #END# Input Slider -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Colorpicker Js -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="plugins/nouislider/nouislider.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/advanced-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
