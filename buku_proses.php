 <?php
 include("conn.php");
        if(isset($_POST['submit'])){
            $sql="UPDATE buku set nama_buku='".$_POST['nama']."', mulai='".$_POST['mulai']."', 
            selesai='".$_POST['selesai']."', ket='".$_POST['ket']."', status=  '".$_POST['level']."'
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
        }
?>
<meta http-equiv="refresh"content="0;URL=d_buku.php"/>