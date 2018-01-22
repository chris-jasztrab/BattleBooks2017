<?php require_once('../../../../private/initialize.php');?>

<?php
require_login();
$position = $_GET['position'];
$battle_id = $_GET['battle_id'];

$result = move_round_up($battle_id, $position);
//if($result === true) {
  redirect_to(url_for('/dashboard/battle/show.php?id=' . $battle_id));
//} else {
//$errors = $result;
//var_dump($errors);
//}

?>
