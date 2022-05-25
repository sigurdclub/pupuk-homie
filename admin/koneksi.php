<?php
session_start();//menjalankan sessions

function Koneksi()//koneksi ke database
{
  $nameServer = "localhost";
  $username = "root";
  $password = "";
  $dbName = "pupuk";

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
  
  $query="INSERT INTO admin_pupuk VALUES ('','$username', '$password')";
  mysqli_query($koneksi,$query);//jalankan query
  return $query;

}

function updateAdmin($data)
{
  $koneksi = Koneksi();
  $id=mysqli_real_escape_string($koneksi, $_POST["id"]);
  $nama=mysqli_real_escape_string($koneksi, $data["username"]);
  $pwd=mysqli_real_escape_string($koneksi, $data["password"]);
 
  $query="UPDATE admin_pupuk SET username='$nama',password='$pwd'WHERE id=$id ";
// var_dump($query);die;
  
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
}

function hapusAdmin($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);
 
  $query = "DELETE FROM admin_pupuk WHERE id=$id ";
  // var_dump($query);die;
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
  
}

//FUNGSI TAMBAH STOK PUPUK
function tambahstok($data)
{
  $koneksi = Koneksi();

  $pupuk=$data["merek_pupuk"];
  $jenis=$data["jenis_pupuk"];
  $stok=$data["stok"];
  $satuan=$data["satuan"];
  
  $query="INSERT INTO stok_pupuk VALUES ('','$pupuk','$jenis', '$stok','$satuan')";
  // var_dump($query);die();
  mysqli_query($koneksi,$query);//jalankan query
  return $query;

}

//HAPUS STOK BARANG
function hapus($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);
 
  $query = "DELETE FROM stok_pupuk WHERE id_pupuk=$id ";
  // var_dump($query);die;
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
  
}

//UPDATE STOK BARANG
function update($data)
{
  $koneksi = Koneksi();
  $id=$_POST["id_pupuk"];
  $pupuk=$data["merek_pupuk"];
  $jenis=$data["jenis_pupuk"];
  $stok=$data["stok"];
  $satuan=$data["satuan"];
  
  $query="UPDATE stok_pupuk SET merek='$pupuk',jenis_pupuk='$jenis',stok='$stok', satuan='$satuan' 
                            WHERE id_pupuk=$id ";
// var_dump($query);die;
  
  mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
}

//TAMBAH BARANG MASUK

function barangMasuk($data)
{
  $koneksi = Koneksi();

  $pupuk = mysqli_real_escape_string($koneksi, $data["merek_pupuk"]);
  $jenis = mysqli_real_escape_string($koneksi, $data["jenis"]);
  $jlh = mysqli_real_escape_string($koneksi, $data["jlh"]);
  $satuan = mysqli_real_escape_string($koneksi, $data["satuan"]);

  //cek stock yang sekarang
   $cekstokskrg = mysqli_query($koneksi,"SELECT * FROM stok_pupuk WHERE id_pupuk='$pupuk'");
   $ambildata= mysqli_fetch_array($cekstokskrg);

   //ambil datanya stock dri variabel ambildata lalu simpan ke var stockskrg 
   $stockskrg = $ambildata["stok"];
   //tambahkan stok skrg dgn qty
   $tambahstock= $stockskrg + $jlh;
   //  query tambah barang masuk
   mysqli_query($koneksi,"INSERT INTO pupuk_masuk (id, id_pupuk, jenis_pupuk, jumlah, satuan) VALUES ('','$pupuk','$jenis','$jlh','$satuan')");
   // ubah data ditabel stock dgn data yg baru ditambah
   mysqli_query($koneksi,"UPDATE stok_pupuk SET stok ='$tambahstock' WHERE id_pupuk= '$pupuk' ");
   
   return mysqli_affected_rows($koneksi);
}

//UPDATE BARANG MASUK

function updateMasuk($data)
{
  $koneksi = Koneksi();
   $idp= mysqli_real_escape_string($koneksi, $_POST["id_pupuk"]);
   $idm= mysqli_real_escape_string($koneksi, $_POST["id"]);
   $jenis= mysqli_real_escape_string($koneksi, $data["jenis"]);
   $jlh= mysqli_real_escape_string($koneksi, $data["jlh"]);
   $sat= mysqli_real_escape_string($koneksi, $data["satuan"]);

   $lihatstock = mysqli_query($koneksi,"SELECT * FROM stok_pupuk WHERE id_pupuk='$idp'");
   $stocknya=mysqli_fetch_assoc($lihatstock);
   $stokskrg= $stocknya["stok"];

   $qtyskrg= mysqli_query($koneksi,"SELECT * FROM pupuk_masuk WHERE id='$idm'");
   $qtynya= mysqli_fetch_assoc($qtyskrg);
   $qtyskrg= $qtynya["jumlah"];

   if($jlh > $qtyskrg){
      $selisih= $jlh - $qtyskrg;
      $tambahin = $stokskrg + $selisih;

      //update stok di tabel stok barang
      mysqli_query($koneksi,"UPDATE stok_pupuk SET stok='$tambahin' WHERE id_pupuk='$idp'");
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE pupuk_masuk SET jenis_pupuk='$jenis', jumlah='$jlh', satuan='$sat' WHERE id='$idm'");
 
   }else{
      $selisih= $qtyskrg - $jlh;
      $kurangin = $stokskrg - $selisih;
      //update stok di tabel stok barang
      mysqli_query($koneksi,"UPDATE stok_pupuk SET stok='$kurangin' WHERE id_pupuk='$idp'");
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE pupuk_masuk SET jenis_pupuk='$jenis', jumlah='$jlh', satuan='$sat' WHERE id='$idm'");

   }
   return mysqli_affected_rows($koneksi);
}
//HAPUS BARANG MASUK
function hapusMasuk($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);
  
  mysqli_query($koneksi,"DELETE FROM pupuk_masuk WHERE id=$id ");
 
  return mysqli_affected_rows($koneksi);
  
}

