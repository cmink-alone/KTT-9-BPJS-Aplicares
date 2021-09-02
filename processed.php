<?php
session_start();
include_once('config/koneksi.php');
date_default_timezone_set("Asia/Kuala_Lumpur");
$now=date('Y-m-d H:i:s');
$message=array();
if(isset($_POST['uname']) && !empty($_POST['uname'])){
    $uname=$_POST['uname'];
}else{
    $message[]='Please enter username';
}

if(isset($_POST['password']) && !empty($_POST['password'])){
    $password=md5($_POST['password']);
}else{
    $message[]='Please enter password';
}

$countError=count($message);

if($countError > 0){
     for($i=0;$i<$countError;$i++){
              echo ucwords($message[$i]).'<br/><br/>';
     }
}else{
    //$query=odbc_exec($conn,"select * from user_kapurung where username='$uname' and password='$password'");
    $query="SELECT * FROM users where username='$uname' and password='$password'";
    //$res=mysql_query($query);

    $res=mysql_query($query);
    $checkUser=mysql_num_rows($res);
    if($checkUser > 0){
         $_SESSION['APLICARES_STATUS']=true;
         $_SESSION['UNAME']=$uname;
         while($row=mysql_fetch_array($res)){
            $_SESSION['NMPPK']=$row['nmppk'];
            $_SESSION['ID']=$row['consid'];
            $_SESSION['PWD']=$row['conspwd'];
         }
         echo 'correct';
    }else{
         echo ucwords('Please enter correct user details');
    }
    /*$checkUser=mysql_num_rows($res);
    if($checkUser > 0){
         $_SESSION['LOGIN_STATUS']=true;
         $_SESSION['UNAME']=$uname;
         while($row=mysql_fetch_array($res)){
            $_SESSION['LEVEL']=$row['hakakses'];
            $_SESSION['KC']=$row['kdkc'];
         }
         echo 'correct';
    }else{
         echo ucwords('please enter correct user details');
    }*/
}
?>

