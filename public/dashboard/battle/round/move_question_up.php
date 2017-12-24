<?php require_once('../../../../private/initialize.php');?>

<?php
require_login();
$position = $_GET['position'];
$round = $_GET['round'];

$result = move_question_up($round, $position);
//if($result === true) {
  redirect_to(url_for('/dashboard/battle/round/show.php?id=' . $round));
//} else {
//$errors = $result;
//var_dump($errors);
//}

?>
