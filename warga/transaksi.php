<?php
session_start();
include("conn.php");
function encrypt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    function decrypt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }




if(isset($_POST['simpan'])) {

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

    $query="INSERT into tanah values    ('', 
                                        '0',
                                        '".$_POST['kohir']."', 
                                        '".$_POST['buku']."', 
                                        '".$_POST['nama2']."', 
                                        '".$_POST['alamat']."', 
                                        '".$_POST['maps']."', 
                                        '".$_POST['provinsi']."', 
                                        '".$_POST['kota']."', 
                                        '".$_POST['notaris']."', 
                                        '".$_POST['nomor']."', 
                                        '".$_POST['tgl']."', 
                                        '".$_POST['persil']."', 
                                        '".$_POST['id_kelas']."', 
                                        '".$_POST['luas']."', 
                                        '".$_POST['id_satuan']."', 
                                        '".$_POST['tgl_r']."', 
                                        'picture/$nama_baru', 
                                        '".$_POST['gol']."',
                                        '".$_POST['akun2']."',
                                        now(),
                                        '0',
                                        '".$_POST['akun']."',
                                        '".$_POST['ket']."')";
    $hasil=mysqli_query($conn,$query);


    $query3="INSERT INTO mutasi2 values('', '".$_POST['id_tanah']."', last_insert_id(), '')"; 
    $hasil3=mysqli_query($conn, $query3);
    
    if($hasil && $hasil3) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
                window.location.href = "tanah.php";
             </script>';
    }

    }
}
}else if (isset($_POST['ubah'])) {
    $kueri="UPDATE buku set nama='".$_POST['nama']."', mulai='".$_POST['mulai']."', selesai='".$_POST['selesai']."', ket='".$_POST['ket']."' WHERE id_buku='".$_POST['kode']."'";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistem Pengelolaan Tanah</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of POST all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
<!-- <script src="..///code.jquery.com/jquery-migrate-1.1.1.js"></script>
<script src="..///code.jquery.com/jquery-2.0.0.js"></script>
<script src="..///code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="..///code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="..///code.jquery.com/jquery-2.2.0.min.js"></script> -->
<script>
    
        $("#kota").change(function() {
                    console.log($("#kota option:selected").val());
                    if ($("#kota option:selected").val() == '1') {
                        $('#no_ktp').prop('hidden', 'true');
                        $('#no_ktp2').prop('hidden', 'true');
                        $('#no_ktp3').prop('hidden', 'true');
                    } else if($("#kota option:selected").val() == '3'){
                        $('#no_ktp').prop('hidden', 'true');
                        $('#no_ktp2').prop('hidden', 'true');
                        $('#no_ktp3').prop('hidden', 'true');
                    }else if($("#kota option:selected").val() == ''){
                        $('#no_ktp').prop('hidden', 'true');
                        $('#no_ktp2').prop('hidden', 'true');
                        $('#no_ktp3').prop('hidden', 'true');
                    }else{
                        $('#no_ktp').prop('hidden', false);
                        $('#no_ktp2').prop('hidden', false);
                        $('#no_ktp3').prop('hidden', false);
                    }
        });
    
    
</script>

<script src="../js/jquery-2.2.0.min.js"></script>
<script>
    $(document).ready(function(){ // Ketika halaman sudah diload dan siap
        $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
            var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
            var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
            
            // Kita akan menambahkan form dengan menggunakan append
            // pada sebuah tag div yg kita beri id insert-form
            $("#insert-form").append("<b>Data ke-" + nextform + " :</b>" +
                "<div class='table-responsive'><table class='table table-bordered'>" +
                    "<tr>" +
                        "<th style='text-align:center;'>Kohir</th>" +
                        "<th style='text-align:center;'>Nama</th>" +
                        "<th style='text-align:center;'>Kelas</th>" +
                        "<th style='text-align:center;'>Luas</th>" +
                        "<th style='text-align:center;'>Tanggal</th>" +
                    "</tr>" +
                    "<tr>" +                   
                        "<td><input type='number' class='form-control' required name='kohir[]' required></td>" +
                        "<td><input type='text' class='form-control' required name='nama[]' required></td>" +
                        "<td><select name='kelas[]' id='kelas' class='form-control' data-live-search='true'><option value=''>Pilih Kelas Tanah</option><?php
                            // Load file koneksi.php
                            include 'conn.php';
                            
                            // Buat query untuk menampilkan semua data siswa
                            $sql = mysqli_query($conn, 'SELECT * FROM kelas');
                    
                            while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                echo "<option value='".$data['id_kelas']."'>".$data['nama_kelas']."</option>";
                            }
                            ?>"+
                            
                        "</select></td>" +
                        "<td><input type='number'  class='form-control' required name='luas[]' required></td>" +
                        "<td><input type='date'  class='form-control' required name='tanggal[]' required></td>" +
                    "</tr>" +
                "</table></div>" +
                "<br><br>");
            
            $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
        });
        
        // Buat fungsi untuk mereset form ke semula
        $("#btn-reset-form").click(function(){
            $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
            $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
        });
    });
    </script>
