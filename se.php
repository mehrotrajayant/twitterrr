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
if (isset ($_POST["search"]))
{
	$theValue = mysql_real_escape_string($_POST["theValue"]);
	$query_Recordset1 = "SELECT * FROM registration WHERE ID_no= '$theValue' OR Reg = '$theValue'";
	mysql_select_db($database_Jayant, $Jayant);
//$query_Recordset1 = "SELECT * FROM registration where ID_no = '$theValue' OR Reg = '$theValue' ";
$Recordset1 = mysql_query($query_Recordset1, $Jayant) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

	
}else{
	echo 'Please enter valid pid';}


	





	
mysql_close();

  
  

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
      <li><a href="ud.php">Update and Delete</a></li>
      <li><a href="#">Tweet Search </a></li>
      <li><a href="<?php echo $logoutAction ?>">Log out</a></li>
     
    </ul>
    <p> The above links demonstrate a basic navigational structure using an unordered list styled with CSS. Use this as a starting point and modify the properties to produce your own unique look. If you require flyout menus, create your own using a Spry menu, a menu widget from Adobe's Exchange or a variety of other javascript or CSS solutions.</p>
    <p>If you would like the navigation along the top, simply move the ul.nav to the top of the page and recreate the styling.</p>
    <!-- end .sidebar1 --></div>
<div class="content">
  <div id="Sign-Up" align="center">
   <div align="left">
<form name="theValue" method="POST" action="se.php"  min='1000' max='2000' required><table align="center"><tr><td><table align="left" background="../images/8.jpg" bordercolorlight="#FF0000" border="5"><tr><td colspan="5"><h5>Enter P.id OR Registration No</h5></td></tr>
<tr><td colspan="5"><input id="Text2" type="text"  name="theValue" placeholder="Enter P.ID/Reg No."value='' min='1000' max='2000' required></td></tr><tr><td>
<button  class=" button"type=" Submit" name="search" value="Search..."><span>Search Detail</span></button></td><td> <a href="Userreg.PHP">Back</a></td></tr></table>
  </form> </fieldset></td><td>
<div align="right"><form >
<table  style="color:purple;border-style:groove; height:150px;width:350px" background="3.jpg" align="right">
        <tr>
           
            <td style="font-family:Copperplate Gothic Bold">&nbsp;</td>
        </tr>
        <tr>
            <td style="color:red;background-color:aqua;" class="auto-style3">P.ID</td>
            <td class="auto-style4">
              <input id="Text5" type="text" value='<?php echo $row_Recordset1['ID_no']; ?>'/> </td>
       </tr> 
            <td style="color:red;background-color:aqua;" class="auto-style3">Reg.No</td>
            <td class="auto-style4">
              <input id="Text1" type="text" value='<?php echo $row_Recordset1['Reg']; ?>'/></td>
        </tr>
        <tr>
          <td style="color:red;background-color:aqua;" class="auto-style3">Name</td>
            <td class="auto-style4">
              <input id="Text2" type="text" value='<?php echo $row_Recordset1['name']; ?>'/></td>
        </tr>
        <tr>
             <td style="color:red;background-color:aqua;" class="auto-style3"></td>
            
        </tr>
                 
        <tr>
             <td style="color:red;background-color:aqua;" class="auto-style3">Contact Number:</td>
            <td class="auto-style4">
              <input id="Text10" type="text" value='<?php echo $row_Recordset1['Mobile_no']; ?>'/></td>
        </tr>
        <tr>
            <td style="color:red;background-color:aqua;" class="auto-style3">Email Address:</td>
            <td class="auto-style4">
              <input id="Text11" type="text" value='<?php echo $row_Recordset1['email']; ?>'/></td>
        </tr>
      <tr>
            <td style="color:red;background-color:aqua;" class="auto-style3">Registration Time:</td>
            <td class="auto-style4">
              <input id="Text11" type="text" value='<?php echo $row_Recordset1['time']; ?>'/></td>
        </tr>  
        
    <tr>
            <td></td>
        </tr>
</table>
    </form>
  
   
  </div> 
   </div>
   
    <!-- end .content --></div>
  <div class="footer">
    <p align="center">This Project for the testing purposes</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_close();
?>
