<?php
error_reporting(E_ALL ^ E_DEPRECATED);

$user_db="root";
$pass_db="";
$server_db="localhost";
$nama_db="db_aplicares";

$bd = mysql_connect($server_db, $user_db, $pass_db) or die("Kesalahan dalam setting koneksi database...");
mysql_select_db($nama_db, $bd) or die("Gagal Tidak bisa memilih database. .");


$koneksi=1;
//ganti nilai koneksi menjadi 0 , jika develop
//ganti nilai koneksi menjadi 1 , jika production


$fix=mysql_query("SELECT url from refurl where koneksi='$koneksi'");
while($row1=mysql_fetch_array($fix)){
	$host=$row1['url'];
}

?>