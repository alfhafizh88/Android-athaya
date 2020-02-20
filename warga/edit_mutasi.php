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

if (isset($_POST['ubah'])) {

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
    $nama_baru="[".$_POST['id_tanah']."]".$hasil_foto;
    $ekstensi = strtolower(end($x));
    move_uploaded_file($asal_foto, "picture/".$nama_baru);
    
    
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 1000000){  
    if(isset($_POST['cekpicture']) && $_POST['cekpicture']=='ganti'){
            $kueri="UPDATE tanah set nama_lengkap='".$_POST['nama']."', alamat='".$_POST['alamat']."', maps='".$_POST['maps']."', id_transaksi='".$_POST['provinsi']."', id_jb='".$_POST['kota']."', nama_notaris='".$_POST['notaris']."', tgl='".$_POST['tanggal']."', id_jb='".$_POST['kota']."', persil='".$_POST['persil']."', luas='".$_POST['luas2']."', tgl_regis='".$_POST['tanggal_r']."', foto='picture/$nama_baru', username='".$_POST['akun']."' ,ket='".$_POST['opsi']."'  WHERE id_tanah='".$_POST['id_tanah']."'";
                
    }else{
        $kueri="UPDATE tanah set nama_lengkap='".$_POST['nama']."', alamat='".$_POST['alamat']."', maps='".$_POST['maps']."', id_transaksi='".$_POST['provinsi']."', id_jb='".$_POST['kota']."', nama_notaris='".$_POST['notaris']."', tgl='".$_POST['tanggal']."', id_jb='".$_POST['kota']."', persil='".$_POST['persil']."', luas='".$_POST['luas2']."', tgl_regis='".$_POST['tanggal_r']."', username='".$_POST['akun']."', last_seen=now(), ket='".$_POST['opsi']."' WHERE id_tanah='".$_POST['id_tanah']."'";
    }
    $hasil=mysqli_query($conn,$kueri);
    
    if ($hasil==true) {
        echo"<script>alert ('Update berhasil');
        window.location.href = 'tanah.php';
        </script>
        ";

    } else {
        echo"<script>alert ('Update gagal');
        window.location.href = 'tanah.php';</script>";
    }
            }else{
                    echo '<script>alert("Ukuran File terlalu besar!.")
                        window.location.href = "tanah.php";
                    </script>';
                }
    }else{
        echo '<script>alert("HANYA EKSTENSI FILE PDF YANG DI PERBOLEHKAN")window.location.href="tanah.php";</script>';   
    }
    

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
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of POST all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
<!-- <script src="//code.jquery.com/jquery-migrate-1.1.1.js"></script>
<script src="//code.jquery.com/jquery-2.0.0.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-2.2.0.min.js"></script> -->
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

<script src="js/jquery-2.2.0.min.js"></script>
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
                        "<th style='text-align:center;'>Persil</th>" +
                        "<th style='text-align:center;'>Luas</th>" +
                        "<th style='text-align:center;'>jenis Tanah</th>" +
                    "</tr>" +
                    "<tr>" +                   
                        "<td><input type='number' class='form-control' required name='persil[]' required></td>" +
                        "<td><input type='text' class='form-control' required name='luas[]' required></td>" +
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

<body class="theme-red">
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
                                <li class="active">Administrasi Tanah</li>
                    </ol>
                </h2>
            </div>
            <!-- Basic Examples -->
            <!-- <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-style: 90px">
                                <i class="material-icons">library_books</i>  Administrasi Tanah
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
                            
                                <button type="button" class="btn btn-primary waves-effect">
                                    <i class="material-icons">note_add</i>
                                    <span>Tambah Data</span>
                                </button>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No Persil</th>
                                            <th>No Petok</th>
                                            <th>Kelas</th>
                                            <th>Nama</th>
                                            <th>Luas Tanah</th>
                                            <th>Tgl Perolehan</th>
                                            <th>No. Petok/Nama </th>
                                            <th>Salary</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td><button type="button" class="btn bg-green waves-effect" data-toggle="modal" data-target="#defaultModal">Detail</button><a href="" class="btn bg-red btn-block btn-xs waves-effect">Transaksi</a></td>
                                        </tr>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>90</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                                <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                                            </div>
                                            <div class="modal-body">
                                                <TABLE>
                                                    <tr>
                                                        <td><b>No. IPEDA</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px">100</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nama Lengkap</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px">aa</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Alamat Lengkap</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px">Jalan</td>
                                                    </tr>

                                                    <tr>
                                                        <td><b>Luas Awal</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px">1 ha</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Sisa Luas</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px">0.0000 ha</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>jenis Transaksi</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px"> sfsfsf</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>No. Petok/Registrasi</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px"> sfsfsf</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>No. Persil</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px">1 ha</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Kelas Desa</b></td>
                                                        <td>:</td>
                                                        <td style="padding-left: 10px">1 ha</td>
                                                    </tr>

                                                </TABLE>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-style: 90px">
                                
                                <i class="material-icons">library_books</i>  Data Administrasi Tanah
                             &nbsp;&nbsp;<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
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
                                    <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>FORM ADMINISTRASI TANAH</h2>
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
    $id=$_GET['key'];
    $sql="SELECT * FROM tanah WHERE id_tanah='".$id."'";
    $rs=mysqli_query($conn,$sql);
        if($rs){
            $row=mysqli_fetch_assoc($rs);
        }else echo "ID Mutasi Salah!";
