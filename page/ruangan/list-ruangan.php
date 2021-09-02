<?php
include '../../config/koneksi.php';
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$tgl=date('Y-m-d');
$u=$_SESSION['UNAME'];
$id=$_SESSION['ID'];
$pwd=$_SESSION['PWD'];

	//$host="http://dvlp.bpjs-kesehatan.go.id:9080";
    //untuk create 
	$url = $host."/aplicaresws/rest/bed/read/".$u."/1/100";
	//echo $url;
	//untuk update
	//$url = $host."/aplicaresws/rest/bed/update/0901R001";
	
	
    $session = curl_init ( $url );
    $cid = $id;
	  $ckey = $pwd;
	


	//get Timestamp
	date_default_timezone_set("Asia/Jakarta");
	$timestamp = strtotime(date("Y/m/d H:i:s"));

	//set data value
	$data = $cid."&".$timestamp;

	//generate signature
	$signature = hash_hmac('sha256', $data, $ckey, true);
	$encodedSignature = base64_encode($signature);
	//$author = base64_encode('::');
    
	$arrheader = array (
		'X-cons-id: '.$cid,
		'X-Timestamp: '.$timestamp,
		'X-Signature: '.$encodedSignature,
        'Accept: application/json',
        'Content-Type: application/json'
    );
	
	
    curl_setopt ( $session, CURLOPT_URL, $url );
    curl_setopt ( $session, CURLOPT_HTTPHEADER, $arrheader );
    curl_setopt ( $session, CURLOPT_VERBOSE, true );
    curl_setopt ( $session, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt ( $session, CURLOPT_SSL_VERIFYHOST, false);
    
    curl_setopt ( $session, CURLOPT_RETURNTRANSFER, TRUE );
    $response = curl_exec ( $session );
    //echo $myvars;
    //echo $response . "<br/>";

    $test=json_decode($response);
    $feedback = $test->metadata->code;  
    $i=$test->metadata->totalitems;
   
    //echo $response;

if($feedback=='1'){


 ?>
 <section class="content">
  <div class="row">
<div class="col-md-8">
    		<div class="box box-warning">
          		<div class="box-header with-border">
            		<h3 class="box-title">List Ruangan di <?php echo $_SESSION['NMPPK']; ?>
            		</h3>
              		<div class="box-tools pull-right">
                		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              		</div>
          		</div>
          		<?php
      
                  
            if ($i>='50'){
            ?>
                <div class="box-body table-responsive no-padding" style="overflow:auto;height:800px;">  
            <?php    
            } else {
            ?>
                <div class="box-body table-responsive no-padding">  
            <?php
            }
          ?>
              <table class="table table-hover" id="report">
                <tr>
                  
                  
                 <!-- <th>Deskripsi</th>!-->
                  <th>No</th>
                  <th>Kode Ruang</th>
                  <th>Nama Ruang</th>
                  <th>Nama Kelas</th>
                  <th>Kapasitas</th>
                </tr>
                <?php
               
                  $no=1;
                  for ($x = 0; $x < $i; $x++) {
    				//echo $test->response->list[$x]->namaruang ."<br/>" ; 
	

                 echo "<tr>";
                
                 echo "<td>". $test->response->list[$x]->rownumber."</td>";
                 echo "<td>". $test->response->list[$x]->koderuang."</td>";
                 echo "<td>". $test->response->list[$x]->namaruang."</td>";
                 echo "<td>". $test->response->list[$x]->namakelas."</td>";
                 echo "<td>". $test->response->list[$x]->kapasitas."</td>";
                
                 echo  "</tr>";  
                
    				}            
                ?>
               </table>
            </div>
         	</div>
    	</div>
    </div>

 <?php } else { ?>
<div class="col-md-6">
  		<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                We've gotta problem
        </div>
    </div>
<?php } ?>
</div>
</section>
