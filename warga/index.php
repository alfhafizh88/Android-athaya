<?php

    include("conn.php");

    if(isset($_SESSION['namauser'])){
        echo "<script>window.alert('Anda harus logout!');
                window.location=('dashboard.php')</script>";
    }
    if (isset($_POST['submit'])) {
        session_start();
        $user=$_POST['user'];
        $pass=md5($_POST['pass']);
        $login=mysqli_query($conn, "SELECT * FROM akun WHERE username='$user' AND password='$pass'");

        $cocok=mysqli_num_rows($login);
        $r=mysqli_fetch_array($login);

        if ($cocok > 0){
            
            if ($r['level']=='Warga') {
                session_start();
                $_SESSION[namauser]     = $r[username];
                $_SESSION[nama_akun]    = $r[nama_akun];
                $_SESSION[email]        = $r[email];
                $_SESSION[alamat]       = $r[alamat];
                $_SESSION[telepon]      = $r[telepon];
                $_SESSION[leveluser]    = $r[level];
                $_SESSION[passuser]     = $r[password];
                header('location:dashboard.php');
            }else{
                echo "<script>window.alert('Halaman ini khusus Warga.');
                window.location=('index.php')</script>";        
            }
            
        }
        else {
        echo "<script>window.alert('Username atau Password anda salah.');
                window.location=('index.php')</script>";
        }
    } else {
        # code...
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistem Pengelolaan Tanah</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="../javascript:void(0);"><img src="../images/pemkot2.png" style="width: 13%; height: 10%;"/>&nbsp;&nbsp;Kelurahan<b> Medokan</b></a>
            <small>Sistem Pengelolaan Tanah</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="">
                    <div class="msg">Masuk untuk memulai aplikasi</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="user" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="pass" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <input type="submit" name="submit" value="MASUK" class="btn btn-block bg-pink waves-effect">
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.php">Daftar</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <!-- <a href="../forgot-password.html">Forgot Password?</a> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/examples/sign-in.js"></script>
</body>

</html>