?>
                            <form id="form_validation" method="POST" action="edit_mutasi.php" enctype="multipart/form-data">
                                <input type="hidden" name="id_tanah" value="<?php echo $row['id_tanah']?>">
                                <input type="hidden" name="akun" value="<?php echo $_SESSION['namauser']?>">

                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black">Nama Lengkap</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_lengkap']?>" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black">Alamat Lengkap</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat']?>" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black">Maps <span style="color: red">(https://www.google.com/maps/embed?pb=!1m..)</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="maps" value="<?php echo $row['maps']?>" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black">Persil</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="persil" value="<?php echo $row['persil']?>" required>
                                    </div>
                                </div>

                                    <label class="form-label"><p style="color: black;">Jenis Transkasi</p></label><br>
                                    <select name="provinsi" id="provinsi" class="form-control" data-live-search="true" required>
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

                                <label class="form-label"><p style="color: black;">Sub jenis Transkasi</p></label><br>
                                    
                                    <select name="kota" id="kota" class="form-control" data-live-search="true" required>
                                        <option value="0">Pilih</option>
                                    </select>
                                    <div id="loading" style="margin-top: 15px;">
                                        <img src="images/loading.gif" width="18"> <small>Loading...</small>
                                    </div>
                                <br><br>



                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="notaris" id="no_ktp" class="form-control" value="<?php echo $row['nama_notaris']?>" required hidden />
                                        <label class="form-label" style="color: black;">Nama Notaris</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="nomor" id="no_ktp2" class="form-control" value="<?php echo $row['nomor']?>" required hidden />
                                        <label class="form-label" style="color: black;">Nomor</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    
                                    <div class="form-line">
                                        <input type="date" name="tanggal" id="no_ktp3" class="form-control" value="<?php echo $row['tgl']?>" required hidden />
                                    <label class="form-label" style="color: black;">Tanggal</label>    
                                    </div>
                                </div>
                                




                                <!-- Radio Button jenis Sawah
                                 <div class="form-group">
                                    <label class="form-label" style="color: black;">jenis Tanah</label><br>
                                    <input type="radio" name="gender" id="sawah" class="with-gap">
                                    <label for="sawah">Sawah</label>

                                    <input type="radio" name="gender" id="darat" class="with-gap">
                                    <label for="darat" class="m-l-20">Darat</label>
                                </div> -->





<!-- MULTIPLE INSERT -->



                                <!-- <button type="button" id="btn-tambah-form">Tambah Data Form</button>
        <button type="button" id="btn-reset-form">Reset Form</button><br><br>
        
        <b>Data ke 1 :</b>
        <div class='table-responsive'>
            <table class='table table-bordered'>
                <tr>
                    <td>No. Persil</td>
                    <td>Luas</td>
                    <td>jenis Tanah</td>
                </tr>
                <tr>
                    <td><input type="number" name="persil[]" class='form-control' required></td>
                    <td><input type="number" name="luas[]" class='form-control' min="1" max="999999.999" step="0.1" required></td>
                    <td><select name='kelas[]' id='kelas' class='form-control' data-live-search='true'><option value=''>Pilih Kelas Tanah</option><?php
                            // Load file koneksi.php
                            include 'conn.php';
                            
                            // Buat query untuk menampilkan semua data siswa
                            $sql = mysqli_query($conn, 'SELECT * FROM kelas');
                    
                            while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                echo "<option value='".$data['id_kelas']."'>".$data['nama_kelas']."</option>";
                            }
                            ?>
                            
                        </select></td>
                </tr>
            </table>
        </div>
        <br>

        <div id="insert-form"></div>
        
        <hr>
        

        <input type="hidden" id="jumlah-form" value="1">
 -->





