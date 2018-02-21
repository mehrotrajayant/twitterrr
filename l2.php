<?php
if(isset($_POST['add'])){
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Yadav@12345*#';
$db_name = 'jayant';
$tbl_name = 'registration';
$ftp_user = '';
$ftp_pass = '';
$ftp_server = "";

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("$db_name")or die("cannot select DB");


/*

$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
// login with username and password
$login_result = ftp_login($ftp_conn, $ftp_user, $ftp_pass);


// check connection
if ((!$ftp_conn) || (!$login_result)) {
       echo "FTP connection has failed!";
       echo "Attempted to connect to $ftp_server for user $ftp_user";
       exit;
   } else {
       echo "Connected to $ftp_server, for user $ftp_user";
   }

*/
//$fileToUpload = $_POST['fileToUpload'];
$reg = $_POST['Reg'];
$name = $_POST['name'];
$Email = $_POST['email'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$mobile = $_POST['Mobile_no'];
$uploadDir = 'http://localhost/Jayant/'.'upload/'; 
$fileName = $_FILES['fileToUpload']['name'];
$filePath = $uploadDir . $fileName;

if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../upload/".$_FILES["fileToUpload"]["name"]))
{
// If file has uploaded successfully, store its name in data base
$query_image = "INSERT INTO $tbl_name(Reg,name,email,pass,fileToUpload,cpass,Mobile_no,filepath) VALUES ('$reg','$name','$Email','$pass','$fileName','$cpass','$mobile','$filePath')";
if(mysql_query($query_image))
{
echo "Stored in: " . "upload/" . $_FILES["fileToUpload"]["name"];
}
else
{
echo 'File name not stored in database';
}
}
else{echo 'File not uploaded';}

}

$insertGoTo = "login1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  mysql_free_result ( $query_image );
mysql_close();


?>