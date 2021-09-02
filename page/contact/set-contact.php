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
            <h3 class="box-title">Contact Person
            </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
            <form class="form-horizontal">
              <div class="box-body">
                    <div class="form-group">
                         <label  class="col-sm-4 col-lg-2 control-label">Nama</label>
                         <div class="col-sm-3 col-lg-3">
                             <input type="text" class="form-control" id="nm" name="nm">
                         </div>
                         <label  class="col-sm-1 col-lg-1 control-label">Telp</label>
                         <div class="col-sm-3 col-lg-3">
                             <input type="text" class="form-control numeric" id="telp" name="telp">
                         </div>
                         <button type="submit" id="s" name="s" class="btn btn-info"><span class="fa fa-check-square"></span>  Update</button>
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

    var nm = $("#nm").val();
    var telp = $("#telp").val();
 
    
    
   // var tsdpw = $("#tsdpw").val();
   // var b = test.replace(/\u200B/g,'');
    dataString = 'nm=' + nm + '&telp=' + telp  ;
    // Let's test it out
    
    if(nm==""){
            alert("Masukkan Nama Dulu !!!\nYang Teliti Dong Gan.. !!");
           return false;
        }

    if(telp==""){
       alert("Masukkan Nomor Telpon Dulu !!!\nYang Teliti Dong Gan.. !!");
           return false;
    }

   


   //alert(dataString);
    
       
 $.ajax({
  type: "post",
    url: "page/contact/result.php",
    data: dataString,
    beforeSend: function(html) {
    $("#result").empty();
    $("#flash").show();
  //$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Data...');},  
    $("#flash").html('<img src="images/loading.gif" align="absmiddle">');}, 
     success: function(html){
     //$("#entri-mpk :input").attr("disabled", true);
     $("#nm").val("");
     $("#telp").val("");
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