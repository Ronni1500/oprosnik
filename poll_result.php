<?
require_once('config.php');
mysql_connect($db, $dbuser, $dbpswd) or die('Нет возможности подключится к базе данных');
mysql_select_db($dbname);
	
$poll = (int)$_GET['poll'];

if(!is_numeric($poll)) die('Номер голования указан не венрно');
$q = "SELECT question FROM polls WHERE id = $poll";
$r = mysql_query($q);
if (mysql_num_rows($r) != 1) {
	die('Ошибка');
}
$row = mysql_fetch_assoc($r);
$question = $row['question'];

$q = 'SELECT count(*) AS total_votes FROM votes WHERE votes.id = '.$poll;
$r = mysql_query($q);
$row = mysql_fetch_assoc($r);
$total_votes = $row['total_votes'];

$q = "SELECT answers.answer, answers.answer_id, count(votes.answer_id) as num_votes FROM answers
 LEFT JOIN votes ON votes.id = answers.id AND votes.answer_id = answers.answer_id WHERE answers.id = $poll  
 GROUP BY answers.answer_id ORDER BY num_votes DESC, answers.answer ASC";
 $r = mysql_query($q);





 echo "<html><head><title>$question</title></head><body>";
 echo "<ul style='list-style:none;font-size:12px;'>";
 echo "<li style='font-weight:bold; padding-bottom:10px;'>";
 echo "</li>";
while ($row = mysql_fetch_assoc($r)) {
	if ($total_votes !=0) {
		$p = sprintf("%.2f", 100.0 * $row['num_votes'] / $total_votes);
	}
	else{
		$p = "0";
	}
	$width = strval(1 + intval($p) ."px");
	echo "<li style='clear:left;'>";
	echo $row['answer'];
	echo "</li>";
	echo "<li style='clear:left;padding-bottom:7px;'>";
	echo "<div style='width:$width; height:15px; background:black; margin-right:5px; float:left;'></div>$p";
	echo "</li>";

}
echo "<li style='clear:left;'>";
echo "Всего проголосовало: $total_votes";
echo "</li>";
echo "</ul>";
echo "</body></html>";
?>