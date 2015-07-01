<?
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Редактор голосования</title>
</head>
<body>
<?
if(isset($_POST['btn_admin'])){
	$login = $_POST['login'];
	$pswd = $_POST['password'];

if ($login == NAME && $pswd == PSWD) {
	echo '<ul>
			<li><a href="add.php">Добавить опрос</a></li>
			<li><a href="dell.php">Удалить опрос</a></li>
			<li><a href="upgrade.php">Редактировать опрос</a></li>
		</ul>';
}
elseif ($login != NAME && $pswd != PSWD) {
	die('Ваш логин и пароль не подходят для администрирования!');
}}
else{
	echo '<form action="index.php" method="post">
	<p>Ввеите логин:
		<input type="text" name="login">
	</p>
	<p>Введите пароль:
		<input type="text" name="password">
	</p>
	<input type="submit" value="Войти" name="btn_admin" />
</form>';
}
?>

</body>
</html>