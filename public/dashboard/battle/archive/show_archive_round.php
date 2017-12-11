<?php require_once('../../../../private/initialize.php');?>

<?php
require_login();
$id = $_GET['id'] ?? '1';

$round_info = find_round_by_id($id);
$questions = $round_info['round_questions'];
$battle_rounds = find_rounds_by_battleid($_SESSION['battle_id']);
$battle_info = find_battle_by_id($_SESSION['battle_id']);
$_SESSION['current_round'] = $id;

?>

<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Battle'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/index.php'); ?>">&laquo; Back to Dashboard</a><br/>


  <div class="battle show">

    <h1>Title: <?php echo h($battle_info['name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Battle ID:</dt>
        <dd><?php echo h($_SESSION['battle_id']); ?></dd>
      </dl>
      <dl>
        <dt>Battle Name:</dt>
        <dd><?php echo h($battle_info['name']); ?></dd>
      </dl>
        <dl>
        <dt>Battle Level:</dt>
        <?php $level_array = explode(',',$battle_info['level']); ?>
          <dd> <?php
          foreach($level_array as $level => $question_value)
          {
            $question = find_level_by_id($question_value);
            echo $question['level_name'];
            echo "&nbsp&nbsp;";
          }
            ?></dd>
      </dl>

<?php
if (is_blank($questions)) {
    echo "<H2>There are no questions in the round yet.  Please add some.</H2>";
} else {

 ?>
      <h2>Questions in this round</h2>

    <?php $question_array = explode(',',$questions); ?>
 <?php         $x = 0;  ?>
 <table class="list">
   <tr>
     <th>ID</th>
     <th>Title</th>
     <th>Author First</th>
     <th>Author Last</th>
     <th>&nbsp;</th>

   </tr>
<?php
    foreach($question_array as $question => $question_value)
    {
     $question_detail = find_question_by_id($question_value);
  ?>

      <?php
        $class = ($x%2 == 0)? '#ffffff': '#c4c4c4'; ?>
        <tr bgcolor='<?php echo $class; ?>'>
        <td rowspan="3"><?php echo $question_detail['id']; ?></td>
        <td><?php echo $question_detail['book_title']; ?></td>
        <td><?php echo $question_detail['author_first_name']; ?></td>
        <td><?php echo $question_detail['author_last_name']; ?></td>
        <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/show_round_question.php?id=' . h(u($question_detail['id'])));
        ?>">View</a></td>


      </tr>
      <tr>
      <td bgcolor='<?php echo $class; ?>' colspan="6"><?php echo "Q. " . $question_detail['question_text']; ?></td>
      </tr>
      <tr>
      <td bgcolor='<?php echo $class; ?>' colspan="6"><?php echo "A. " . $question_detail['question_answer']; ?></td>
      </tr>

    <?php
    $x = $x + 1;
    } ?>


    </table>


    </div>

</div>
<br />
<br />
<?php } ?>

<a class="back-link" href="<?php echo url_for('/dashboard/battle/archive/show_archived.php?id=' . $_SESSION['battle_id']); ?>">&laquo; Back to Archive Battle Page</a><br/>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
