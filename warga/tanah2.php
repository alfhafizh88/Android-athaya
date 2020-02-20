<?php
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

    $query="INSERT into buku values ('','".$_POST['nama']."', '".$_POST['mulai']."', '".$_POST['selesai']."','','".$_POST['ket']."', 'Aktif')";
    $hasil=mysqli_query($conn,$query);
    
    /*$query2="UPDATE tbl_buku set jumlah_buku=jumlah_buku-".$_POST['qty']." where id='".$_POST['bbm2']."'";
    echo $query2."<br/>";
    $hasil2=mysqli_query($conn,$query2);*/
    
    if($hasil /*&& $hasil2*/) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
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
    <title>Aplikasi Administrasi Pengolahan Tanah</title>
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

    

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of POST all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery-ui.js"></script>
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
                                
                                <i class="material-icons">library_books</i>  Administrasi Tanah
                             &nbsp;&nbsp;<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  --><a style="align-content: right;" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" class="btn btn-primary waves-effect m-b-15">
                                <i class="material-icons">note_add</i>
                                <span>Tambah Data</span>
                            </a>
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
                            
                            

                            <div class="collapse" id="collapseExample2">
                                <div class="well">
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
                            <form id="form_validation" method="POST">
                                
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

                                
                                    <label class="form-label"><p style="color: black; font-size: 12px; font-style: arial;">Buku Fisik</p></label><br>
                                    <select name="buku" id="buku" class="form-control" data-live-search="true">
                                        <option value="">Pilih</option>
                                        
                                        <?php
                                        // Load file koneksi.php
                                        include "conn.php";
                                        
                                        // Buat query untuk menampilkan semua data siswa
                                        $sql = mysqli_query($conn, "SELECT * FROM buku order by nama_buku");
                                
                                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                            echo "<option value='".$data['id_buku']."'>".$data['nama_buku']."<p style='color: red; font-size:12px;'> (No. </p>   ".$data['mulai']." - No. ".$data['selesai'].")</p></option>";
                                        }
                                        ?>
                                    </select>
                                

                                <br>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label" style="color: black">No Kohir</label><br><br>
                                        <div id="kohir">
                                            
                                        </div>
                                        <!-- <input type="number" class="form-control" name="kohir" id="kohir" required> -->
                                        
                                        <div id="loading2" style="margin-top: 15px;">
                                            <img src="images/loading.gif" width="18"> <small>Loading...</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" required>
                                        <label class="form-label" style="color: black">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="alamat" required>
                                        <label class="form-label" style="color: black">Alamat Lengkap</label>
                                    </div>
                                </div>

                                    


                                    <label class="form-label">Jenis Transkasi</label><br>
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
                                        <input type="text" name="no_ktp" id="no_ktp" class="form-control" required hidden />
                                        <label class="form-label" style="color: black;">Nama Notaris</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="nomor" id="no_ktp2" class="form-control" required hidden />
                                        <label class="form-label" style="color: black;">Nomor</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;">Tanggal</label>
                                    <div class="form-line">
                                        <input type="date" name="tanggal" id="no_ktp3" class="form-control" required hidden />
                                        
                                    </div>
                                </div>
                                




                                <div class="form-group">
                                    <label class="form-label" style="color: black;">Jenis Tanah</label><br>
                                    <input type="radio" name="gender" id="sawah" class="with-gap">
                                    <label for="sawah">Sawah</label>

                                    <input type="radio" name="gender" id="darat" class="with-gap">
                                    <label for="darat" class="m-l-20">Darat</label>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="persil" required>
                                        <label class="form-label" style="color: black;">No. Persil</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="kelas" required>
                                        <label class="form-label" style="color: black;">Kelas Desa</label>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="width: 50%;">
                                    <div class="form-line" style="width: 50%;">
                                        <input type="number" class="form-control" name="luas" style="width: 50%" required>
                                        <label class="form-label" style="color: black;">Luas Tanah (ex. 0,035)</label>
                                    </div>
                                </div><br>
                                <div class="form-group form-float" style="width: 50%;">
                                    <div class="form-line" style="width: 50%;">
                                        <label class="form-label" style="color: black;">Satuan Luas Tanah</label><br>
                                        <select class="form-control" data-live-search="true" style="width: 50%">
                                                    <option>m2</option>
                                                    <option>ha.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;">Tanggal Resgistrasi</label>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black;">Berkas Pendukung</label>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="foto" required>
                                    </div>
                                    
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="keterangan" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                        <label class="form-label" style="color: black;">Keterangan</label>
                                    </div>
                                </div>
                                <input type="submit" name="Submit" value="Input" class="btn btn-primary waves-effect">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            
                                </div>
                            </div>
                            <br>


                            
                                                                        <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
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
                                            <td>100</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td><a href="a">Oesman</a></td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td><a href="as">[100]Taufik</a></td>
                                            <td>$320,800</td>
                                            <td><button type="button" class="btn bg-green waves-effect" style="width: 100%;" data-toggle="modal" data-target="#defaultModal">Detail</button><a href="" class="btn bg-red waves-effect" style="width: 100%;">Transaksi</a></td>
                                        </tr>
                                        <tr>
                                            <td>100</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td><a href="a">Oesman</a></td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td><a href="as">[100]Joko</a></td>
                                            <td>$320,800</td>
                                             <td><button type="button" class="btn bg-green waves-effect" style="width: 100%;" data-toggle="modal" data-target="#defaultModal">Detail</button><a href="" class="btn bg-red waves-effect" style="width: 100%;">Transaksi</a></td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </section>


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
    











