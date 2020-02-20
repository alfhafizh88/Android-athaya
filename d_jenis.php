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

    $query="INSERT into jenis_transaksi values ('', '".$_POST['nama']."', 'Aktif', '".$_POST['ket']."')";
    $hasil=mysqli_query($conn,$query);
    
    /*$query2="UPDATE tbl_buku set jumlah_buku=jumlah_buku-".$_POST['qty']." where id='".$_POST['bbm2']."'";
    echo $query2."<br/>";
    $hasil2=mysqli_query($conn,$query2);*/
    
    if($hasil /*&& $hasil2*/) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
                window.location.href = "d_jenis.php";
             </script>';
    }
}else if (isset($_POST['simpan2'])) {
     $query="INSERT into jenis_jualbeli values ('', '".$_POST['jenis']."', '".$_POST['nama']."')";
    $hasil=mysqli_query($conn,$query);
    
    /*$query2="UPDATE tbl_buku set jumlah_buku=jumlah_buku-".$_POST['qty']." where id='".$_POST['bbm2']."'";
    echo $query2."<br/>";
    $hasil2=mysqli_query($conn,$query2);*/
    
    if($hasil /*&& $hasil2*/) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
                window.location.href = "d_jenis.php";
             </script>';
    }
}else if (isset($_POST['ubah'])) {
      $sql="UPDATE jenis_transaksi set nama_jenis='".$_POST['nama']."', ket_jenis='".$_POST['ket']."', 
      status='".$_POST['status']."'
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
                                <li class="active">Data Jenis</li>
                    </ol>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-style: 90px">
                                
                                <i class="material-icons">loyalty</i> <b>Data Jenis Transaksi</b>&nbsp;&nbsp;<a style="align-content: right;" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" class="btn btn-primary waves-effect m-b-15">
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
                            <h2>FORM DATA JENIS</h2>
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
                            <form id="form_validation" method="POST" action="d_jenis.php">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" required>
                                        <label class="form-label" style="color: black; font-weight: bold;">Nama Jenis</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black; font-weight: bold;">Keterangan</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ket" value="-">
                                    </div>
                                </div>
                                <input type="submit" name="simpan" value="Input" class="btn btn-primary waves-effect">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
                                </div>
                            </div>
                            <br>
                            

                            
	<?php
	$query="SELECT * FROM jenis_transaksi ";
	        $hasil = mysqli_query($conn, $query);   
	?>
	<div class="table-responsive">
	    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
	      <thead>
	            <tr>
	                <th>Jenis Transaksi</th>
                    <th>Status</th>
                    <th>Ket</th>
	                <th>Aksi</th>
	            </tr>
	      </thead>
	        <tbody>
	        	<?php
	        	$jum=mysqli_num_rows($hasil);
                while($baris = mysqli_fetch_array($hasil)) {
		        	echo'
		        		<tr>
			                <td>'.$baris['nama_jenis'].'</td><td>';
                            if ($baris['status']=='Aktif') {
                                    echo '
                                        <span class="label bg-green">Aktif</span>
                                    ';
                                    } elseif($baris['status']=='Tidak Aktif'){
                                        echo '
                                            <span class="label bg-red">Tidak Aktif</span>
                                        ';
                                    }

                            echo'</td>
                            <td>'.$baris['ket_jenis'].'</td>
			                <td><button type="button" data-toggle="modal" data-target="#'.$baris['id_transaksi'].'" class="btn btn-primary waves-effect" name="simpan2" data-toggle="tooltip" data-placement="right" title="Edit Akun"><i class="material-icons">edit</i>
                                </button>


                                <div class="modal fade" id="'.$baris['id_transaksi'].'" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Edit Kelas</h4>
                        </div>
                        <div class="modal-body">
                <form id="form_validation" action="d_jenis.php" method="POST">


                    
                    <div class="form-group form-float">
                        <input type="hidden" name="kode" id="kode" value="'.$baris['id_transaksi'].'" required>
                        <br>
                        <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama" id="nama_kelas" value="'.$baris['nama_jenis'].'" required>
                            <label class="form-label">Nama Kelas</label>
                        </div>
                    </div><br>
                    <label class="form-label"><p style="font-size: 12px; font-style: arial;">Status</p>
                    </label>
                    <select name="status" class="form-control" data-live-search="true" required>
                        <option value="">--Pilih Status--</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select><br><br>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="ket" id="ket" value="'.$baris['ket_jenis'].'" required>
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



		        	';
	        	}

	        	?>
	        </tbody>
	    </table>
	</div>





                        </div>
                    </div>
                </div>
            </div>



            <div class="block-header">
                
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-style: 90px">
                                
                                <i class="material-icons">loyalty</i> <b>Data Sub Jenis Transaksi</b>&nbsp;&nbsp;<a style="align-content: right;" role="button" data-toggle="collapse" href="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3" class="btn btn-primary waves-effect m-b-15">
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




                            <div class="collapse" id="collapseExample3">
                                <div class="well">
                                    <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>FORM DATA SUB JENIS TRANSAKSI</h2>
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
                            <form id="form_validation" method="POST" action="d_jenis.php">
                                
                                 <label class="form-label"><p style="color: black; font-size: 14px; font-style: arial;">Jenis Transaksi</p></label><br>
                                    <select name="jenis" class="form-control" data-live-search="true" required="true">
                                        <option value="">Pilih</option>
                                        
                                        <?php
                                        // Load file koneksi.php
                                        include "conn.php";
                                        
                                        // Buat query untuk menampilkan semua data siswa
                                        $sql = mysqli_query($conn, "SELECT * FROM jenis_transaksi order by id_transaksi");
                                
                                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                            echo "<option value='".$data['id_transaksi']."'>".$data['nama_jenis']."</option>";
                                        }
                                        ?>
                                    </select><br><br>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" required>
                                        <label class="form-label" style="color: black; font-weight: bold;">Nama Sub Jenis</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label" style="color: black; font-weight: bold;">Keterangan</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ket" value="-">
                                    </div>
                                </div>
                                <input type="submit" name="simpan2" value="Input" class="btn btn-primary waves-effect">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
                                </div>
                            </div>
                            <br>
                            

                            
    <?php
    $query="SELECT * FROM jenis_transaksi t join jenis_jualbeli j on t.id_transaksi=j.id_transaksi";
            $hasil = mysqli_query($conn, $query);   
    ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
          <thead>
                <tr>
                    <th>Jenis Transaksi</th>
                    <th>Sub Jenis Transaksi</th>
                    <th>Aksi</th>
                </tr>
          </thead>
            <tbody>
                <?php
                $jum=mysqli_num_rows($hasil);
                while($baris = mysqli_fetch_array($hasil)) {
                    echo'
                        <tr>
                            <td>'.$baris['nama_jenis'].'</td>
                            <td>'.$baris['jenis_jb'].'</td>
                            <td><a href="edit_jenis2.php?key='.$baris['id_jb'].'" class="btn btn-info waves-effect" data-toggle="tooltip" data-placement="right" title="Edit Jenis"> <i class="material-icons">edit</i></a>&nbsp;  

<a href="#" class="btn btn-danger waves-effect" data-toggle="tooltip" data-placement="right" title="Hapus jenis" 

onclick=\'javascript: if (confirm("Apakah Anda yakan ingin di hapus?")==true) {
        window.location.href="jenis_proses.php?aksi=hapus&key='.$baris['id_jb'].'";}\'> <i class="material-icons">delete_forever</i></a>

        </td>
                        </tr>   

                        
                    ';
                }

                ?>
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