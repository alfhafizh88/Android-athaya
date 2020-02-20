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
    $sql="UPDATE buku set nama_buku='".$_POST['nama']."', mulai='".$_POST['mulai']."', 
            selesai='".$_POST['selesai']."', ket='".$_POST['ket']."', status='".$_POST['level']."', kurang='".$_POST['kurang']."'
            WHERE id_buku='".$_POST['id_buku']."'";
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
}{

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
            
            <div class="block-header">
    <h2>
        <ol class="breadcrumb breadcrumb-col-pink">
                    <li><a href="javascript:void(0);">Home</a></li>
                    <li class="active">Data Buku</li>
        </ol>
    </h2>
</div>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="font-style: 90px">
                    <i class="material-icons">collections_bookmark</i>  Data Buku
                 &nbsp;&nbsp;<a style="align-content: right;" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" class="btn btn-primary waves-effect m-b-15">
                    <i class="material-icons">note_add</i>
                    <span>Tambah Data</span></a>
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
                <h2>FORM DATA BUKU</h2>

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
                <form id="form_validation" action="d_buku.php" method="POST">

                    <input type="hidden" name="kode" id="kode" /> 
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama" id="nama" required>
                            <label class="form-label">Nama Buku</label>
                        </div>
                    </div>    
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="mulai" id="mulai" required>
                            <label class="form-label">Mulai</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="selesai" id="selesai" required>
                            <label class="form-label">Selesai</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="ket" id="ket" cols="30" rows="5" class="form-control no-resize" required></textarea>
                            <label class="form-label">Keterangan</label>
                        </div>
                    </div>
                    <input type="hidden" name="mode" id="mode" value="insert" />
                    <input type="hidden" name="kd" id="kd" /><br>
                    <input type="submit" name='simpan' value='Simpan' class="btn btn-primary waves-effect">
                    <input type="submit" name="ubah" value="Ubah Data" onclick="ubah_bbm()" />
                </form>
            </div>
        </div>
    </div>
</div>

                    </div>
                </div>
                <br>


<div id="area_tanah">
                <div class="table-responsive">

                    
                        <?php
                            $query="SELECT  id_buku,nama_buku, mulai, selesai, kurang, ket, status
                                    FROM buku  ORDER BY nama_buku";
                                    $hasil = mysqli_query($conn, $query);   
                                    //print_r($hasil);

                        echo '
                        <form action="d_buku.php" method="POST"></form>
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                
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
                                
                                <td>';?>

                                <?php
                                    echo $baris['nama_buku'];
                                    if ($baris['status']=='Aktif') {
                                    echo '
                                        <span class="label bg-green">Aktif</span>
                                    ';
                                    } elseif($baris['status']=='Tidak Aktif'){
                                        echo '
                                            <span class="label bg-red">Tidak Aktif</span>
                                        ';
                                    }?>

                                    <?php 
                                    echo '<input type="hidden" name="id" value='.$baris[0].'></td>
                                <td>'.$baris['mulai'].'</td>
                                <td>'.$baris['selesai'].'</td>
                                <td>'.$baris['kurang'].'</td>
                                <td>'.$baris['ket'].'</td>
                                <td><!--<a href="edit_buku.php?id='.$baris[0].'" class="btn bg-green btn-block btn-xs waves-effect">Edit</a>--!>
                                    <button type="button" data-toggle="modal" data-target="#'.$baris['id_buku'].'" class="btn btn-primary waves-effect" name="simpan2" data-toggle="tooltip" data-placement="right" title="Edit"><i class="material-icons">edit</i>
                                    </button>


            <div class="modal fade" id="'.$baris['id_buku'].'" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Edit Buku Tanah</h4>
                        </div>
                        <div class="modal-body">
                <form id="form_validation" action="d_buku.php" method="POST">
                    <input type="hidden" name="kode" id="kode" /> 
                    <div class="form-group form-float">
                        <input type="hidden" class="form-control" name="id_buku" id="id_buku" value="'.$baris['id_buku'].'" required>
                        <br>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama" id="nama" value="'.$baris['nama_buku'].'" required>
                            <label class="form-label">Nama Buku</label>
                        </div>
                    </div>    
                    <br><br>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="mulai" id="mulai" value="'.$baris['mulai'].'" required>
                            <label class="form-label">Mulai</label>
                        </div>
                    </div><br><br>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="selesai" id="selesai" value="'.$baris['selesai'].'" required>
                            <label class="form-label">Selesai</label>
                        </div>
                    </div><br><br>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="kurang" id="kurang" value="'.$baris['kurang'].'" required>
                            <label class="form-label">Kurang</label>
                        </div>
                    </div>
<br>
                    <label class="form-label"><p style="font-size: 12px; font-style: arial;">Status</p>
                    </label>
                    <select name="level"  class="form-control" data-live-search="true" required>
                        <option value="">--Pilih Status--</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select><br><br>
                   

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="ket" id="ket" value="'.$baris['ket'].'" required>
                            <label class="form-label">Keterangan</label>
                        </div>
                    </div>  
                                                        
                </div>

                            <div class="modal-footer">
                            <button type="submit" class="btn btn-danger waves-effect" name="simpan2" data-toggle="tooltip" data-placement="right" title="Kembali" data-dismiss="modal">
                                    <i class="material-icons">keyboard_backspace</i>
                                </button>

                                <button type="submit" class="btn btn-success waves-effect" value="Simpan" name="ubah" data-toggle="tooltip" data-placement="right" title="Simpan"><i class="material-icons">save</i>
                                </button>
                                        
                            </form>  
                        </div>
                    </div>
                </div>
            </div>

                                </td>
                            </tr> 
                            </tbody>
                            ';
                        }
                        ?>
                    </table>
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
    











