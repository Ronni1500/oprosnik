<?

require_once('config.php');
$res = '';
$r = mysql_query("SELECT * FROM polls");
$row = mysql_fetch_assoc($r);
do{
	$res .= '<p>'.$row['question'].'<input type="radio" name="question" value="'.$row['id'].'"/></p>';
}
while ($row = mysql_fetch_assoc($r));


if (isset($_GET['btn_dell'])) {
	$id = $_GET['question'];
	if($id == '') {
		die('Вопрос для удаления не выбран');
		exit;
	}
	$q = "DELETE FROM polls WHERE id = '$id'";
	$r = mysql_query($q);
	if($r) {
		echo 'Ваш вопрос успешно удален.';
		 @header("Location:".$_SERVER['HTTP_REFFERER']);
	}
	else echo 'Ваш вопрос по каким то причинам не был удален.Попробуйте операцию заново.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Удаление опросов</title>
</head>
<body>
	<form action="#" method="get">
		<?=$res;?>
		<input type="submit" name="btn_dell" value="Удалить"/>
	</form>
</body>
</html>