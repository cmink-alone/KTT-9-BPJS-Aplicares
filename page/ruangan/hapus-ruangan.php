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
            <h3 class="box-title">Hapus Ruangan
            </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
            <form class="form-horizontal">
              <div class="box-body">
                      <div class="form-group">
                        <div id="cek">
                         <label  class="col-sm-2 col-lg-1 control-label">Pilih Ruang</label>
                         <div class="col-sm-3 col-lg-6">
                             <select class="form-control" name="idr" id="idr">
                                  <option value=''>- Pilih Ruangan -</option>
                            <?php
                            $q1=mysql_query("SELECT id,idruang,namaruang,nm_kelas FROM datruang a inner join refkelas b on a.kodekelas=b.kd_kelas where kdppk='$u' group by idruang,namaruang,nm_kelas order by id");
                            while($row=mysql_fetch_array($q1)){
                              echo "<option value='$row[id]'>$row[namaruang] - $row[nm_kelas] </option>";
                            }
                            ?>
                            </select>

                         </div>
                         <button type="submit" id="c" name="c" class="btn btn-info"><span class="fa fa-search"></span>  Cari</button>
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

$("#c").click(function() {
    var idr = $("#idr").val();

        
    dataString = 'idr=' + idr ;
        

    
 $.ajax({
  type: "post",
    url: "page/ruangan/ambilruangan.php",
    data: dataString,
    cache: false,
    beforeSend: function(html) {
    $("#result").empty();}, 
     success: function(html){
   
     $("#isi").empty();
     $("#isi").show();
     $("#isi").append(html);
    
        
  }}); 
  
  
return false;
});
  

</script>