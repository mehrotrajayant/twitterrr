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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE registration SET Reg=%s, name=%s, pass=%s, email=%s, Mobile_no=%s WHERE ID_no=%s",
                       GetSQLValueString($_POST['Reg'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['pass'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['Mobile_no'], "bigint"),
                       GetSQLValueString($_POST['Pid'], "int"));

  mysql_select_db($database_Jayant, $Jayant);
  $Result1 = mysql_query($updateSQL, $Jayant) or die(mysql_error());

  $updateGoTo = "ud.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_GET['ID_no'])) && ($_GET['ID_no'] == "theValue")) {
  $deleteSQL = sprintf("DELETE FROM registration WHERE ID_no=%s",
                       GetSQLValueString($_GET['ID_no'], "int"));

  mysql_select_db($database_Jayant, $Jayant);
  $Result1 = mysql_query($deleteSQL, $Jayant) or die(mysql_error());

  $deleteGoTo = "ud.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
if (isset ($_POST["search"]))
{
	$theValue = mysql_real_escape_string($_POST["theValue"]);
	$query_Recordset1 = "SELECT * FROM registration WHERE ID_no = '$theValue' OR Reg = '$theValue'";
	
}else{
	echo 'Please enter valid pid';}
mysql_select_db($database_Jayant, $Jayant);
$query_Recordset1 = "SELECT * FROM registration WHERE ID_no = '$theValue' OR Reg = '$theValue'";
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
    
<!-- end .sidebar1 --></div>
  <div class="content">
   <div id="Sign-Up" align="center"><a href="<?php echo $logoutAction ?>">Log out</a>
   
   <div align="left">
  <div align="left">
  <form name="theValue" method="POST" action="ud.php"  min='1000' max='2000' required><table align="center"><tr><td><table align="left" background="../images/8.jpg" bordercolorlight="#FF0000" border="5"><tr><td colspan="5"><h5>Enter P.id OR Registration No</h5></td></tr>
  <tr><td colspan="5"><input id="Text2" type="text"  name="theValue" placeholder="Enter P.ID/Reg No."value='' min='1000' max='2000' required></td></tr><tr><td>
  <button  class=" button"type=" Submit" name="search" value="Search..."><span>Search Detail</span></button></td><td> <a href="Userreg.PHP">Back</a></td></tr></table>
    </form> </fieldset></td>
    
  </div>
     
  </form>
     
  <div align="right">
     <fieldset style="width:60%" >
       <legend><h5>Search Details</h5></legend> 
       <table border="0">
         <tr> 
           <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
             <table align="center">
               <tr valign="baseline">
                 <td nowrap align="right">Pid:</td>
                 <td><?php echo $row_Recordset1['ID_no']; ?></td>
                </tr>
               <tr valign="baseline">
                 <td nowrap align="right">Reg:</td>
                 <td><input type="text" name="Reg" value="<?php echo htmlentities($row_Recordset1['Reg'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                </tr>
               <tr valign="baseline">
                 <td nowrap align="right">Name:</td>
                 <td><input type="text" name="name" value="<?php echo htmlentities($row_Recordset1['name'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                </tr>
               
               <tr valign="baseline">
                 <td nowrap align="right">Email:</td>
                 <td><input type="text" name="email" value="<?php echo htmlentities($row_Recordset1['email'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                </tr>
               <tr valign="baseline">
                 <td nowrap align="right">Mobile_no:</td>
                 <td><input type="text" name="Mobile_no" value="<?php echo htmlentities($row_Recordset1['Mobile_no'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                </tr>
               <tr valign="baseline">
                 <td nowrap align="right">&nbsp;</td>
                 <td><input type="submit" value="Update record"></td>
                </tr>
              </table>
             <input type="hidden" name="MM_update" value="form1">
             <input type="hidden" name="Pid" value="<?php echo $row_Recordset1['ID_no']; ?>">
            </form>
           <p>&nbsp;</p>
  </div>
        </table>
       <input type="hidden" name="MM_insert" value="form">
       </form>
       </table>
      </fieldset> 
   </div>
    <!-- end .content --></div>
  <div class="footer">
    <p align="center">This Project for the testing purposes</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
   <?php echo $row_Recordset1['ID_no']; ?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
