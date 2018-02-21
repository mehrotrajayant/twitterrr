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
	
  $logoutGoTo = "login1.php";
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="favicon.png" rel="icon" type="image/png" />
<title>Admin page</title>
<script>
	function ImagePreview() { 
 var PreviewIMG = document.getElementById('PreviewPicture'); 
 var UploadFile    =  document.getElementById('fileToUpload').files[0]; 
 var ReaderObj  =  new FileReader(); 
 ReaderObj.onloadend = function () { 
    PreviewIMG.style.backgroundImage  = "url("+ ReaderObj.result+")";
  } 
 if (UploadFile) { 
    ReaderObj.readAsDataURL(UploadFile);
  } else { 
     PreviewIMG.style.backgroundImage  = "";
  } 
}
function Validate()
{
	var passw = document.getElementById('pass1').value;
	var passwo = document.getElementById('cpass1').value;
	if (passw != passwo)
	{
		alert('Password and Confirm are not mached');
		return false;
		
	}
	else{
	
	return true;
	}
	
}

</script>
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
 <fieldset style="width:45%" >
 <legend><h5>Registration Form</h5></legend> 
 <table border="0">
  <tr> 
   <form method="POST" name="form" onReset="alert('All the Data in the form will be reset')" onSubmit="alert('Are you sure to submit the details')" action="l2.php" enctype="multipart/form-data">
   <div class="img1">
	<div id="PreviewPicture"></div><br><input id="fileToUpload" type="file" name="fileToUpload" class="image" onchange="ImagePreview()" align="middle" required /> </div>
   
 <tr><td>Reg.No</td><td> <input type="number" name="Reg" required></td></tr> 
 <tr><td>Name</td><td> <input type="text" name="name" required></td></tr>
<tr><td>Password</td><td> <input type="password" name="pass" id="pass1" required></td></tr>
  <tr><td>Confirm password</td><td> <input type="password" name="cpass" id="cpass1" required></td></tr>
  <tr> <td>Email</td><td> <input type="email" name="email"></td> </tr> 
  <tr> <td>Mobile No</td><td> <input type="number" name="Mobile_no" min="7111111111" max="9999999999" required></td></tr>
   <tr> <td align="center" colspan="5"><BUTTON class="button" type="reset"><span>RESET</span></BUTTON></td> </tr>
   <tr> <td align="center" colspan="5"><BUTTON class="button" onClick="return Validate()"  name="add" type="submit" id="add" value="Add Testimonial"><a herf=1.php><span>REGISTER</span></BUTTON></td> </tr>
  
    
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
