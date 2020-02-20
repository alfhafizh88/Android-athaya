<script type="text/javascript">
    var param="";
        function ajak(){
            $.ajax({
                url:"aksi_tanah.php",
                async:true, 
                type:'POST',
                data:param,
                success:function(hasil){
                    //alert(hasil);
                    $("#area_buku").html(hasil);

                }
            });
        }
        function hapus_bbm(kode){
            param="k="+kode+"&aksi=hapus";
            ajak();
            //alert(data);
        }
</script>
<?php
include("conn.php");
$kode=$_GET['kode'];
if(isset($_POST['simpan'])) {

    $query="INSERT into buku values ('','".$_POST['nama']."', '".$_POST['mulai']."', '".$_POST['selesai']."','','".$_POST['ket']."', '')";
    $hasil=mysqli_query($conn,$query);
    
    /*$query2="UPDATE tbl_buku set jumlah_buku=jumlah_buku-".$_POST['qty']." where id='".$_POST['bbm2']."'";
    echo $query2."<br/>";
    $hasil2=mysqli_query($conn,$query2);*/
    
    if($hasil /*&& $hasil2*/) {
        
        echo '<script type="text/javascript">
                alert("Data berhasil di simpan!");
                setTimeout("location.href=\"index.php\"", 0);
             </script>';
    }
}else if (isset($_POST['ubah'])) {
    $kueri="UPDATE buku set nama='".$_POST['nama']."', mulai='".$_POST['mulai']."', selesai='".$_POST['selesai']."', ket='".$_POST['ket']."' WHERE id_buku='$kode'";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->


    <!-- Jquery Validation Plugin Css -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
        var param="";
        function ajak(){
        $.ajax({
            url:"aksi_tanah.php",
            async:true, 
            type:'POST',
            data:param,
                success:function(hasil){
                    alert(hasil);
                    $("#area_tanah").html(hasil);

                }
            });
        }
        function hapus_bbm(kode){
            param="k="+kode+"&aksi=hapus";
            ajak();
            //alert(data);
        }
    </script>
</head>
<body>
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
                    <input type="text" name="kode" id="kode" /> 
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
                    <input type="submit" name="ubah" value="Ubah Data" class="btn btn-primary waves-effect">
                </form>
            </div>
        </div>
    </div>
</div>

                    
                <br>


<div id="area_tanah">
                
                <div class="konten">
                	
                </div>
</div>                

            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<script>
    $(document).ready(function(){
        $('.isi').click(function(){
            var menu = $(this).attr('id');
        if (menu=="edit") {
            $('.konten').load('edit.php');    
        }else if (menu=="tanah") {
            $('.konten').load('tanah.php');    
        }
    });
        /*$('.konten').load('edit.php');    */

    });

</script>



<!-- Jquery DataTable Plugin Js -->

<!-- Custom Js -->

<script src="js/pages/tables/jquery-datatable.js"></script>
<script src="js/admin.js"></script>
<script src="js/pages/index.js"></script>
<script src="js/pages/forms/advanced-form-elements.js"></script>

<!-- Demo Js -->
        
</body>

</html>



