<!-- <div class="table-responsive">
    <table class="table table-bordered" id="crud_table">
     <tr>
      <th width="30%">No. Persil</th>
      <th width="30%">Luas</th>
      <th width="30%">jenis Tanah</th>
      <th width="10%">Aksi</th>
      
     </tr>
     <tr>
      <td contenteditable="false" class="item_name"><input type='number' class='form-control' name='persil'></td>
      <td contenteditable="false" class="item_desc"><input type='number' class='form-control' name='luas' placeholder='Example: 3400'></td>
      <td contenteditable="false" class="item_price"><select name="kelas" id="kelas" class="form-control" data-live-search="true">
                            <option value="">Pilih Kelas Tanah</option>
                            <?php
                            // Load file koneksi.php
                            include "conn.php";
                            
                            // Buat query untuk menampilkan semua data siswa
                            $sql = mysqli_query($conn, "SELECT * FROM kelas");
                    
                            while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                echo "<option value='".$data['id_kelas']."'>".$data['nama_kelas']."</option>";
                            }
                            ?>
                        </select></td>
      <td></td>
     </tr>
    </table>
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
    </div>
 -->    <!-- <div align="center">
     <button type="button" name="save" id="save" class="btn btn-info">Save</button>
    </div> -->
<!--     <br />
    <div id="inserted_item_data"></div>
   </div> -->




                                <!-- <div class="form-group form-float">
                                    <label class="form-label">Kelas Tanah</label><br>
                        <select name="kelas" id="kelas" class="form-control" data-live-search="true">
                            <option value="">Pilih Kelas Tanah</option>
                            <?php
                            // Load file koneksi.php
                            include "conn.php";
                            
                            // Buat query untuk menampilkan semua data siswa
                            $sql = mysqli_query($conn, "SELECT * FROM kelas");
                    
                            while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                echo "<option value='".$data['id_kelas']."'>".$data['nama_kelas']."</option>";
                            }
                            ?>
                        </select>
                                </div> -->

                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;">Luas Tanah (ex. 0,035)</label>
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="luas2" value="<?php echo $row['luas']?>" required>
                                    </div> 
                                </div>
                                 

                                 <!-- <label class="form-label">Satuan Luas</label><br> -->
                                   <!--  <select name="satuan" class="form-control" data-live-search="true" style="visibility:hidden;">
                                        <?php
                                        // Load file koneksi.php
                                        include "conn.php";
                                        
                                        // Buat query untuk menampilkan semua data siswa
                                        $sql = mysqli_query($conn, "SELECT * FROM satuan");
                                
                                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                            echo "<option value='".$data['id_satuan']."'>".$data['nama_satuan']."</option>";
                                        }
                                        ?>
                                    </select> -->

                                <!-- <div class="form-group form-float" style="width: 50%;">
                                    <div class="form-line" style="width: 50%;">
                                        <label class="form-label" style="color: black;">Satuan Luas Tanah</label><br>
                                        <select class="form-control" name="satuan" data-live-search="true" style="width: 50%">
                                                    <option value="">Pilih Satuan Tanah</option>
                                                    <option value="m2">m2.</option>
                                                    <option value="ha">ha.</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;">Tanggal Registrasi</label>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="tanggal_r" value="<?php echo $row['tgl_regis']?>" required>
                                    </div> 
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;">Berkas Pendukung</label>
                                    <div class="form-line">
                                        <embed src="<?php echo $row['foto']?>" id="picture"><br>
                                                <input type="checkbox" class="filled-in" id="ig_checkbox" name="cekpicture" value="ganti" onclick="javascript: if(this.checked==true){$('#picture').hide(100);}else{$('#picture').show(100);}">
                                                <label for="ig_checkbox">&nbsp; Centang untuk ganti bukti dokumen</label>
                                        <input type="file" name="txtfoto" class="form-control" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;">Keterangan</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="opsi" value="<?php echo $row['ket']?>">
                                    </div> 
                                </div>
                                <input type="submit" name="ubah" value="Ubah" class="btn btn-primary waves-effect">
                                <!-- <button type="button" name="save" id="save" class="btn btn-info">Save</button> -->
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
   html_code += "<td contenteditable='false' class='item_name'><input type='number' class='form-control' name='persil'></td>";
   html_code += "<td contenteditable='false' class='item_desc'><input type='number' class='form-control' name='luas' placeholder='Example: 3400'></td>";
   html_code += "<td contenteditable='false' class='item_price'> <select name='kelas' id='kelas' class='form-control' data-live-search='true'><option value=''>Pilih Kelas Tanah</option><?php
                    
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
  var item_desc = [];
  var item_price = [];
  $('.item_name').each(function(){
   item_name.push($(this).text());
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
   data:{item_name:item_name, item_desc:item_desc, item_price:item_price},
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

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>


    <!-- Load librari/plugin jquery nya -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    
    <script src="js/config.js" type="text/javascript"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

    <!-- Jquery DataTable Plugin Js -->
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
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>


    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>