<?php
include '../../config/koneksi.php';
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$tgl=date('Y-m-d H:i:s');
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
  
  $query=mysql_query("truncate table datruang");
  for ($x = 0; $x < $i; $x++) {
    				
    
        
              $nmkelas=$test->response->list[$x]->namakelas;
              $kdr=$test->response->list[$x]->koderuang;

              $query2=mysql_query("SELECT kd_kelas FROM refkelas where nm_kelas='$nmkelas'");
              while($row2=mysql_fetch_array($query2)){
                $kls=$row2['kd_kelas'];
              } 

              $url = $host."/aplicaresws/rest/bed/delete/".$u;
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


              $myvars="";
              $item = array(
                'kodekelas'=>$kls,
                'koderuang'=>$kdr
              );
          
  $myvars = json_encode($item);
             
             $myvars = json_encode($item);
  
    curl_setopt ( $session, CURLOPT_URL, $url );
    curl_setopt ( $session, CURLOPT_HTTPHEADER, $arrheader );
    curl_setopt ( $session, CURLOPT_VERBOSE, true );
    curl_setopt ( $session, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt ( $session, CURLOPT_SSL_VERIFYHOST, false);
    

      curl_setopt ( $session, CURLOPT_POST, true );
      curl_setopt ( $session, CURLOPT_POSTFIELDS, $myvars );

    curl_setopt ( $session, CURLOPT_RETURNTRANSFER, TRUE );
    $response = curl_exec ( $session );
    //echo $myvars;
    $test = json_decode($response);
    $feedback = $test->metadata->code;  


    				}  ?>
 <section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
               Jumlah ruangan sebanyak <?php echo $i; ?> berhasil dihapus.
        </div>
      </div>
    </div>
  </section>          
 <?php } else { 
               echo "We've gotta problem";
}        