<?
require_once('config.php');
mysql_connect($db, $dbuser, $dbpswd) or die('Нет возможности подключится к базе данных');
mysql_select_db($dbname);

$poll = $_GET['poll'];
if(!is_numeric($poll)) die('Номер голования указан не венрно');


$q = "SELECT polls.question, answers.answer, answers.answer_id FROM polls,answers WHERE polls.id = $poll AND answers.id = polls.id";
$r = mysql_query($q);
if (mysql_num_rows($r) == 0) {
	die('Ошибка');
}

if($_COOKIE['vote_'.$poll]){
	header("Location:poll_result.php?poll=$poll");
	exit;
}

//Пользователь не голосовал поэтому выводим информацию

$question = '';

while ($row = mysql_fetch_assoc($r)) {
	$question = $row['question'];
	$questions .= '<li><input name="answer" type="radio" value="'.$row['answer_id'].'">'.$row['answer'].'</li>';
}
echo "<h1>$question</h1>";
echo "<form action= 'poll_process.php' method='post'>";
echo "<p><ul style='list-style:nome;'>".$questions."</ul>";
echo "<input name='poll' type='hidden' value= $poll>
<input type='submit' value='Голосовать'>
</form>";
?>