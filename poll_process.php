<?
require_once('config.php');
mysql_connect($db, $dbuser, $dbpswd) or die('Нет возможности подключится к базе данных');
mysql_select_db($dbname);

$poll = $_POST['poll'];
if(!is_numeric($poll)) die('Номер голования указан не венрно');

$answer = $_POST['answer'];
if(!is_numeric($answer)) die('Номер ответа указан не венрно');

$q = "SELECT answers.answer_id FROM polls,answers WHERE polls.id = answers.id AND polls.id = $poll AND answers.answer_id = $answer";
$r = mysql_query($q);
if (mysql_num_rows($r) == 0) {
	die('Неправильный номер голосования');
}
if(!$_COOKIE['vote_'.$poll]){
	$q ="INSERT INTO votes (id,answer_id) VALUES ($poll,$answer)";
	$r = mysql_query($q);
	setcookie("vote_$poll", "1", time() + (3600*24*7));
}
$poll = (int)$poll;

header("Location:poll_result.php?poll=".$poll);
?>