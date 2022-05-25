<?php
include_once "../koneksi.php";

$id = htmlspecialchars($_GET["id"]);

  if(hapus($_POST) > 0){
    echo "
            <script>
               alert('data berhasil dihapus!');
               document.location.href = 'stock_pupuk.php';
            </script>";
  }else{
    echo "
            <script>
               alert('data gagal dihapus!');
               document.location.href = 'stock_pupuk.php';
            </script>";
  }

?>