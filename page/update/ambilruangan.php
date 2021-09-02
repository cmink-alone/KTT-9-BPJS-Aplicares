<?php
include '../../config/koneksi.php';
$idr = $_GET['idr'];

$q2=mysql_query("SELECT kodekelas,nm_kelas,koderuang,namaruang,kapasitas,tersedia,tersediapria,tersediawanita,tersediapriawanita
 FROM datruang a inner join refkelas b on a.kodekelas=b.kd_kelas where idruang='$idr' order by TglEntri desc limit 1");

while($row1=mysql_fetch_array($q2)){ ?>
<input type="text" class="form-control" id="kls" name="kls" value=<?php echo $row1['kodekelas']; ?> readonly="true" style="display:none;">

 <div class="form-group">
                         <label  class="col-sm-4 col-lg-1 control-label">Kode Ruangan</label>
                         <div class="col-sm-3 col-lg-2">
                             <select class="form-control" name="kdr" id="kdr" readonly="true">
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
                         <div class="col-sm-3 col-lg-2">
                              
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
                        
                         <label  class="col-sm-4 col-lg-1 control-label">Jumlah Pasien</label>
                         <div class="col-sm-3 col-lg-2">
                             <input type="text" class="form-control numeric" id="n" name="n" onkeyup="sum()">
                         </div>

                        <label  class="col-sm-4 col-lg-1 control-label">Tersedia</label>
                         <div class="col-sm-3 col-lg-2">
                             <input type="text" class="form-control numeric" id="tsd" name="tsd" value="<?php echo $row1['tersedia'] ; ?>" readonly="true">
                         </div>

                         
                        
                        
                      </div>
                     <div class="form-group">
                      <div class="col-sm-offset-1 col-sm-2">
                        <button type="submit" id="s" name="s" class="btn btn-warning"><span class="fa fa-check-square"></span>  Update</button>
                      </div>
                    </div>
                
                <?php } ?>


<script>

 $(".numeric").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

$("#s").click(function() {
    var idr = $("#idr").val();
    var kls = $("#kls").val();
   

    var kap = $("#kap").val();
    var tsd = $("#tsd").val();
    var n   = $("#n").val();

      dataString = 'kls=' + kls + '&kap=' + kap + '&tsd=' + tsd + '&idr=' + idr + '&n=' + n;
      
      
     var x = parseInt(n);
     var y = parseInt(kap);

    if(x>y){
      alert("Jumlah Tersedia Lebih Besar Dari Kapasitas");
      return false;
    }

    if(n==""){
            alert("Masukkan Jumlah Pasien Dulu !!!\nYang Teliti Dong Gan.. !!");
           return false;
        }
   
  
 $.ajax({
  type: "post",
    url: "page/update/result.php",
    data: dataString,
    beforeSend: function(html) {
    $("#result").empty();
    $("#flash").show();
  //$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Data...');},  
    $("#flash").html('<img src="images/loading.gif" align="absmiddle">');}, 
     success: function(html){
     //$("#entri-mpk :input").attr("disabled", true);
     $("#idr").val("");
     $("#kdr").val("");
     $("#k").val("");
     $("#nmr").val("");
     $("#kap").val("");
     $("#tsd").val("");
     $("#n").val("");
     
     /*$("#tsdp").val("");
     $("#tsdw").val("");
     $("#tsdpw").val("");*/
     //$("#isi").hide();
     $("#isi").empty();
     $("#flash").hide();
     $("#result").empty();
     $("#result").show();
     $("#result").append(html);
  
  }}); 
  
  
return false;
});

</script>