<?php
include '../../config/koneksi.php';
session_start();
$l=$_SESSION['LEVEL'];
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Entri Ruangan
            </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
            <form class="form-horizontal">
              <div class="box-body">
                      <div class="form-group">
                         <label  class="col-sm-2 col-lg-1 control-label">Kode Kelas</label>
                         <div class="col-sm-3 col-lg-2">
                             <select class="form-control" name="kls" id="kls">
                            <?php
                            $q1=mysql_query("SELECT kd_kelas,nm_kelas FROM refkelas");
                            while($row=mysql_fetch_array($q1)){
                              echo "<option value='$row[kd_kelas]'>$row[nm_kelas]</option>";
                            }
                            ?>
                            </select>
                         </div>
                         <label  class="col-sm-4 col-lg-2 control-label">Kode Ruangan</label>
                         <div class="col-sm-3 col-lg-2">
                             <input type="text" class="form-control" id="kdr" name="kdr">
                         </div>
                         <label  class="col-sm-4 col-lg-2 control-label">Nama Ruangan</label>
                         <div class="col-sm-3 col-lg-2">
                             <input type="text" class="form-control" id="nmr" name="nmr">
                         </div>
                      </div>
                       <div class="form-group">
                        
                         <label  class="col-sm-2 col-lg-1 control-label">Kapasitas</label>
                         <div class="col-sm-3 col-lg-2">
                             <input type="text" class="form-control numeric" id="kap" name="kap">
                         </div>
                          <!--   <label  class="col-sm-2 col-lg-2 control-label">Tersedia </label>
                         <div class="col-sm-3 col-lg-2">
                             <input type="text" class="form-control numeric" id="tsd" name="tsd">
                         </div>!-->

                      </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-1 col-sm-2">
                        <button type="submit" id="s" name="s" class="btn btn-info"><span class="fa fa-check-square"></span>  Simpan</button>
                      </div>
                    </div>
                    <p class="text-danger">*) Hindari pemakaian tanda petik</p>
                    <!--<p class="text-danger">*) Abaikan ketersediaan pria,wanita dan pria/wanita, jika tidak ada perbedaan gender untuk ruangan</p>!-->
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


  $("#s").click(function() {

    var kls = $("#kls").val();
    var kdr = $("#kdr").val();
    var nmr = $("#nmr").val();
    var kap = $("#kap").val();
    
    
   // var tsdpw = $("#tsdpw").val();
   // var b = test.replace(/\u200B/g,'');
    dataString = 'kls=' + kls + '&kdr=' + kdr + '&nmr=' + nmr + '&kap=' + kap ;
    // Let's test it out
    
    if(kdr==""){
            alert("Masukkan Kode Ruang Dulu !!!\nYang Teliti Dong Gan.. !!");
           return false;
        }

    if(nmr==""){
            alert("Masukkan Nama Ruang Dulu !!!\nYang Teliti Dong Gan.. !!");
           return false;
        }

    if(kap==""){
            alert("Masukkan Kapasitas Dulu !!!\nYang Teliti Dong Gan.. !!");
           return false;
        }


   //alert(dataString);
    
       
 $.ajax({
  type: "post",
    url: "page/ruangan/result.php",
    data: dataString,
    beforeSend: function(html) {
    $("#result").empty();
    $("#flash").show();
  //$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Data...');},  
    $("#flash").html('<img src="images/loading.gif" align="absmiddle">');}, 
     success: function(html){
     //$("#entri-mpk :input").attr("disabled", true);
     $("#kdr").val("");
     $("#nmr").val("");
     $("#kap").val("");
     $("#flash").hide();
     $("#result").empty();
     $("#result").show();
     $("#result").append(html);
  
  }}); 
  
  
return false;
});


 $(".numeric").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });



</script>