//Fungsi Tambah Barang Keluar

function barangKeluar($data)
{
  $koneksi = Koneksi();

  $pupuk = mysqli_real_escape_string($koneksi, $data["merek_pupuk"]);
  $jenis = mysqli_real_escape_string($koneksi, $data["jenis"]);
  $jlh = mysqli_real_escape_string($koneksi, $data["jlh"]);
  $satuan = mysqli_real_escape_string($koneksi, $data["satuan"]);

  //cek stock yang sekarang
   $cekstokskrg = mysqli_query($koneksi,"SELECT * FROM stok_pupuk WHERE id_pupuk='$pupuk'");
   $ambildata= mysqli_fetch_array($cekstokskrg);

   //ambil datanya stock dri variabel ambildata lalu simpan ke var stockskrg 
   $stockskrg = $ambildata["stok"];
   //tambahkan stok skrg dgn qty
   $tambahstock= $stockskrg - $jlh;
   //  query tambah barang masuk
   $data=mysqli_query($koneksi,"INSERT INTO pupuk_keluar (id, id_pupuk, jenis_pupuk, jumlah, satuan) VALUES ('','$pupuk','$jenis','$jlh','$satuan')");
  //  var_dump($data);die();
   // ubah data ditabel stock dgn data yg baru ditambah
   mysqli_query($koneksi,"UPDATE stok_pupuk SET stok ='$tambahstock' WHERE id_pupuk= '$pupuk' ");
   
   return mysqli_affected_rows($koneksi);
}

//Fungsi upadte barang keluar
function updateKeluar($data)
{
  $koneksi = Koneksi();
   $idb= mysqli_real_escape_string($koneksi, $_POST["id_pupuk"]);
   $id= mysqli_real_escape_string($koneksi, $_POST["id"]);
   $jenis= mysqli_real_escape_string($koneksi, $data["jenis"]);
   $jlh= mysqli_real_escape_string($koneksi, $data["jlh"]);
   $sat= mysqli_real_escape_string($koneksi, $data["satuan"]);

   $lihatstock = mysqli_query($koneksi,"SELECT * FROM stok_pupuk WHERE id_pupuk='$idb'");
   $stocknya=mysqli_fetch_assoc($lihatstock);
   $stokskrg= $stocknya["stok"];

   $qtyskrg= mysqli_query($koneksi,"SELECT * FROM pupuk_keluar WHERE id='$id'");
   $qtynya= mysqli_fetch_assoc($qtyskrg);
   $qtyskrg= $qtynya["jumlah"];

   if($jlh > $qtyskrg){
      $selisih= $jlh - $qtyskrg;
      $tambahin = $stokskrg - $selisih;
      //update stok di tabel stok barang
      $data=mysqli_query($koneksi,"UPDATE stok_pupuk SET stok='$tambahin' WHERE id_pupuk='$idb'");
      // var_dump($data);die();
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE pupuk_keluar SET jenis_pupuk='$jenis', jumlah='$jlh', satuan='$sat' WHERE id='$id'");
   }else{
      $selisih= $qtyskrg - $jlh;
      $kurangin = $stokskrg + $selisih;
      //update stok di tabel stok barang
      mysqli_query($koneksi,"UPDATE stok_pupuk SET stok='$kurangin' WHERE id_pupuk='$idb'");
      //update data di tabel stok masuk
      mysqli_query($koneksi,"UPDATE pupuk_keluar SET jenis_pupuk='$jenis', jumlah='$jlh', satuan='$sat' WHERE id='$id'");

   }
   return mysqli_affected_rows($koneksi);
}

function hapusKeluar($id)
{
  $koneksi = Koneksi();
  $id = htmlspecialchars($_GET["id"]);

  mysqli_query($koneksi,"DELETE FROM pupuk_keluar WHERE id=$id ");
 
  return mysqli_affected_rows($koneksi);
  
}