<!-- <script type="text/javascript">
    var bootstrapButton=
    $.fn.button.noConflict()

    $.fn.bootstrapBtn=
    bootstrapButton
</script> -->


    <!-- <script type="text/javascript">
        var param="";
    function ajak(){
        $.ajax({
            url:"aksi_tanah.php",
            async:true, 
            type:'GET',
            data:param,
            success:function(hasil){
                /*alert(hasil);*/
                $("#area_tanah").html(hasil);

            }
        });
    }
    function simpan_buku(){
        param="k="+$("#kode").val()+"&nm="+$("#nama").val()+"&ml="+$("#mulai").val()+"&sl="+$("#selesai").val()+"&kt="+$("#ket").val()+"&aksi=simpan";
        ajak();
        //alert(data);
    }
    function ubah_buku(){
        param="k="+$("#kode").val()+"&nm="+$("#nama").val()+"&ml="+$("#mulai").val()+"&sl="+$("#selesai").val()+"&kt="+$("#ket").val()+"&aksi=ubah";
        ajak();
        alert(data);
    }
    
    function hapus_buku(kode){
        param="k="+kode+"&aksi=hapus";
        ajak();
        //alert(data);
    }
    function load_bbm() {
            var sub=document.getElementById('subsidi').value;
            var params="id_jenis="+sub;
            var xhttp = new XMLHttpRequest();
            console.log(params);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("bbm").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "ajax_bbm.php?"+params,true);
            xhttp.send();
    }

    function tambah() {
        var xhttp = new XMLHttpRequest();
        var bbm=document.getElementById('jenis').value;
        var liter=document.getElementById('liter').value;
        var params="liter="+liter+"&bbm="+bbm;
        console.log(params);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "ajax_bbm.php?"+params,true);
        xhttp.send();
    }
</script> -->
</head>

<body class="theme-indigo">
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
            <p>Mohon tunggu...</p>
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
        <!-- Left Sidebar -->
        <?php include('left.php') ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <?php include('right.php') ?>
        <!-- #END# Right Sidebar -->
    </section>




    <section class="content">
        <div class="container-fluid">
            
    

<div class="block-header">
                <h2>
                    <ol class="breadcrumb breadcrumb-col-pink">
                                <li><a href="javascript:void(0);">Home</a></li>
                                <li class="active">Transaksi Tanah</li>
                    </ol>
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-style: 90px">
                                <i class="material-icons">library_books</i>  Transaksi Tanah
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

                          <?php
    include 'conn.php';
    $id=$_GET['id'];
    $sql="SELECT * FROM tanah WHERE id_tanah='".$id."'";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        $row=mysqli_fetch_assoc($rs);
    }else echo "ID Transaksi Salah!";


    $query3="SELECT id_mutasi2, 
                     t.kohir as kohir,  
                     tt.tgl_regis as tanggal_regis, 
                     tt.luas as luas,
                     sum(tt.luas) as luas2, 
                     s.nama_satuan as nama_satuan, 
                     t.nama_lengkap as dulu,
                     tt.nama_lengkap as dulu2,
                     tt.nama_lengkap as skrg,
                     m.skrg as skrg2,
                     tt.id_jb as id_jb,
                     t.nomor as nomor,
                     t.akun_pemilik as akun_pemilik
     FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                    join tanah tt on m.skrg=tt.id_tanah
                    join satuan s on t.id_satuan=s.id_satuan

     WHERE dulu=$row[id_tanah] order by tanggal_regis"; 
            $r3=mysqli_query($conn, $query3);
            $jum3=mysqli_num_rows($r3);
                 while($baris3 = mysqli_fetch_array($r3)) {
                    $sisa=$row['luas']-$baris3['luas2'];
                    /*$sisa=0;*/
                 }
?>
            
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pemilik Awal</h2>
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

                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" readonly='true' nama='persil' value="<?php echo $row['persil']?>" required>
                                        <label class="form-label" style="color: black"><b>No Persil</b></label>
                                    </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" readonly='true' value="<?php echo $row['kohir']?>" required>
                                    <label class="form-label" style="color: black"><b>No. Kohir</b></label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control"  readonly='true' value="<?php echo $row['nama_lengkap']?>" required>
                                    <label class="form-label" style="color: black"><b>Nama Pemilik Awal</b></label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" id='txt1' readonly='true' value="<?php echo $row['luas']?>" required>
                                    <label class="form-label" style="color: black"><b>Luas Awal</b></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" id='txt1' readonly='true' value="<?php echo $sisa;?>" required>
                                    <label class="form-label" style="color: black"><b>Luas Sisa</b></label>
                                </div>
                            </div>
