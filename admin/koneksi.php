<?php
session_start();//menjalankan sessions

function Koneksi()//koneksi ke database
{
  $nameServer = "localhost";
  $username = "root";
  $password = "";
  $dbName = "gudang_db";

  $conn = mysqli_connect($nameServer, $username, $password, $dbName);

  return $conn; 
}

function query($query)
{
  $koneksi = Koneksi();
  $result=mysqli_query($koneksi,$query) OR die (mysqli_error($koneksi));
  $rows=[];

  foreach($result as $row){
    $rows[]=$row;
  }
  return $rows;
}

function tambahAdmin($data)
{
  $koneksi = Koneksi();

  $username=$data["username"];
  $password=$data["password"];
  
  $query="INSERT INTO admin VALUES ('','$username', '$password')";
  mysqli_query($koneksi,$query);//jalankan query
  return $query;

}

function updateAdmin($data)
{
  $koneksi = Koneksi();
  $id=mysqli_real_escape_string($koneksi, $_POST["id"]);
  $nama=mysqli_real_escape_string($koneksi, $data["username"]);
  $pwd=mysqli_real_escape_string($koneksi, $data["password"]);
 
  $query="UPDATE admin SET username='$nama',password='$pwd'WHERE id_admin=$id ";
// var_dump($query);die;
  
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
}

function hapusAdmin($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);
 
  $query = "DELETE FROM admin WHERE id_admin=$id ";
  // var_dump($query);die;
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
  
}

//FUNGSI TAMBAH STOK BARANG
function tambahstok($data)
{
  $koneksi = Koneksi();

  $namaBarang=$data["nama_barang"];
  $desc=$data["desc"];
  
  $query="INSERT INTO stok_barang VALUES ('','$namaBarang','', '$desc')";
  mysqli_query($koneksi,$query);//jalankan query
  return $query;

}

//HAPUS STOK BARANG
function hapus($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);
 
  $query = "DELETE FROM stok_barang WHERE idbarang=$id ";
  // var_dump($query);die;
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
  
}

//UPDATE STOK BARANG
function update($data)
{
  $koneksi = Koneksi();
  $id=mysqli_real_escape_string($koneksi, $_POST["idbarang"]);
  $nama=mysqli_real_escape_string($koneksi, $data["nama_barang"]);
  $stok=mysqli_real_escape_string($koneksi, $data["stok"]);
  $desc=mysqli_real_escape_string($koneksi, $data["desc"]);
 
  
  $query="UPDATE stok_barang SET nama_barang='$nama',stok='$stok', deskripsi='$desc' 
                            WHERE idbarang=$id ";
// var_dump($query);die;
  
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
}

//TAMBAH BARANG MASUK

function barangMasuk($data)
{
  $koneksi = Koneksi();

  $barang = mysqli_real_escape_string($koneksi, $data["nama_barang"]);
  $jlh = mysqli_real_escape_string($koneksi, $data["jlh"]);
  $penerima = mysqli_real_escape_string($koneksi, $data["penerima"]);

  //cek stock yang sekarang
   $cekstokskrg = mysqli_query($koneksi,"SELECT * FROM stok_barang WHERE idbarang='$barang'");
   $ambildata= mysqli_fetch_array($cekstokskrg);

   //ambil datanya stock dri variabel ambildata lalu simpan ke var stockskrg 
   $stockskrg = $ambildata["stok"];
   //tambahkan stok skrg dgn qty
   $tambahstock= $stockskrg + $jlh;
   //  query tambah barang masuk
   mysqli_query($koneksi,"INSERT INTO stok_masuk (id,idbarang, jumlah, id_petugas) VALUES ('','$barang','$jlh','$penerima')");
   // ubah data ditabel stock dgn data yg baru ditambah
   mysqli_query($koneksi,"UPDATE stok_barang SET stok ='$tambahstock' WHERE idbarang= '$barang' ");
   
   return mysqli_affected_rows($koneksi);
}

//UPDATE BARANG MASUK

