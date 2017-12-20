<?php require_once('../../../../private/initialize.php');?>

<?php
require_login();
$id = $_GET['id'] ?? '1';

$round_info = find_round_by_id($id); // get the round #
$questions = find_all_questions_in_round($id); // get all the questions from the round
$battle_rounds = find_rounds_by_battleid($_SESSION['battle_id']);
$battle_info = find_battle_by_id($_SESSION['battle_id']);
$_SESSION['current_round'] = $id;
$battle_owner = $battle_info['owner'];


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
        <dt>Round ID:</dt>
        <dd><?php echo h($_SESSION['current_round']); ?></dd>
      </dl>
      <dl>
        <dt>Battle Name:</dt>
        <dd><?php echo h($battle_info['name']); ?></dd>
      </dl>
      <dl>
        <dt>Round Name:</dt>
        <dd><?php echo h($round_info['round_name']); ?></dd>
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


      <h2>Questions in this round</h2>

 <?php         $x = 0;  ?>
 <table class="list">
   <tr>
     <th>ID</th>
     <th>Title</th>
     <th>Author First</th>
     <th>Author Last</th>
     <th>&nbsp;</th>
     <?php if ($_SESSION['question.owner'] == $battle_info['owner']) { ?>
    <th>&nbsp;</th>
    <?php } ?>

   </tr>
<?php
while($question_data = mysqli_fetch_assoc($questions)) {
        $question_detail = find_question_by_id($question_data['question_id']);
        $class = ($x%2 == 0)? '#ffffff': '#c4c4c4'; ?>
        <tr bgcolor='<?php echo $class; ?>'>
        <td rowspan="3"><?php echo $question_detail['id']; ?></td>
        <td><?php echo $question_detail['book_title']; ?></td>
        <td><?php echo $question_detail['author_first_name']; ?></td>
        <td><?php echo $question_detail['author_last_name']; ?></td>
        <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/show_round_question.php?id=' . h(u($question_detail['id'])));
        ?>">View</a></td>
          <?php if ($_SESSION['question.owner'] == $battle_info['owner']) { ?>
        <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/add_questions/remove_question_from_battle.php?id=' . h(u($question_data['id'])));
        ?>">Remove</a></td>
        <?php } ?>


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
<?php
  if ($_SESSION['question.owner'] == $battle_info['owner']) { ?>
<h2><a class="back-link" href="<?php echo url_for('/dashboard/battle/round/add_questions/search.php'); ?>">Add questions to round</a></h2><br/>
<?php } ?>

<a class="back-link" href="<?php echo url_for('/dashboard/battle/show.php?id=' . $_SESSION['battle_id']); ?>">&laquo; Back to Battle Page</a><br/>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
