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
            <h3 class="box-title">Update Running Text
            </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
            <form class="form-horizontal">
              <div class="box-body">
                    <div class="form-group">
                         <label  class="col-sm-4 col-lg-2 control-label">Running Text</label>
                         <div class="col-sm-3 col-lg-6">
                             <input type="text" class="form-control" id="run" name="run">
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

    var run = $("#run").val();
 
    
    
   // var tsdpw = $("#tsdpw").val();
   // var b = test.replace(/\u200B/g,'');
    dataString = 'run=' + run  ;
    // Let's test it out
    
    if(run==""){
            alert("Masukkan Running Text Dulu !!!\nYang Teliti Dong Gan.. !!");
           return false;
        }

   


   //alert(dataString);
    
       
 $.ajax({
  type: "post",
    url: "page/running/result.php",
    data: dataString,
    beforeSend: function(html) {
    $("#result").empty();
    $("#flash").show();
  //$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Data...');},  
    $("#flash").html('<img src="images/loading.gif" align="absmiddle">');}, 
     success: function(html){
     //$("#entri-mpk :input").attr("disabled", true);
     $("#run").val("");
    
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