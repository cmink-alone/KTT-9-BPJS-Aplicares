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
            <h3 class="box-title">Sinkronisasi Data
            </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
            <form class="form-horizontal">
              <div class="box-body">
                    <div class="form-group">
                         <label  class="col-sm-2 col-lg-3 control-label">Sinkron Data ke Kantor Pusat</label>
                        <div class="col-sm-3 col-lg-5">
                         <button type="submit" id="s" name="s" class="btn btn-info"><span class="fa fa-check-square"></span>  Sinkron Ruangan</button>
                       
                         <!--<button type="submit" id="h" name="h" class="btn btn-danger"><span class="fa fa-check-square"></span>  Hapus Semua Ruangan</button>!-->
                        </div>
                      </div>
                      
                    
        
                    <p class="text-danger">*) Sinkron Ruangan digunakan untuk menginsert ruangan yang ada di server BPJS Kesehatan</p>
                   
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

   


   //alert(dataString);
    
       
 $.ajax({
  type: "post",
    url: "page/sinkron/result-sinkron.php",
    //data: dataString,
    beforeSend: function(html) {
    $("#result").empty();
    $("#flash").show();
  //$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Data...');},  
    $("#flash").html('<img src="images/loading.gif" align="absmiddle">');}, 
     success: function(html){
     //$("#entri-mpk :input").attr("disabled", true);
    
     $("#flash").hide();
     $("#result").empty();
     $("#result").show();
     $("#result").append(html);
  
  }}); 
  
  
return false;
});


$("#h").click(function() {

   


   //alert(dataString);
    
       
 $.ajax({
  type: "post",
    url: "page/sinkron/result-hapus.php",
    //data: dataString,
    beforeSend: function(html) {
    $("#result").empty();
    $("#flash").show();
  //$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Data...');},  
    $("#flash").html('<img src="images/loading.gif" align="absmiddle">');}, 
     success: function(html){
     //$("#entri-mpk :input").attr("disabled", true);
    
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