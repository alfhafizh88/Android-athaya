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
</head>
<body>

    
            <div class="block-header">
                <h2>
                    JQUERY DATATABLES
                    <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-style: 90px">
                                
                                <i class="material-icons">library_books</i>  Administrasi Tanah
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
                            <h2>FORM EDIT ADMINISTRASI TANAH</h2>
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
                                    <label class="form-label"><p style="color: #d1cbcb; font-size: 12px; font-style: arial;">Buku Fisik</p></label><br>
                                    <select class="form-control show-tick" data-live-search="true">
                                        <option value="Buku C 1">Buku C1</option>
                                    </select>
                                <br>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" required>
                                        <label class="form-label">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="alamat" required>
                                        <label class="form-label">Alamat Lengkap</label>
                                    </div>
                                </div>

                                    <label class="form-label"><p style="color: #d1cbcb; font-size: 12px; font-style: arial;">Jenis Transkasi</p></label><br>
                                    <select class="form-control show-tick" data-live-search="true">
                                        <option>--Pilih Jenis--</option>
                                        <option>Burger, Shake and a Smile</option>
                                        <option>Sugar, Spice and all things nice</option>
                                    </select>
                                <br>
                                <div class="form-group">
                                    <label class="form-label"><p style="color: #d1cbcb; font-size: 12px; font-style: arial;">Jenis Tanah</p></label><br>
                                    <input type="radio" name="gender" id="sawah" class="with-gap">
                                    <label for="sawah">Sawah</label>

                                    <input type="radio" name="gender" id="darat" class="with-gap">
                                    <label for="darat" class="m-l-20">Darat</label>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="petok" required>
                                        <label class="form-label">No Petok/Registrasi</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="persil" required>
                                        <label class="form-label">No. Persil</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="kelas" required>
                                        <label class="form-label">Kelas Desa</label>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="width: 50%;">
                                    <div class="form-line" style="width: 50%;">
                                        <input type="text" class="form-control" name="luas" style="width: 50%" required>
                                        <label class="form-label">Luas Tanah (ex. 0,035)</label>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="width: 50%;">
                                    <div class="form-line" style="width: 50%;">
                                        <label class="form-label">Satuan Luas Tanah</label>
                                        <select class="form-control" data-live-search="true" style="width: 50%">
                                                    <option>m2</option>
                                                    <option>ha.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Tanggal Resgistrasi</label>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Berkas Pendukung</label>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="foto" required>
                                    </div>
                                    
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="keterangan" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                        <label class="form-label">Keterangan</label>
                                    </div>
                                </div>
                                <input type="submit" name="Submit" value="Input" class="btn btn-primary waves-effect">
                            </form>
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
                                            <th>Salary</th>
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
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>Tiger As</td>
                                            <td>Architect</td>
                                            <td>Edin</td>
                                            <td>90</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td> As</td>
                                            <td>Tect</td>
                                            <td>Edin</td>
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
