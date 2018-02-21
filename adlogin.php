<?php require_once('../Connections/Jayant.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_Jayant, $Jayant);
$query_Recordset1 = "SELECT * FROM admin_login";
$Recordset1 = mysql_query($query_Recordset1, $Jayant) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['userName'])) {
  $loginUsername=$_POST['userName'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "login1.php";
  $MM_redirectLoginFailed = "welcome.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Jayant, $Jayant);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM admin_login WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $Jayant) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html">
<html">
<head>
<title>Admin login</title>
<link href="../favicon.png" rel="icon" type="image/png" />
<style type="text/css">
body {
	background-image: url(file:///C|/xampp/htdocs/images/7.jpg);
	background-repeat: repeat;
}
</style>
<link href="../css/Accessible_Design.css" rel="stylesheet" type="text/css" />
<link href="file:///C|/xampp/htdocs/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="file:///C|/xampp/htdocs/SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="file:///C|/xampp/htdocs/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="file:///C|/xampp/htdocs/SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
</head>
<body>
<table>
<tr>
        <td valign="top" width="8%"><p align="left"><img
        src="../image/0.jpg" width="200" height="200" ></p>
       </td><td> <h5 align="left" valign="top">
Modern World Corporation</h5></td>
  </tr></table>

<form ACTION="<?php echo $loginFormAction; ?>" method='POST'>
<table width='400'border='0px solid #0001' align='center' background="../image/8.jpg" id="rcorners2">
  <tr>
    <td colspan='5' align='center' id="rcorners1"><H3 style="color: 00ffff; background: 00fffff;">Admin Login</H3></td>
	</tr>
<tr> 
<td align='center' style="color:red" id="rcorners3">Username:</td><td  id="rcorners1">
<span id="sprytextfield1">
<label for="userName"></label>
<input type="text" name="userName" id="userName" required />

 </td>
</tr>
<tr>
  <td align='center' style="color:red;" id="rcorners3">Password:</td><td  id="rcorners1"> <span id="sprypassword1">
    <label for="pass"></label>
    <input type="password" name="pass" id="pass" required/>
    </td>
</tr>
  <tr align='center'>
  <td colspan='5' align='center' id="rcorners1"><button class="button button"style="vertical-align:middle"><span>Login </span></button></td>
  </tr>
  </table>
</form>
<p style="color:red;"<b>Note:</b>The character in a passward filed are masked</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html><?php
mysql_free_result($Recordset1);
?>
