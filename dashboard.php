<?php
include 'config/koneksi.php';
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$tgl=date('Y-m-d');
$u=$_SESSION['UNAME'];
$id=$_SESSION['ID'];
$pwd=$_SESSION['PWD'];
$nm=$_SESSION['NMPPK'];
$day=date('360');

function TanggalIndo($date){
  $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
  $tahun = substr($date, 0, 4);
  $bulan = substr($date, 5, 2);
  $tgl   = substr($date, 8, 2);
 
  $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   
  return($result);
}


/*if(!isset($_SESSION['APLICARES_STATUS'])){
      header('location:login.php');
  }
*/

   $query1=mysql_query("SELECT id,nm_kelas FROM histdashboard a inner join refkelas b on a.id=b.no");
    while($row1=mysql_fetch_array($query1)){
      $x=$row1['id'];
      $n=$row1['nm_kelas'];

      }

/*	$host="http://dvlp.bpjs-kesehatan.go.id:9080";
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
    */
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ketersediaan Tempat Tidur </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">!-->
  <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">!-->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <script src="js/jquery.js"></script>
  <script src="js/ajax-call.js"></script>
  <script src="js/jquery.table2excel.js"></script>
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
   <link rel="stylesheet" href="plugins/select2/select2.min.css">
   <link rel='shortcut icon' type='image/x-icon' href='images/logox.png'/>
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style type="text/css">
  body {
    font-family: 'Montserrat', sans-serif;
  }
  footer {
    position: fixed;
    height: 20px;
    bottom: 0;
    width: 100%;
}
</style>
</head>
<body style="background-color: #ffffff;">

  <div class="row" style="background-color: #fffff;">
    <div class="col-md-2" >
    	  
       
        <img src="images/logo-rs.png" alt="Smiley face" height="80" width="250" align="left">      
     
    </div>
     <div class="col-md-8" style="text-align:right;color:#021c1e;">
        <p style="font-size:42px;">KETERSEDIAAN TEMPAT TIDUR <?php echo $nm; ?></p>
      
    </div>
              
    <div class="col-md-2" style="color:#66a5ad;text-align:center;">
        <span style="font-size:25px;"><?php echo TanggalIndo($tgl); ?></span>
        <p style="font-size:35px;"><span class="clock" size="8"></span></p>
    </div>
  </div>

  <div class="col-md-12">
  <p style="font-size:25px;">
      <i class="fa fa-phone-square"></i> 
      <?php
      $query4=mysql_query("SELECT name,phone FROM datcp");
      while ($row1=mysql_fetch_array($query4)){
        echo $row1['name'] . " ( " . $row1['phone'] . " ) " ;
      }
      ?>
  </p>
  <table class="table table-striped">
    <tr style="font-size:40px;">
      <th colspan="4" style="background-color:#1D65A6;color:white;">INFORMASI TEMPAT TIDUR  <em style="color:#f05837;font-size:42px;"><?php echo $n; ?></em> </th>
    </tr>
    <tr style="font-size:36px;background-color:#e1315b;color:white;">
           
      <th>NAMA RUANG</th>
      <th>KAPASITAS</th>
      <th>TERSEDIA</th>
     
      <th>UPDATE TERAKHIR</th>
    </tr>
     
  </div>
  <div class="col-md-12" id="test">
    <?php

    
   
      $query3=mysql_query("SELECT namaruang,nm_kelas,kapasitas,tersedia,tglentri FROM datruang a inner join refkelas b on a.kodekelas=b.kd_kelas 
      where no='$x' and kdppk='$u' order by tglentri desc");
      $baris=mysql_num_rows($query3);
      while ($row2=mysql_fetch_array($query3)){
      echo "<tr style='background-color:#afbadc;font-size:36px;'>";
     
      
      echo "<td> $row2[namaruang] </td>";
      echo "<td> $row2[kapasitas] </td>";
      if($row2['tersedia']=='0'){
        echo "<td style='background-color:#f22f08;'> $row2[tersedia] </td>";
      } else {
        echo "<td> $row2[tersedia] </td>";  
      } 
      
      echo "<td> $row2[tglentri] </td>";
      echo "</tr>";

       }
    
    if($x=='16'){
      $i=1;
      $query3=mysql_query("UPDATE histdashboard SET id='$i'");
    } else {
      $i=$x+1;
      $query3=mysql_query("UPDATE histdashboard SET id='$i'");
    }

    ?>
    
  </table>
  </div>          		
         		
  <footer class="navbar-fixed-bottom" style="background-color:black;color:white;font-size:18px;">
     <MARQUEE DIRECTION=left>
      <?php 
      $q1=mysql_query("SELECT isi FROM runningtext");
      while ($row=mysql_fetch_array($q1)) {
        echo $row['isi'] ; 
      }

      ?>
    </MARQUEE>
  </footer>
        
      
</section>


<?php //} 
while (true) {
    //process_one();
    if($baris=='0'){
      $jeda = 5; // jeda 15 detik
    } else {
      $jeda = 5; // jeda 15 detik  
    }
    
      // Detek otomatis, cli atau browser (by Radya)
      if(php_sapi_name()==="cli") {
          sleep($jeda); //beri jedah 15 detik
      } else {
          echo '<meta http-equiv="refresh" content="'.$jeda.'">';
        break;
      }
    }
?>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="dist/jsraphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>!-->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</html>
<script>
function clock() {// We create a new Date object and assign it to a variable called "time".
var time = new Date(),
    
    // Access the "getHours" method on the Date object with the dot accessor.
    hours = time.getHours(),
    
    // Access the "getMinutes" method with the dot accessor.
    minutes = time.getMinutes(),
    
    
    seconds = time.getSeconds();

document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
  
  function harold(standIn) {
    if (standIn < 10) {
      standIn = '0' + standIn
    }
    return standIn;
  }
}
setInterval(clock, 1000);
$(this).scrollTop(0);
$("html, body").animate({ scrollTop: $('#test').offset().top }, 3000);
</script>

