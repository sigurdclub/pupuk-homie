<?php
include_once "../koneksi.php";

$id = htmlspecialchars($_GET["id"]);

  if(hapusKeluar($_POST) > 0){
    echo "
            <script>
               alert('data berhasil dihapus!');
               document.location.href = 'barang_keluar.php';
            </script>";
  }else{
    echo "
            <script>
               alert('data gagal dihapus!');
               document.location.href = 'barang_keluar.php';
            </script>";
  }

?>