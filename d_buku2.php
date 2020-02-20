<?php
session_start();
include("conn.php");
if(isset($_POST['simpan'])) {

    $query="INSERT into buku values ('','".$_POST['nama']."', '".$_POST['mulai']."', '".$_POST['selesai']."','','".$_POST['ket']."', 'Aktif')";
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
    $kueri="UPDATE buku set nama='".$_POST['nama']."', mulai='".$_POST['mulai']."', selesai='".$_POST['selesai']."', ket='".$_POST['ket']."' WHERE id_buku='".$_POST['kode']."'";
}{

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
        function ubahData(kd,nm,ml,sl,kt) {
            //alert(kd);
            document.getElementById('kode').value=kd;
            document.getElementById('kd').value=kd;
            document.getElementById('nama').value=nm;
            document.getElementById('mulai').value=ml;
            document.getElementById('selesai').value=sl;
            document.getElementById('ket').value=kt;
            document.getElementById('kode').disabled=true;
            document.getElementById('mode').value="update"; 
        }
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
                <form id="form_validation" >
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
                        <form action="index.php" method="POST"></form>
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
                                
                                <td>'.$baris['nama_buku'].$baris[0].'<input type="hidden" name="id" value='.$baris[0].'></td>
                                <td>'.$baris['mulai'].'</td>
                                <td>'.$baris['selesai'].'</td>
                                <td>'.$baris['kurang'].'</td>
                                <td>'.$baris['ket'].'</td>
                                <td><input type="button" value="'.$baris['status'].' Hapus" class="btn bg-red btn-block btn-xs waves-effect" onclick="hapus_buku('.$baris[0].')"/>

                                <input type="button" class="btn bg-green btn-block btn-xs waves-effect" value="Ubah" onclick="ubahData('.$baris[0].', \''.$baris['nama_buku'].'\', \''.$baris['mulai'].'\', \''.$baris['selesai'].'\', \''.$baris['ket'].'\')" /></td>
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
<!-- #END# Exportable Table -->


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

<script src="js/pages/tables/jquery-datatable.js"></script>
<script src="js/admin.js"></script>
<script src="js/pages/index.js"></script>
<script src="js/pages/forms/advanced-form-elements.js"></script>

<!-- Demo Js -->
        
</body>

</html>
