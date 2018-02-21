<?php require_once('../Connections/Jayant.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "welcome.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "welcome.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

if ((isset($_GET['ID_no'])) && ($_GET['ID_no'] != "")) {
  $deleteSQL = sprintf("DELETE FROM registration WHERE ID_no=%s",
                       GetSQLValueString($_GET['ID_no'], "int"));

  mysql_select_db($database_Jayant, $Jayant);
  $Result1 = mysql_query($deleteSQL, $Jayant) or die(mysql_error());

  $deleteGoTo = "login1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_Jayant, $Jayant);
$query_Recordset1 = "SELECT * FROM registration";
$Recordset1 = mysql_query($query_Recordset1, $Jayant) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="favicon.png" rel="icon" type="image/png" />
<title>Admin page</title>

<style type="text/css">
<!--

</style>
<link href="../CSS/j1.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">
  <div class="header"><a href="#"><img src="../image/0.jpg" alt="Insert Logo Here" name="Insert_logo" width="180" height="90" id="Insert_logo" style="background-color:#00F; display:block;" /></a> 
    <!-- end .header --></div>
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="login1.php">Registration</a></li>
      <li><a href="se.php">Search Detail</a></li>
      <li><a href="ud.php">Update</a></li>
		<li><a href="de.php">Delete</a></li>
      <li><a href="#">Tweet Search </a></li>
      <li><a href="<?php echo $logoutAction ?>">Log out</a></li>
      
    </ul>
    <p> The above links demonstrate a basic navigational structure using an unordered list styled with CSS. Use this as a starting point and modify the properties to produce your own unique look. If you require flyout menus, create your own using a Spry menu, a menu widget from Adobe's Exchange or a variety of other javascript or CSS solutions.</p>
    <p>If you would like the navigation along the top, simply move the ul.nav to the top of the page and recreate the styling.</p>
    <!-- end .sidebar1 --></div>
  <div class="content">
   <div id="Sign-Up" align="center">
 <div align="left">
<form action="" required><table align="center"><tr><td><table align="left" background="../images/8.jpg" bordercolorlight="#FF0000" border="5"><tr><td colspan="5"><h5>Enter P.id OR Registration No</h5></td></tr>
<tr><td colspan="5"><input type="number"  name="ID_no" placeholder="Enter P.ID/Reg No."value='' required></td></tr><tr><td>
<button  class=" button"type=" Submit" onClick="alert('Are Sure want to delete')"><span>Delete Detail</span></button></td><td> <a href="login1.PHP">Back</a></td></tr></table>
  </form> </fieldset></td>
 
</div>

</form>
   
    </table>
    </fieldset> 
    </div>
    <!-- end .content --></div>
  <div class="footer">
    <p align="center">This Project for the testing purposes</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
<a href="<?php echo $logoutAction ?>">Log out</a>>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
