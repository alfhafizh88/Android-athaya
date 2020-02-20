<?php
session_start();
 include("conn.php");
        if(isset($_POST['submit'])){
            $sql="UPDATE jenis_transaksi set nama_jenis='".$_POST['nama']."', ket_jenis='".$_POST['ket']."' 
            WHERE id_transaksi='".$_POST['kode']."'";
            $rs=mysqli_query($conn,$sql);
            if($rs){
                echo '<script>
                    alert("Data Berhasil Diupdate");
                    window.location.href = "d_jenis.php";
                </script>';
            }else{
                /*echo $rs;*/
                echo '<script>
                    alert("Data Gagal Diupdate");
                    window.location.href = "d_jenis.php";
                </script>';
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
            var params="id_transaksi="+sub;
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
                    <li><a href="d_jenis.php">Data Jenis</a></li>
                    <li class="active">Edit Data Jenis</li>
        </ol>
    </h2>
</div>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="font-style: 90px">
                    <i class="material-icons">collections_bookmark</i>  Edit Data Jenis
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
            <div class="body">
                <?php
include("conn.php");
$id=$_GET['key'];
$sql="SELECT * FROM jenis_transaksi WHERE id_transaksi='".$id."'";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        $row=mysqli_fetch_assoc($rs);
    }else echo "ID jenis Salah";
?>
                <form id="form_validation" action="edit_jenis.php" method="POST">
                    <input type="hidden" name="kode" value="<?php echo $row['id_transaksi']?>">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_jenis']?>" required>
                            <label class="form-label" style="color: black; font-weight: bold;">Nama jenis</label>
                        </div>
                    </div>    

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="ket" value="<?php echo $row['ket_jenis']?>">
                            <label class="form-label" style="color: black; font-weight: bold;">Keterangan</label>
                        </div>
                    </div>    
                    <input type="submit" name="submit" value="Ubah" class="btn bg-blue waves-effect" />
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
    











