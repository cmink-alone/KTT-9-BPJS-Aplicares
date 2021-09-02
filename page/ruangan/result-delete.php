<?php
include '../../config/koneksi.php';
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$id=$_SESSION['ID'];
$pwd=$_SESSION['PWD'];
$tgl=date('Y-m-d H:i:s');
$u=$_SESSION['UNAME'];

$idr=$_POST['idr'];

$q2=mysql_query("SELECT kodekelas,koderuang
 FROM datruang a inner join refkelas b on a.kodekelas=b.kd_kelas where id='$idr' order by TglEntri desc limit 1");
  
  while($rowx=mysql_fetch_array($q2)){
    $kls=$rowx['kodekelas'];
    $kdr=$rowx['koderuang'];
  }

	//$host="http://dvlp.bpjs-kesehatan.go.id:9080";
    //untuk create 
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
    //echo $test->metadata->message ."<br/>" ; 
    //echo $response;
    //echo $kls;
    //echo $kdr;
   // $idr=$kdr . '.' . $kls;
    if($feedback=='1'){
    	/*$query1=mysql_query("INSERT INTO datruang(kodekelas,koderuang,namaruang,kapasitas,tersedia,
    		tersediapria,tersediawanita,tersediapriawanita,tglentri,kdppk) 
			VALUES('$kls','$kdr','$nmr','$kap','$tsd','$tsdp','$tsdw','$tsdpw','$tgl','$u')");*/
      $query1=mysql_query("DELETE FROM datruang where id='$idr'");
       //echo $idr;
    }

  

 ?>
    
 <section class="content">
  <div class="row">
  <?php if($feedback=='1'){ ?>
  	<div class="col-md-6">
  		<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>Ruangan dengan kode ruang <?php echo $kdr ;?> <?php echo $kls; ?> Telah Dihapus. </p>
                <p>Halaman akan refresh otomatis selama 3 detik</p>
        </div>
    </div>
  <?php } elseif($feedback=='0'){ ?>
 	<div class="col-md-6">
  		<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                Something Wrong
        </div>
    </div>
  <?php } if ($koneksi=='0'){ ?>
  <div class="col-md-6">
      <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                Response : <?php echo $response; ?> <br />
                Data     : <?php echo $myvars; ?>

        </div>
    </div>
    <?php } ?>
  </div>
 </section>