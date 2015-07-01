<?
$db = 'localhost';
$dbname = 'opros';
$dbuser = 'root';
$dbpswd = '';

define('NAME', 'admin');
define('PSWD', 'admin');
$desc = 'Голосование от сайта';
$info = '<p>&copy Роман Царьков';
mysql_connect($db, $dbuser, $dbpswd);
mysql_select_db($dbname);
?>