<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Jayant = "localhost";
$database_Jayant = "jayant";
$username_Jayant = "root";
$password_Jayant = "Yadav@12345*#";
$Jayant = mysql_pconnect($hostname_Jayant, $username_Jayant, $password_Jayant) or trigger_error(mysql_error(),E_USER_ERROR); 
?>