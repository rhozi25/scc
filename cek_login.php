<?php
////////////////////////////////////////////////////////////////////////
//perintah untuk verifikasi data yang telah dikirim dari form login   //
////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////
//memulai sesi verifikasi                                             //
////////////////////////////////////////////////////////////////////////
session_start();

////////////////////////////////////////////////////////////////////////
//menyambungkan ke server data base                                   //
////////////////////////////////////////////////////////////////////////
include('lib/config.php');

////////////////////////////////////////////////////////////////////////
//menyandikan password yang telah dikirim untuk verifikasi            //
////////////////////////////////////////////////////////////////////////
$username=$_POST['username'];
$password=$_POST['password'];

////////////////////////////////////////////////////////////////////////
//memulai verifikasi dari data base yang tersedia                     //
////////////////////////////////////////////////////////////////////////
$query="SELECT * FROM anggota WHERE username = '$username' AND password = '$password'";
$result=mysql_query($query);
if(mysql_num_rows($result) !=0){

////////////////////////////////////////////////////////////////////////
//memberikan ijin jika data sesuai                                    //
////////////////////////////////////////////////////////////////////////
	$row=mysql_fetch_array($result);
	$_SESSION['username']=$row['username'];
	$_SESSION['namane']=$row['namane'];
	$_SESSION['password']=$row['password'];
	$_SESSION['level']=$row['level'];

////////////////////////////////////////////////////////////////////////
//akses hanya diberikan jika data adalah "admin" dan "user"           //
////////////////////////////////////////////////////////////////////////
	if($row['level']=='admin' || $row['level']=='user'){
		header("Location: index.php");
		}
	}

////////////////////////////////////////////////////////////////////////
//jika data yang dikirim tidak sesuai, maka tidak diberi ijin akses   //
////////////////////////////////////////////////////////////////////////
else {
	echo"<div style='width:200px; height:100px; background:grey; align:center;'>anda tidak bisa masuk";
	echo"<a href='izin.php'>login</a></div>";
	}

?>