</div>
</div>
</div>
</div>                            

                                    <!-- Basic Validation -->



            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pemilik Berikutnya</h2>
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



                            <form id="form_validation" method="POST" enctype="multipart/form-data" action="">

                                <input type="hidden" name="id_tanah" value="<?php echo $row['id_tanah']; ?>">
                                <input type="hidden" name="alamat" value="<?php echo $row['alamat']; ?>">
                                <input type="hidden" name="id_satuan" value="<?php echo $row['id_satuan']; ?>">
                                <input type="hidden" name="id_kelas" value="<?php echo $row['id_kelas']; ?>">
                                <input type="hidden" name="persil" value="<?php echo $row['persil']; ?>">
                                <input type="hidden" name="gol" value="<?php echo $row['gol']; ?>">
                                <input type="hidden" name="maps" value="<?php echo $row['maps']; ?>">
                                <input type="text" name='akun2' value="<?php echo $row['username'];?>">
                                <input type="text" name='akun' value="<?php echo $_SESSION['namauser'];?>">
                                
                                    <!-- <p>
                                        <b>Pilih Jenis</b>
                                    </p> -->



                                <!--
                                    NOMOR PETOK AUTO INCREMENT
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="petok" required>
                                        <label class="form-label">No Petok/Registrasi</label>
                                    </div>
                                </div> -->
                                <label class="form-label"><p style="color: black; font-size: 14px; font-style: arial;">Buku Fisik</p></label><br>
                                    <select name="buku" id="buku" class="form-control" data-live-search="true">
                                        <option value="">Pilih</option>
                                        
                                        <?php
                                        // Load file koneksi.php
                                        include "conn.php";
                                        
                                        // Buat query untuk menampilkan semua data siswa
                                        $sql = mysqli_query($conn, "SELECT * FROM buku WHERE status='Aktif' order by nama_buku");
                                
                                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                            echo "<option value='".$data['id_buku']."'>".$data['nama_buku']."<p style='color: red; font-size:12px;'> (No. </p>   ".$data['mulai']." - No. ".$data['selesai'].")</p></option>";
                                        }
                                        ?>
                                    </select>
                                

                                <br>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label"><p style="color: black;">No Kohir</p></label><br><br>
                                        <div id="kohir">
                                            
                                        </div>
                                        <!-- <input type="number" class="form-control" name="kohir" id="kohir" required> -->
                                        
                                        <div id="loading2" style="margin-top: 15px;">
                                            <img src="images/loading.gif" width="18"> <small>Loading...</small>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id_tanah"  value="<?php echo $row['id_tanah']?>">

                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama2"  required>
                                        <label class="form-label" style="color: black"><b>Nama Lengkap</b></label>
                                    </div>
                                </div>

                                    <label class="form-label"><p style="color: black;">Jenis Transkasi</p></label><br>
                                    <select name="provinsi" id="provinsi" class="form-control" data-live-search="true">
                                        <option value="">Pilih</option>
                                        
                                        <?php
                                        // Load file koneksi.php
                                        include "conn.php";
                                        
                                        // Buat query untuk menampilkan semua data siswa
                                        $sql = mysqli_query($conn, "SELECT * FROM jenis_transaksi");
                                
                                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                            echo "<option value='".$data['id_transaksi']."'>".$data['nama_jenis']."</option>";
                                        }
                                        ?>
                                    </select>
                                <br><br>
                                <label class="form-label"><p style="color: black;">Sub Jenis Transkasi</p></label><br>
                                    
                                    <select name="kota" id="kota" class="form-control" data-live-search="true">
                                        <option value="">Pilih</option>
                                    </select>
                                    <div id="loading" style="margin-top: 15px;">
                                        <img src="images/loading.gif" width="18"> <small>Loading...</small>
                                    </div>
                                <br><br>



                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="notaris" id="no_ktp" class="form-control" value="-" required hidden />
                                        <label class="form-label" style="color: black;"><b>Nama Notaris</b></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="nomor" id="no_ktp2" class="form-control" value="0" required hidden />
                                        <label class="form-label" style="color: black;"><b>Nomor</b></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;"><b>Tanggal</b></label>
                                    <div class="form-line">
                                        <input type="date" name="tgl" id="no_ktp3" class="form-control" value="0001-01-01" required hidden />
                                        
                                    </div>
                                </div>
                                




                                <!-- Radio Button Jenis Sawah
                                 <div class="form-group">
                                    <label class="form-label" style="color: black;">Jenis Tanah</label><br>
                                    <input type="radio" name="gender" id="sawah" class="with-gap">
                                    <label for="sawah">Sawah</label>

                                    <input type="radio" name="gender" id="darat" class="with-gap">
                                    <label for="darat" class="m-l-20">Darat</label>
                                </div> -->


                                <!-- <input type="text" class="form-control"  onkeyup="sum();" id="txt1" required> -->

                                <div class="form-group form-float" style="width: 50%;">
                                    <div class="form-line" style="width: 50%;">
                                        <input type="number" class="form-control" name="luas" id='txt2' min="1" max="<?php echo $sisa;?>" onkeyup="sum();" style="width: 50%" step='0.001' required>
                                        <label class="form-label" style="color: black;"><b>Luas Tanah (ex. 0.035)</b></label>
                                    </div>
                                </div><br>
                                
                                
                                <input type="hidden" name="total" id="txt3">

                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;"><b>Tanggal Resgistrasi</b></label>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="tgl_r" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;"><b>Berkas Pendukung</b></label>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="txtfoto">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;"><b>Keterangan</b></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ket" >
                                    </div>
                                </div>
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary waves-effect">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


                            
                            
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </section>



