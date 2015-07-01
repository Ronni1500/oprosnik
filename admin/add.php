<?
require_once('config.php');
if (isset($_GET['btn_add'])) {
	$text = $_GET['question'];
	if($text == '') {
		die('Введен пустой вопрос!');
		exit;
	}
	$q = "INSERT INTO polls (question) VALUES ($text)";
	$r = mysql_query("INSERT INTO polls (question) VALUES ('$text')");
	if($r) {
		echo 'Ваш вопрос успешно добавлен.';
		 @header("Location:".$_SERVER['HTTP_REFFERER']);
	}
	else echo 'Ваш вопрос по каким то причинам не был добавлен.Попробуйте операцию заново.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Добавление опросов</title>
</head>
<body>
	<form action="#" method="get">
		<input type="text" name="question"/>
		<input type="submit" name="btn_add" value="Добавить"/>
	</form>
</body>
</html>