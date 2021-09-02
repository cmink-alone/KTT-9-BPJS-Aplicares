<?php
include '../../config/koneksi.php';
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$tgl=date('Y-m-d H:i:s');
$u=$_SESSION['UNAME'];
$id=$_SESSION['ID'];
$pwd=$_SESSION['PWD'];
$idr=$_POST['idr'];
$kls=$_POST['kls'];


$kap=$_POST['kap'];
$tsd=$_POST['tsd'];
$n=$_POST['n'];

$q2=mysql_query("SELECT koderuang,namaruang
 FROM datruang where idruang='$idr' order by TglEntri desc limit 1");

while($row1=mysql_fetch_array($q2)){  
    $kdr=$row1['koderuang'];
    $nmr=$row1['namaruang'];
}

/*$tsdp=$_POST['tsdp'];
$tsdw=$_POST['tsdw'];
$tsdpw=$_POST['tsdpw'];*/

	//$host="http://dvlp.bpjs-kesehatan.go.id:9080";
    //untuk create 
	//$url = $host."/aplicaresws/rest/bed/update/".$u;
  $url = $host."/aplicaresws/rest/bed/update/".$u;
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
				'koderuang'=>$kdr,
				'namaruang'=>$nmr,
				'kapasitas'=>$kap,
				'tersedia'=>$tsd
				
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
    
    $idr=$kdr . '.' . $kls;
    if($feedback=='1'){
    
      $query1=mysql_query("UPDATE datruang set tersedia='$tsd',tglentri='$tgl',kdppk='$u',jmlpasien='$n'
      where idruang='$idr' and kdppk='$u'");
    }

    $query2=mysql_query("SELECT nm_kelas
    	FROM refkelas where kd_kelas='$kls'");
    while($rowx=mysql_fetch_array($query2)){
    	$nm_kelas=$rowx['nm_kelas'];
    }

 ?>
    
 <section class="content">
  <div class="row">
  <?php if($feedback=='1'){ ?>
  	<div class="col-md-6">
  		<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                Ruangan dengan nama <?php echo $nmr ;?> <?php echo $nm_kelas; ?> Telah Berhasil diupdate
        </div>
    </div>
  <?php } elseif($feedback=='0'){ ?>
 	<div class="col-md-6">
  		<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                Another Error
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