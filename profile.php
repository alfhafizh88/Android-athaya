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
if(isset($_POST['simpanKel'])) {
        $query="UPDATE kelurahan set nama_kel='".$_POST['nama']."', alamat='".$_POST['alamat']."', telp='".$_POST['nomor']."', email='".$_POST['email']."' WHERE kode_kel='".$_POST['kode']."'";

    /*"INSERT INTO kelurahan values ('".$_POST['kode']."', 
                                          '".$_POST['nama']."', 
                                          '".$_POST['alamat']."', 
                                          '".$_POST['nomor']."', 
                                          '".$_POST['email']."')";*/
    $hasil=mysqli_query($conn,$query);
    
    /*$query2="UPDATE tbl_buku set jumlah_buku=jumlah_buku-".$_POST['qty']." where id='".$_POST['bbm2']."'";
    echo $query2."<br/>";
    $hasil2=mysqli_query($conn,$query2);*/
    
    if($hasil) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
             </script>';
    }else{
        echo '<script type="text/javascript">
                alert("Data gagal di simpan!");
             </script>';
    }
}elseif(isset($_POST['simpanPass'])){
$e=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM akun WHERE username='$_SESSION[namauser]'"));

        $lama = md5($_POST['a']);
        if ($lama != $e['password']){
            echo "<script>window.alert('Maaf, Inputan Password Lama anda Salah.');
                    window.location=('profile.php')</script>";
        }elseif ($_POST['b'] != $_POST['c']){
            echo "<script>window.alert('Maaf, Password Baru dan Konf Password Tidak Sama.');
                    window.location=('profile.php')</script>";
        }else{
            $passwords = md5($_POST['b']);
            mysqli_query($conn, "UPDATE akun SET password='$passwords' where username = '$_SESSION[namauser]'");
            echo "<script>window.alert('Sukses, Ganti Password...');
                    window.location=('profile.php')</script>";
        }
}elseif(isset($_POST['simpanAkun'])){
     $query="UPDATE akun set nama_akun='".$_POST['nama']."', email='".$_POST['email']."', alamat='".$_POST['alamat']."', telepon='".$_POST['nomor']."' WHERE username='".$_POST['kode']."'";

    $hasil=mysqli_query($conn,$query);
        
    if($hasil) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
             </script>';
    }else{
        echo '<script type="text/javascript">
                alert("Data gagal di simpan!");
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
            
             <div class='block-header'>
                <h2>
                    <ol class='breadcrumb breadcrumb-col-pink'>
                                <li><a href='javascript:void(0);'>Home</a></li>
                                <li class='active'>Info Profile </li>
                    </ol>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class='row clearfix'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='card'>
                        <div class='header'>
                            <h2 style='font-style: 90px'>
                                
                                <i class='material-icons'>info_outline</i>  Info Profile
                            <ul class='header-dropdown m-r--5'>
                                <li class='dropdown'>
                                    <a href='javascript:void(0);' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                                        <i class='material-icons'>more_vert</i>
                                    </a>
                                    <ul class='dropdown-menu pull-right'>
                                        <li><a href='javascript:void(0);'>Action</a></li>
                                        <li><a href='javascript:void(0);'>Another action</a></li>
                                        <li><a href='javascript:void(0);'>Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class='body'>
                                    <div class='panel-group' id='accordion_4' role='tablist' aria-multiselectable='true'>
                                        <div class='panel panel-danger'>
                                            <div class='panel-heading' role='tab' id='headingOne_4'>
                                                <h4 class='panel-title'>
                                                    <a role='button' data-toggle='collapse' data-parent='#accordion_4' href='#collapseOne_4' aria-expanded='true' aria-controls='collapseOne_4'>
                                                        Data Kelurahan
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id='collapseOne_4' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne_4'>
                                                <div class='panel-body'>
                                                   <?php
                                                   include ('conn.php');
                            $query='SELECT  *
                                    FROM kelurahan';
                                    $hasil = mysqli_query($conn, $query);   
                                    while($baris = mysqli_fetch_array($hasil)) {
                                    //print_r($hasil);
                                    
                                        echo "
                                 <form id='form_validation' method='POST' action='profile.php'>
                                    <!-- <p>
                                        <b>Pilih Jenis</b>
                                    </p> -->
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='kode' value='".$baris['kode_kel']."' readonly='true'>
                                        <label class='form-label'>Kode Kelurahan <label style='color: red; font-size: 12px'>Ex. (436.9.10.4)</label></label>
                                    </div>
                                </div>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='nama' value='".$baris['nama_kel']."' required>
                                        <label class='form-label'>Nama Kelurahan</label>
                                    </div>
                                </div>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='alamat' value='".$baris['alamat']."' required>
                                        <label class='form-label'>Alamat Kelurahan</label>
                                    </div>
                                </div>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='nomor' value='".$baris['telp']."' required>
                                        <label class='form-label'>Nomor Telepon</label>
                                    </div>
                                </div>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='email' class='form-control' name='email' value='".$baris['email']."' required>
                                        <label class='form-label'>Email Kelurahan</label>
                                    </div>
                                </div>
                            
                                <input type='submit' name='simpanKel' value='Ubah' class='btn btn-primary waves-effect'>
                            </form> ";} ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='panel panel-danger'>
                                            <div class='panel-heading' role='tab' id='headingTwo_4'>
                                                <h4 class='panel-title'>
                                                    <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion_4' href='#collapseTwo_4' aria-expanded='false'
                                                       aria-controls='collapseTwo_4'>
                                                        Data Akun
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id='collapseTwo_4' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingTwo_4'>
                                                <div class='panel-body'>
                                                

                                                <?php
                                                   include ('conn.php');
                            $query="SELECT  *
                                    FROM akun where username='".$_SESSION['namauser']."'";

                                    $hasil = mysqli_query($conn, $query);   
                                    while($baris = mysqli_fetch_array($hasil)) {
                                    //print_r($hasil);
                                    
                                        echo "

                                 <form id='form_validation' method='POST' action='profile.php'>
                                    <!-- <p>
                                        <b>Pilih Jenis</b>
                                    </p> -->
                                    <input type='hidden' name='kode' value='".$_SESSION['namauser']."'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='nama' value='".$baris['nama_akun']."'>
                                        <label class='form-label'>Nama Akun</label>
                                    </div>
                                </div>

                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='email' value='".$baris['email']."' required>
                                        <label class='form-label'>Email</label>
                                    </div>
                                </div>

                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='alamat' value='".$baris['alamat']."' required>
                                        <label class='form-label'>Alamat</label>
                                    </div>
                                </div>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' class='form-control' name='nomor' value='".$baris['telepon']."' required>
                                        <label class='form-label'>Nomor Telepon</label>
                                    </div>
                                </div>                            
                                <input type='submit' name='simpanAkun' value='Ubah' class='btn btn-primary waves-effect'>
                            </form> ";} ?>


                                                </div>
                                            </div>
                                        </div>
    <div class='panel panel-danger'>
        <div class='panel-heading' role='tab' id='headingThree_4'>
            <h4 class='panel-title'>
                <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion_4' href='#collapseThree_4' aria-expanded='false'
                   aria-controls='collapseThree_4'>
                    Ubah Password
                </a>
            </h4>
        </div>
        <div id='collapseThree_4' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree_4'>
            <div class='panel-body'>
                <form id='form_validation' method='POST'>
                <div class='form-group form-float'>
                    <div class='form-line'>
                        <input type='password' class='form-control' name='a' required>
                        <label class='form-label'>Password Lama<label style='color: red; font-size: 12px'>(*)</label></label>
                    </div>
                </div>
                <div class='form-group form-float'>
                    <div class='form-line'>
                        <input type='password' class='form-control' name='b' required>
                        <label class='form-label'>Password Baru<label style='color: red; font-size: 12px'>(*)</label></label>
                    </div>
                </div>
                <div class='form-group form-float'>
                    <div class='form-line'>
                        <input type='password' class='form-control' name='c' required>
                        <label class='form-label'>Konfirmasi Password<label style='color: red; font-size: 12px'>(*)</label></label>
                    </div>
                </div>
                                                    <input type='submit' name='simpanPass' value='Ubah' class='btn btn-primary waves-effect'>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->





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