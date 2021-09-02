<?php
include 'config/koneksi.php';
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$tgl=date('Y-m-d');
$u=$_SESSION['UNAME'];
$id=$_SESSION['ID'];
$pwd=$_SESSION['PWD'];
$nm=$_SESSION['NMPPK'];
$day=date('l');

function TanggalIndo($date){
  $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
  $tahun = substr($date, 0, 4);
  $bulan = substr($date, 5, 2);
  $tgl   = substr($date, 8, 2);
 
  $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   
  return($result);
}


if(!isset($_SESSION['APLICARES_STATUS'])){
      header('location:login.php');
  }


  $host="http://dvlp.bpjs-kesehatan.go.id:9080";
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
   
    echo $response;
?>