function updateMasuk($data)
{
  $koneksi = Koneksi();
   $idb= mysqli_real_escape_string($koneksi, $_POST["idbarang"]);
   $idm= mysqli_real_escape_string($koneksi, $_POST["idm"]);
   $jlh= mysqli_real_escape_string($koneksi, $data["jlh"]);
   $penerima= mysqli_real_escape_string($koneksi, $data["penerima"]);

   $lihatstock = mysqli_query($koneksi,"SELECT * FROM stok_barang WHERE idbarang='$idb'");
   $stocknya=mysqli_fetch_assoc($lihatstock);
   $stokskrg= $stocknya["stok"];

   $qtyskrg= mysqli_query($koneksi,"SELECT * FROM stok_masuk WHERE id='$idm'");
   $qtynya= mysqli_fetch_assoc($qtyskrg);
   $qtyskrg= $qtynya["jumlah"];

   if($jlh > $qtyskrg){
      $selisih= $jlh - $qtyskrg;
      $tambahin = $stokskrg + $selisih;

      //update stok di tabel stok barang
      mysqli_query($koneksi,"UPDATE stok_barang SET stok='$tambahin' WHERE idbarang='$idb'");
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE stok_masuk SET jumlah='$jlh', id_petugas='$penerima' WHERE id='$idm'");
 
   }else{
      $selisih= $qtyskrg - $jlh;
      $kurangin = $stokskrg - $selisih;
      //update stok di tabel stok barang
      mysqli_query($koneksi,"UPDATE stok_barang SET stok='$kurangin' WHERE idbarang='$idb'");
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE stok_masuk SET jumlah='$jlh', id_petugas='$penerima'WHERE id='$idm'");

   }
   return mysqli_affected_rows($koneksi);
}
//HAPUS BARANG MASUK
function hapusMasuk($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);
  
  mysqli_query($koneksi,"DELETE FROM stok_masuk WHERE id=$id ");
 
  return mysqli_affected_rows($koneksi);
  
}

//Fungsi Tambah Barang Keluar

function barangKeluar($data)
{
  $koneksi = Koneksi();

  $barang = mysqli_real_escape_string($koneksi, $data["nama_barang"]);
  $jlh = mysqli_real_escape_string($koneksi, $data["jlh"]);
  $ket = mysqli_real_escape_string($koneksi, $data["ket"]);

  //cek stock yang sekarang
   $cekstokskrg = mysqli_query($koneksi,"SELECT * FROM stok_barang WHERE idbarang='$barang'");
   $ambildata= mysqli_fetch_array($cekstokskrg);

   //ambil datanya stock dri variabel ambildata lalu simpan ke var stockskrg 
   $stockskrg = $ambildata["stok"];
   //tambahkan stok skrg dgn qty
   $tambahstock= $stockskrg - $jlh;
   //  query tambah barang masuk
   mysqli_query($koneksi,"INSERT INTO stok_keluar (idkeluar,idbarang, jumlah, keterangan) VALUES ('','$barang','$jlh','$ket')");
   // ubah data ditabel stock dgn data yg baru ditambah
   mysqli_query($koneksi,"UPDATE stok_barang SET stok ='$tambahstock' WHERE idbarang= '$barang' ");
   
   return mysqli_affected_rows($koneksi);
}

//Fungsi upadte barang keluar
function updateKeluar($data)
{
  $koneksi = Koneksi();
   $idb= mysqli_real_escape_string($koneksi, $_POST["idbarang"]);
   $idk= mysqli_real_escape_string($koneksi, $_POST["idk"]);
   $jlh= mysqli_real_escape_string($koneksi, $data["jlh"]);
   $ket= mysqli_real_escape_string($koneksi, $data["ket"]);

   $lihatstock = mysqli_query($koneksi,"SELECT * FROM stok_barang WHERE idbarang='$idb'");
   $stocknya=mysqli_fetch_assoc($lihatstock);
   $stokskrg= $stocknya["stok"];

   $qtyskrg= mysqli_query($koneksi,"SELECT * FROM stok_keluar WHERE idkeluar='$idk'");
   $qtynya= mysqli_fetch_assoc($qtyskrg);
   $qtyskrg= $qtynya["jumlah"];

   if($jlh > $qtyskrg){
      $selisih= $jlh - $qtyskrg;
      $tambahin = $stokskrg - $selisih;
      //update stok di tabel stok barang
      mysqli_query($koneksi,"UPDATE stok_barang SET stok='$tambahin' WHERE idbarang='$idb'");
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE stok_keluar SET jumlah='$jlh', keterangan='$ket' WHERE idkeluar='$idk'");
   }else{
      $selisih= $qtyskrg - $jlh;
      $kurangin = $stokskrg + $selisih;
      //update stok di tabel stok barang
      mysqli_query($koneksi,"UPDATE stok_barang SET stok='$kurangin' WHERE idbarang='$idb'");
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE stok_keluar SET jumlah='$jlh', keterangan='$ket' WHERE idkeluar='$idk'");

   }
   return mysqli_affected_rows($koneksi);
}

function hapusKeluar($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);

  mysqli_query($koneksi,"DELETE FROM stok_keluar WHERE idkeluar=$id ");
 
  return mysqli_affected_rows($koneksi);
  
}