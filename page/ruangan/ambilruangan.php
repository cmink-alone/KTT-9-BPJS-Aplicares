<?php
include '../../config/koneksi.php';
$idr = $_POST['idr'];

$q2=mysql_query("SELECT kodekelas,nm_kelas,koderuang,namaruang,kapasitas,tersedia,tersediapria,tersediawanita,tersediapriawanita
 FROM datruang a inner join refkelas b on a.kodekelas=b.kd_kelas where id='$idr' order by TglEntri desc limit 1");

while($row1=mysql_fetch_array($q2)){ ?>
<input type="text" class="form-control" id="kls" name="kls" value=<?php echo $row1['kodekelas']; ?> readonly="true" style="display:none;">
<input type="text" class="form-control" id="kdr" name="kdr" value=<?php echo $row1['koderuang']; ?> readonly="true" style="display:none;">
 <div class="form-group">
                         <label  class="col-sm-4 col-lg-1 control-label">Kode Ruangan</label>
                         <div class="col-sm-3 col-lg-2">
                             <select class="form-control" name="kdr" id="kdrx" readonly="true">
                                    <option value=<?php echo $row1['koderuang']; ?>><?php echo $row1['koderuang']; ?></option>
                                </select>
                            
                         </div>
                         <label  class="col-sm-4 col-lg-1 control-label">Nama Kelas</label>
                         <div class="col-sm-3 col-lg-2">
                               
                                <select class="form-control" name="k" id="k" readonly="true">
                                    <option value=<?php echo $row1['nm_kelas']; ?>><?php echo $row1['nm_kelas'];?> </option>
                                </select>
                         </div>
                         <label  class="col-sm-4 col-lg-1 control-label">Nama Ruangan</label>
                         <div class="col-sm-3 col-lg-5">
                              <select class="form-control" name="nmr" id="nmr" readonly="true">
                                    <option value=<?php echo $row1['namaruang']; ?>><?php echo $row1['namaruang'];?> </option>
                                </select>   
                            
                         </div>
                         
                      </div>
                      <div class="form-group">
                      <label  class="col-sm-2 col-lg-1 control-label">Kapasitas</label>
                         <div class="col-sm-3 col-lg-2">
                             <input type="text" class="form-control numeric" id="kap" name="kap" value=<?php echo $row1['kapasitas']; ?> readonly="true">
                         </div>   
                      </div>
                     <div class="form-group">
                      <div class="col-sm-offset-1 col-sm-2">
                        <button type="submit" id="s" name="s" class="btn btn-danger"><span class="fa fa-remove"></span>  Hapus</button>
                      </div>
                    </div>
                
                <?php } ?>


<script>


$("#s").click(function() {
    var idr = $("#idr").val();
    //var kls = $("#kls").val();
    //var kdr = $("#kdr").val();
   

      //dataString = 'kls=' + kls + '&kdr=' + kdr +  '&idr=' + idr ;
        
    dataString = 'idr=' + idr ;
        
    //alert(dataString);
    
 $.ajax({
  type: "post",
    url: "page/ruangan/result-delete.php",
    data: dataString,
    cache: false,
    beforeSend: function(html) {
    $("#result").empty();
    $("#flash").show();
  //$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Data...');},  
    $("#flash").html('<img src="images/loading.gif" align="absmiddle">');}, 
     success: function(html){
     //$("#entri-mpk :input").attr("disabled", true);
      setTimeout(function(){
      window.location.reload(1);
    }, 3000);
     $("#idr").val("");
     $("#kdr").val("");
     $("#k").val("");
     $("#nmr").val("");
     $("#kap").val("");
     $("#flash").hide();
     $("#result").empty();
     $("#result").show();
     $("#result").append(html);
        
  }}); 
  
  
return false;
});

</script>