<?php
include '../../config/koneksi.php';
session_start();
$l=$_SESSION['LEVEL'];
$u=$_SESSION['UNAME'];
?>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Update Tempat Tidur
            </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
            <form class="form-horizontal">
              <div class="box-body">
                      <div class="form-group">
                         <label  class="col-sm-2 col-lg-1 control-label">Pilih Ruang</label>
                         <div class="col-sm-3 col-lg-6">
                             <select class="form-control" name="idr" id="idr">
                                  <option value=''>- Pilih Ruangan -</option>
                            <?php
                            $q1=mysql_query("SELECT idruang,namaruang,nm_kelas FROM datruang a inner join refkelas b on a.kodekelas=b.kd_kelas where kdppk='$u' group by idruang,namaruang,nm_kelas");
                            while($row=mysql_fetch_array($q1)){
                              echo "<option value='$row[idruang]'>$row[namaruang] - $row[nm_kelas] </option>";
                            }
                            ?>
                            </select>
                         </div>
                         
                      </div>
                      <div id="isi">
                       
                    </div>
                   
              </div>
                  

                </form>        
          </div>
        </div>
      </div>
</section>



<div id="flash" style="height:5px;">
   
</div>

<div id="result"></div>





<script>
$("#idr").change(function(){
var idr = $("#idr").val();
$.ajax({
url: "page/update/ambilruangan.php",
data: "idr="+idr,
cache: false,
success: function(msg){
$("#isi").html(msg);
}
});
});

function sum() {
  
  var kap = document.getElementById('kap').value;
  var n = document.getElementById('n').value;
  var result = parseInt(kap) - parseInt(n);
  
  if (!isNaN(result)) {
    document.getElementById('tsd').value = result;
  }
}

</script>