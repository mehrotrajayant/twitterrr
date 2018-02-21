<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_coon1 = "localhost";
$database_coon1 = "test";
$username_coon1 = "root";
$password_coon1 = "Yadav@12345*#";
$coon1 = mysql_pconnect($hostname_coon1, $username_coon1, $password_coon1) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
