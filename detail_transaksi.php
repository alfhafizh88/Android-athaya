<?php
session_start();
include("conn.php");
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

    $query="INSERT into mutasi values  ('', 
                                        '".$_POST['id_tanah']."', 
                                        '".$_POST['kohir']."', 
                                        '".$_POST['nama2']."', 
                                        '".$_POST['provinsi']."', 
                                        '".$_POST['kota']."', 
                                        '".$_POST['notaris']."', 
                                        '".$_POST['nomor']."', 
                                        '".$_POST['tgl']."', 
                                        '".$_POST['tgl_r']."', 
                                        '".$_POST['luas']."', 
                                        '".$_POST['foto']."', 
                                        '',
                                        '',
                                        '".$_POST['ket']."')";
    $hasil=mysqli_query($conn,$query);
    
    /*$query2="UPDATE tbl_buku set jumlah_buku=jumlah_buku-".$_POST['qty']." where id='".$_POST['bbm2']."'";
    echo $query2."<br/>";
    $hasil2=mysqli_query($conn,$query2);*/
    
    if($hasil /*&& $hasil2*/) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
                window.location.href = "tanah.php";
             </script>';
    }
}else if (isset($_POST['ubah'])) {
    $kueri="UPDATE buku set nama='".$_POST['nama']."', mulai='".$_POST['mulai']."', selesai='".$_POST['selesai']."', ket='".$_POST['ket']."' WHERE id_buku='".$_POST['kode']."'";
}{

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

    <style type="text/css">
        .tab{
            padding: 0px 10px 0px 10px;
        }
    </style>

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

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

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
                                                        <td><b>Jenis Transaksi</b></td>
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
                                
                                <i class="material-icons">library_books</i>  Detail Tanah
                             
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
    $sql="SELECT  *
        FROM tanah t join kelas k on k.id_kelas=t.id_kelas join jenis_transaksi jt on jt.id_transaksi=t.id_transaksi join satuan s on s.id_satuan=t.id_satuan join buku b on b.id_buku=t.id_buku join akun a on a.username=t.username
        WHERE t.status='1' and id_tanah='".$id."'
        ";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        $row=mysqli_fetch_assoc($rs);
    }else echo "ID Transaksi Salah!";
    
    $id=$_GET['id'];

    $sql2="SELECT * FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                                 join tanah tt on m.skrg=tt.id_tanah
                                 where dulu='".$id."'";
    $rs2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($rs2);



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
                     t.nomor as nomor
     FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                    join tanah tt on m.skrg=tt.id_tanah
                    join satuan s on t.id_satuan=s.id_satuan

     WHERE dulu=$row[id_tanah] and tt.status='1' order by tanggal_regis"; 
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
                            <h2><?php echo $row['nama_lengkap']?> [<?php echo $row['kohir']?>]</h2>
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
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php
                                $map='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2682452679774!2d112.7934601143213!3d-7.323737474053359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fabd50965723%3A0x7766c73f4bbdea28!2sKantor+Kelurahan+Medokan+Ayu!5e0!3m2!1sid!2sid!4v1564989772359!5m2!1sid!2sid';
                                if ($row['maps']=='') {
                                    echo "<div class='alert bg-red'>
                                            Lokasi peta tidak tersedia. Mohon lengkapi data tanah terlebih dahulu.
                                        </div>";
                                }else{
                                    echo'
                                        <iframe src="'.$row['maps'].'" width="250" height="320" frameborder="0" style="border:100px" allowfullscreen></iframe>       
                                    ';    
                                }
                            ?>
                            
                             <br>
                             
                                 
                             
                            <?php
                            if ($sisa>0) {
                                echo '<div style="position: absolute; top: 330px; right: 60px; width:80%; padding-right:40px"><br><a href="transaksi.php?id='.$row['id_tanah'].'" class="btn bg-red waves-effect" style="width: 100%;">Transaksi</a></div>';
                            } else {
                                  echo '<br><button type="button" class="btn bg-red waves-effect" disabled="disabled" style="width:100%">Transaksi</button>';
                            }
                            
                            
                            
                            ?>

                                </div>
                            
                          
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php 
                                        if ($sisa>0) {
                                            echo '<div class="alert alert-success alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    Tersedia tanah sisa
                                                </div>';    
                                        } else {
                                            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    Tidak tersedia tanah sisa
                                                </div>';
                                        }
                                        

                                    ?>
                                    
                                <table>
                                    <tr>
                                        <td><b>Buku Fisik</b></td>
                                        <td class="tab">:</td>
                                        <td><?php echo $row['nama_buku']?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Transaksi</b></td>
                                        <td class="tab">:</td>
                                        <td><?php echo $row['tgl_regis']?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Jenis Tanah</b></td>
                                        <td class="tab">:</td>
                                        <td><?php echo $row['nama_kelas']?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Kohir/C</b></td>
                                        <td class="tab">:</td>
                                        <td><?php echo $row['kohir']?> Persil <?php echo $row['persil']?> </td>
                                    </tr>
                                    <tr>
                                        <td><b>Jenis Transaksi</b></td>
                                        <td class="tab">:</td>
                                        <td><?php echo $row['nama_jenis']?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Luas Tanah</b></td>
                                        <td class="tab">:</td>
                                        <td>&plusmn; <?php echo round($row['luas'])?> <?php echo $row['nama_satuan']?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Lokasi Tanah</b></td>
                                        <td class="tab">:</td>
                                        <td><?php echo $row['alamat']?>, Kelurahan Medokan Ayu, Kecamatan Rungkut, Surabaya</td>
                                    </tr>
                                    <tr>
                                        <td><b>Dokumen</b></td>
                                        <td class="tab">:</td>
                                        <td>
                                            <?php
                                                if ($row['foto']=='picture/') {
                                                echo '
                                                    <div style="color:red;">Dokumen Tidak Tersedia</div>
                                                    ';
                                                }else{
                                                echo'
                                                    <a href="'.$row['foto'].'" target="_blank">Klik untuk melihat</a>        
                                                ';
                                                }
                                            ?>

                                            </td>
                                    </tr>
                                    <tr>
                                        <td><b>Sisa Luas</b></td>
                                        <td class="tab">:</td>
                                        <td><?php  
                                         echo "&plusmn; ".$sisa." m2.";   
                                        ?></td>
                                    </tr>
                                    <?php
                                    if (empty($row['username'])) {
                                        echo"
                                        <tr>
                                            <td><b>Terakhir di edit:</b></td>
                                            <td class='tab'>:</td>
                                            <td>
                                             Belum pernah di edit
                                            </td>
                                        </tr>";
                                    } else {
                                        echo"
                                        <tr>
                                            <td><b>Terakhir di edit:</b></td>
                                            <td class='tab'>:</td>
                                            <td>
                                             Oleh <a href='#' data-toggle='modal' data-target='#smallModal'>".$row['username']."</a>  pada ".$row['last_seen']."
                                            </td>
                                        </tr></table><br><br>";

                                $sql3="SELECT * FROM akun 
                                where username='".$row['username']."'";
                                $rs3=mysqli_query($conn,$sql3);
                                $row3=mysqli_fetch_assoc($rs3);

                                        echo'
                                            <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Profil Pengguna</h4>
                        </div>
                        <div class="modal-body">

                            <table>
                                        <tr>
                                            <td><b>Username</b></td>
                                            <td class="tab">:</td>
                                            <td>'.$row3['username'].'</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nama Lengkap</b></td>
                                            <td class="tab">:</td>
                                            <td>'.$row3['username'].'</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td class="tab">:</td>
                                            <td>'.$row3['email'].'</td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td class="tab">:</td>
                                            <td>'.$row3['alamat'].'</td>
                                        </tr>
                                        <tr>
                                            <td><b>No. Telp</b></td>
                                            <td class="tab">:</td>
                                            <td>'.$row3['telepon'].'</td>
                                        </tr>
                                        <tr>
                                            <td><b>Level</b></td>
                                            <td class="tab">:</td>
                                            <td>'.$row3['level'].'</td>
                                        </tr>
                                    </table>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

                                        ';
                                    }
                                    

                                    ?>
                                    

                                               <!-- Small Size -->                             
                                <h4>Riwayat Penjualan / Hibah / Waris<p style="color: red">(Sebagian)</p> </h4><br>

                                <?php
                                $_SESSION=$row['id_tanah'][0];
                                
                                echo '
                                <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><i class="material-icons" style="font-size:14px;">vpn_key</i> No Petok/Nama</th>
                                        <th><i class="material-icons" style="font-size:14px;">date_range</i> Tanggal</th>
                                        <th><i class="material-icons" style="font-size:14px;">straighten</i> Luas</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $number=1;
                                 $query2="SELECT id_mutasi2, 
                                                 tt.kohir as kohir,  
                                                 tt.tgl_regis as tanggal_regis, 
                                                 tt.luas as luas,
                                                 tt.id_tanah as id_tanah, 
                                                 s.nama_satuan as nama_satuan, 
                                                 t.nama_lengkap as dulu, 
                                                 tt.nama_lengkap as skrg 
                                 FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                                                join tanah tt on m.skrg=tt.id_tanah
                                                join satuan s on t.id_satuan=s.id_satuan

                                 WHERE m.dulu=$row[id_tanah] and tt.status='1'"; 
                                                $r2=mysqli_query($conn, $query2);
                                                $jum2=mysqli_num_rows($r2);
                                                echo'                                                  
                                                            <tr>
                                                                <th scope="row">'.$number.'</th>
                                                                <td><a href="detail_transaksi.php?id='.$row['id_tanah'].'">['.$row['kohir'].'] '.$row['nama_lengkap'].'</a></td>
                                                                <td>'.$row['tgl_regis'].'</td>
                                                                <td>'.$row['luas'].' '.$row['nama_satuan'].'</td>
                                                            </tr>';

                                                            $number=2;
                                                while($mutasi = mysqli_fetch_array($r2)) {
                                                        echo '                                                  
                                                            <tr>
                                                                <th scope="row">'.$number.'</th>
                                                                <td><a href="detail_transaksi.php?id='.$mutasi['id_tanah'].'">['.$mutasi['kohir'].'] '.$mutasi['skrg'].'</a></td>
                                                                <td>'.$mutasi['tanggal_regis'].'</td>
                                                                <td>'.$mutasi['luas'].' '.$row['nama_satuan'].'</td>
                                                            </tr>';$number=$number+1;    
                                                }
                            echo '
                                </tbody>
                            </table>
                        </div><br><br><br>
                                ';


                                         $query5="SELECT id_mutasi2, 
                                                 t.kohir as kohir,  
                                                 tt.tgl_regis as tanggal_regis, 
                                                 tt.luas as luas,
                                                 tt.id_tanah as id_tanah, 
                                                 s.nama_satuan as nama_satuan, 
                                                 t.nama_lengkap as dulu, 
                                                 t.gol as gol,
                                                 tt.nama_lengkap as skrg,
                                                 tt.kohir as kohir2,
                                                 skrg as skrg2
                                 FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                                                join tanah tt on m.skrg=tt.id_tanah
                                                join satuan s on t.id_satuan=s.id_satuan
                                 WHERE tt.gol=105 and tt.status='1' order by tanggal_regis asc"; 
                                  $r5=mysqli_query($conn, $query5);
                                  $jum5=mysqli_num_rows($r5);
                                  ?>    

                                  <h4>Riwayat Penjualan / Hibah/ Waris<p style="color: red">(Keseluruhan)</p></h4><br>
                                    <form action="laporan_tanah_cetak2.php" method="POST" id="form-delete">
                                        
                                        <button type="button" class="btn btn-success waves-effect" value="Cetak (PDF)" id="btn-delete"><i class="material-icons">print</i> Cetak</button><br>
                                    
                                    
                                  <?php

                                    echo '   <div class="body table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    
                                        <tr>
                                        <th>#</th>
                                        <th><i class="material-icons" style="font-size:14px;">vpn_key</i> Dahulu</th>
                                        <th><i class="material-icons" style="font-size:14px;">vpn_key</i> Sekarang</th>
                                        <th><i class="material-icons" style="font-size:14px;">date_range</i> Tanggal</th>
                                        <th><i class="material-icons" style="font-size:14px;">straighten</i> Luas</th>
                                        <th><i class="material-icons" style="font-size:14px;">print</i> Cetak</th>
                                    </tr>
                                        </thead>
                                <tbody>
                                    ';
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
                                                 skrg as skrg2
                                 FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                                                join tanah tt on m.skrg=tt.id_tanah
                                                join satuan s on t.id_satuan=s.id_satuan

                                 WHERE t.gol=$row[gol] and tt.status='1'"; 
                                $r4=mysqli_query($conn, $query4);
                                $jum4=mysqli_num_rows($r4);

                                  while($mutasi4 = mysqli_fetch_array($r4)) {
                                        echo '                                            
                                                <tr>
                                                    <th scope="row">'.$number.'</th>
                                                    <td><a href="detail_transaksi.php?id='.$mutasi4['dulu2'].'">['.$mutasi4['kohir'].'] '.$mutasi4['dulu'].'</a></td>
                                                    <td><a href="detail_transaksi.php?id='.$mutasi4['skrg2'].'">['.$mutasi4['kohir2'].'] '.$mutasi4['skrg'].'</a></td>
                                                    <td>'.$mutasi4['tanggal_regis'].'</td>
                                                    <td>'.$mutasi4['luas'].' '.$row['nama_satuan'].'</td>
                                                    <td><input type="checkbox" id="'.$mutasi4['id_mutasi2'].'"class="chk-col-green" class="check-item" name="mutasi[]" value="'.$mutasi4['id_mutasi2'].'"/>
                                                        <label for="'.$mutasi4['id_mutasi2'].'"></label></td>
                                                </tr>        
                                        ';$number=$number+1;    
                                  }
                                  
                                  
                                  echo'
                                  
                                                </tbody>
                                            </table>
                                        </div>';



                                ?>
                                
                                
                                
                                </form>

                                
