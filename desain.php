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
    $asal_foto = $_FILES ['logo']['tmp_name'];
    $ukuran = $_FILES['logo']['size'];
    $hasil_foto = $_FILES ['logo']['name'];
    $x = explode('.', $hasil_foto);
    $nama_baru=$hasil_foto;
    $ekstensi = strtolower(end($x));
    move_uploaded_file($asal_foto, "images/".$nama_baru);

    if(isset($_POST['cekpicture']) && $_POST['cekpicture']=='ganti'){
        $sql="UPDATE desain set nama_aplikasi='".$_POST['nama']."', logo='images/$nama_baru', tema='".$_POST['group4']."'
                WHERE id_desain='".$_POST['id_desain']."'";
                $rs=mysqli_query($conn,$sql);
                if($rs){
                    echo '<script>
                        alert("Data Berhasil Diupdate");
                        
                    </script>';
                }else{
                    echo $rs;
                    echo '<script>
                        alert("Data Gagal Diupdate");
                    </script>';
                }
    }else{
        $sql="UPDATE desain set nama_aplikasi='".$_POST['nama']."', tema='".$_POST['group4']."'
            WHERE id_desain='".$_POST['id_desain']."'";
            $rs=mysqli_query($conn,$sql);
            if($rs){
                echo '<script>
                    alert("Data Berhasil Diupdate");
                    
                </script>';
            }else{
                echo $rs;
                echo '<script>
                    alert("Data Gagal Diupdate");
                </script>';
            }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
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

        <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
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

    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery-ui.js"></script>
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
                    <li class="active">Pengaturan</li>
        </ol>
    </h2>
</div>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="font-style: 90px">
                    <i class="material-icons">collections_bookmark</i>&nbsp;Pengaturan
                 
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
                    $sql="SELECT * FROM desain";
                    $rs=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($rs);
                ?>
                <br>
                <form id="form_validation" action="desain.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id_desain" value="<?php echo $row['id_desain']; ?>" /> 
                    <input type="hidden" name="kode" id="kode" /> 
                    <div class="form-group form-float">
                        <label class="form-label">Nama Aplikasi</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_aplikasi']; ?>" required>
                            
                        </div>
                    </div>    

                    <div class="form-group form-float">
                        <label class="form-label" style="color: black;">Logo Aplikasi</label>
                        <div class="form-line">
                            <img src="<?php echo $row['logo']?>" id="picture" width='100px' height=100px /><br>
                                    <input type="checkbox" class="filled-in" id="ig_checkbox" name="cekpicture" value="ganti" onclick="javascript: if(this.checked==true){$('#picture').hide(100);}else{$('#picture').show(100);}">
                                    <label for="ig_checkbox">&nbsp; Centang untuk ganti bukti dokumen</label>
                            <input type="file" name="logo" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <label class="form-label">Tema Aplikasi</label><br>
                    <div class="demo-radio-button">
                                <input name="group4" type="radio" id="radio_7" class="radio-col-red" value="theme-red" />
                                <label for="radio_7">RED</label>

                                <input name="group4" type="radio" id="radio_8" class="radio-col-pink" value="theme-pink"/>
                                <label for="radio_8">PINK</label>

                                <input name="group4" type="radio" id="radio_9" class="radio-col-purple" value="theme-purple"/>
                                <label for="radio_9">PURPLE</label>

                                <input name="group4" type="radio" id="radio_10" class="radio-col-deep-purple" value="theme-deep-purple"/>
                                <label for="radio_10">DEEP PURPLE</label>

                                <input name="group4" type="radio" id="radio_11" class="radio-col-indigo" checked value="theme-indigo"/>
                                <label for="radio_11">INDIGO</label>

                                <input name="group4" type="radio" id="radio_12" class="radio-col-blue" value="theme-blue"/>
                                <label for="radio_12">BLUE</label>

                                <input name="group4" type="radio" id="radio_13" class="radio-col-light-blue" value="theme-light-blue"/>
                                <label for="radio_13">LIGHT BLUE</label>

                                <input name="group4" type="radio" id="radio_14" class="radio-col-cyan" value="theme-cyan"/>
                                <label for="radio_14">CYAN</label>

                                <input name="group4" type="radio" id="radio_15" class="radio-col-teal" value="theme-teal"/>
                                <label for="radio_15">TEAL</label>

                                <input name="group4" type="radio" id="radio_16" class="radio-col-green" value="theme-green"/>
                                <label for="radio_16">GREEN</label>

                                <input name="group4" type="radio" id="radio_17" class="radio-col-light-green" value="theme-light-green"/>
                                <label for="radio_17">LIGHT GREEN</label>

                                <input name="group4" type="radio" id="radio_18" class="radio-col-lime" value="theme-lime"/>
                                <label for="radio_18">LIME</label>

                                <input name="group4" type="radio" id="radio_19" class="radio-col-yellow" value="theme-yellow"/>
                                <label for="radio_19">YELLOW</label>

                                <input name="group4" type="radio" id="radio_20" class="radio-col-amber" value="theme-amber"/>
                                <label for="radio_20">AMBER</label>

                                <input name="group4" type="radio" id="radio_21" class="radio-col-orange" value="theme-orange"/>
                                <label for="radio_21">ORANGE</label>

                                <input name="group4" type="radio" id="radio_22" class="radio-col-deep-orange" value="theme-deep-orange"/>
                                <label for="radio_22">DEEP ORANGE</label>

                                <input name="group4" type="radio" id="radio_23" class="radio-col-brown" value="theme-brown"/>
                                <label for="radio_23">BROWN</label>

                                <input name="group4" type="radio" id="radio_24" class="radio-col-grey" value="theme-grey"/>
                                <label for="radio_24">GREY</label>

                                <input name="group4" type="radio" id="radio_25" class="radio-col-blue-grey" value="theme-blue-grey"/>
                                <label for="radio_25">BLUE GREY</label>

                                <input name="group4" type="radio" id="radio_26" class="radio-col-black" value="theme-black"/>
                                <label for="radio_26">BLACK</label>

                            </div>




                    
                    <input type="hidden" name="mode" id="mode" value="insert" />
                    <input type="hidden" name="kd" id="kd" /><br>
                    <input type="submit" name='simpan' value='Simpan' class="btn btn-primary waves-effect">
                    <!-- <input type="submit" name="ubah" value="Ubah Data" onclick="ubah_bbm()" /> -->
                </form>

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
    