<script>
    <?php
                            // Load file koneksi.php
                            include 'conn.php';
                            
                            // Buat query untuk menampilkan semua data siswa
                            $sql = mysqli_query($conn, 'SELECT * FROM kelas');
    ?>
    
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += "<td contenteditable='true' class='item_name'><input type='number' class='form-control' name='persil'></td>";
   html_code += "<td contenteditable='true' class='item_desc'><input type='number' class='form-control' name='luas' placeholder='Example: 3400'></td>";
   html_code += "<td contenteditable='true' class='item_price'> <select name='kelas' id='kelas' class='form-control' data-live-search='true'><option value=''>Pilih Kelas Tanah</option><?php
                    
                            while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                echo '<option value='.$data['id_kelas'].'>'.$data['nama_kelas'].'</option>';
                            }
                            ?>";
                            
                            
                            
   html_code += "</select></td><td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
   html_code += "</tr>";  
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 
 $('#save').click(function(){
  var item_name = [];
  var item_code = [];
  var item_desc = [];
  var item_price = [];
  $('.item_name').each(function(){
   item_name.push($(this).text());
  });
  $('.item_code').each(function(){
   item_code.push($(this).text());
  });
  $('.item_desc').each(function(){
   item_desc.push($(this).text());
  });
  $('.item_price').each(function(){
   item_price.push($(this).text());
  });
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:{item_name:item_name, item_code:item_code, item_desc:item_desc, item_price:item_price},
   success:function(data){
    alert(data);
    $("td[contentEditable='true']").text("");
    for(var i=2; i<= count; i++)
    {
     $('tr#'+i+'').remove();
    }
    fetch_item_data();
   }
  });
 });
 
 function fetch_item_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#inserted_item_data').html(data);
   }
  })
 }
 fetch_item_data();
 
});
</script>





<script>
    $(document).ready(function(){
        $('.isi').click(function(){
            var menu = $(this).attr('id');
        if (menu=="dashboard") {
            $('.konten').load('dashboard.php');    
        }else if (menu=="tanah") {
            $('.konten').load('tanah.php');    
        }else if (menu=="about") {
            $('.konten').load('about.php');    
        }else if (menu=="d_buku") {
            $('.konten').load('d_buku.php');    
        }else if (menu=="d_lurah") {
            $('.konten').load('d_lurah.php');    
        }else if (menu=="detail_tanah") {
            $('.konten').load('detail_tanah.php');    
        }else if (menu=="profile") {
            $('.konten').load('profile.php');    
        }
    });
        $('.konten').load('dashboard.php');    

    });

</script>
<script>
    function sum(){
        var txtAwal=document.getElementById('txt1').value;
        var txtMutasi=document.getElementById('txt2').value;
        var result=parseFloat(txtAwal)-parseFloat(txtMutasi);
        if (!isNan(result)) {
            document.getElementById('txt3').value=result;
        }
    }
</script>
<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('txt1').value;
      var txtSecondNumberValue = document.getElementById('txt2').value;
      var result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('txt3').value = result;
      }
}
</script>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>


    <!-- Load librari/plugin jquery nya -->
    <script src="../js/jquery.min.js" type="text/javascript"></script>
    
    <script src="../js/config.js" type="text/javascript"></script>

    <!-- <script src="../https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>


    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>