<!--                                 <table border="1px">
                                    <?php 
                                        $number=2;
                                     $query2="SELECT id_mutasi2, 
                                                 t.kohir as kohir,  
                                                 tt.tgl_regis as tanggal_regis, 
                                                 tt.luas as luas, 
                                                 s.nama_satuan as nama_satuan, 
                                                 t.nama_lengkap as dulu,
                                                 tt.nama_lengkap as dulu2,
                                                 tt.nama_lengkap as skrg,
                                                 m.skrg as skrg2,
                                                 tt.id_jb as id_jb,
                                                 t.nomor as nomor
                                 FROM mutasi2 m join tanah t on m.dulu=t.id_tanah 
                                                join tanah tt on m.skrg=tt.id_tanah
                                                join satuan s on t.id_satuan=s.id_satuan

                                 WHERE dulu=$row[id_tanah] order by tanggal_regis"; 
                                        $r2=mysqli_query($conn, $query2);
                                        $jum2=mysqli_num_rows($r2);
                                        echo '                                                   
                                                    <tr>
                                                        <td style="padding-right:10px"><b>1.</b></td>
                                                        <td>Tanggal '.$row['tgl_regis'].' atas nama <a href="detail_transaksi.php?id='.$row['id_tanah'].'">'.$row['nama_lengkap'].'</a> Kohir/C '.$row['kohir'].' Persil '.$row['persil'].' Kelas '.$row['nama_kelas'].' luas &plusmn; '.round($row['luas'],3).' '.$row['nama_satuan'].'</td>
                                                    </tr>';
                                        while($baris2 = mysqli_fetch_array($r2)) {
                                                echo '                                                   
                                                    <tr>
                                                        <td style="padding-right:10px"><b>'.$number.'.</b></td>
                                                        <td>Pada tanggal '.$baris2['tanggal_regis'].', oleh <a href="detail_transaksi.php?id='.$row['id_tanah'].'">'.$baris2['dulu'].'</a> di jual kepada <a href="detail_transaksi.php?id='.$baris2['skrg2'].'">'.$baris2['skrg'].'</a> ';
                                        				if ($baris2['id_jb']==3) {
						                                		echo '  berdasarkan Akta Jual Beli Nomor '.$baris2['nomor'].' ';
						                                };                
                                                        echo ' terbit Kohir/C '.$baris2['kohir'].' Persil '.$row['persil'].' Kelas '.$row['nama_kelas'].' luas &plusmn; '.round($baris2['luas'],3).' '.$row['nama_satuan'].'<br></td>
                                                    </tr>';$number=$number+1;
                                        }   
                                    ?>
                                </table><br> -->

                                <!-- <table>
                                    <?php 
                                        $number=2;
                                     $query2="SELECT * 
                                     FROM mutasi 
                                     WHERE id_tanah=$row[id_tanah] order by tanggal_regis"; 
                                        $r2=mysqli_query($conn, $query2);
                                        $jum2=mysqli_num_rows($r2);
                                        echo '                                                   
                                                    <tr>
                                                        <td style="padding-right:10px"><b>1 .</b></td>
                                                        <td>Tanggal '.$row['tgl_regis'].' atas nama '.$row['nama_lengkap'].' Kohir/C '.$row['kohir'].' Persil '.$row['persil'].' Kelas '.$row['nama_kelas'].' luas &plusmn; '.$row['luas'].' '.$row['nama_satuan'].'</td>
                                                    </tr>';
                                        while($baris2 = mysqli_fetch_array($r2)) {
                                                echo '                                                   
                                                    <tr>
                                                        <td style="padding-right:10px"><b>'.$number.'.</b><br></td>
                                                        <td>Pada tanggal '.$baris2['tanggal_regis'].', atas nama '.$baris2['nama_lengkap'].' ';
                                        				if ($baris2['id_jb']==3) {
						                                		echo '  berdasarkan Akta Jual Beli Nomor '.$baris2['nomor'].' ';
						                                };                
                                                        echo ' terbit Kohir/C '.$baris2['kohir'].' Persil '.$row['persil'].' Kelas '.$row['nama_kelas'].' luas &plusmn; '.$baris2['luas'].' '.$row['nama_satuan'].'<br></td>
                                                    </tr>';$number=$number+1;
                                        }      
                                    ?>
                                </table><br> -->
                        </div>
                    </div>
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

  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete

/*            var confirm = window.confirm("Apakah Anda yakin ingin mencetak data-data ini?"); // Buat sebuah alert konfirmasi*/
            
      
      /*if(confirm)*/ // Jika user mengklik tombol "Ok"
        $("#form-delete").submit(); // Submit form
    });



  });

  </script>

<script>
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += "<td contenteditable='true' class='item_name'><input type='number'></td>";
   html_code += "<td contenteditable='true' class='item_code'><input type='number'> </td>";
   html_code += "<td contenteditable='true' class='item_desc'></td>";
   html_code += "<td contenteditable='true' class='item_price' ></td>";
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
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