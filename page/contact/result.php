<?php
include '../../config/koneksi.php';
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$id=$_SESSION['ID'];
$pwd=$_SESSION['PWD'];
$tgl=date('Y-m-d H:i:s');
$u=$_SESSION['UNAME'];
$nm=$_POST['nm'];
$telp=$_POST['telp'];

  $query=mysql_query("TRUNCATE TABLE datcp");  

  $query1="INSERT INTO datcp(name,phone) values('$nm','$telp')";
       

 ?>
    
 <section class="content">
  <div class="row">
  <?php if(mysql_query($query1)){ ?>
  	<div class="col-md-6">
  		<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                Contact Person Berhasil diupdate
        </div>
    </div>
  <?php } else { ?>
 	<div class="col-md-6">
  		<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                 Another Error
        </div>
    </div>
  <?php } ?>
  </div>
 </section>