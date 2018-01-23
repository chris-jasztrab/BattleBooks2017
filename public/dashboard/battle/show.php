<?php require_once('../../../private/initialize.php');?>
<?php require_login();?>
<?php
$id = $_GET['id'] ?? '1';

$battle = find_battle_by_id($id);
$rounds_in_battle = find_rounds_by_battleid($id);
$_SESSION['battle_id'] = $battle['id'];
?>

<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Battle'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/index.php'); ?>">&laquo; Back to Dashboard</a><br/>


  <div class="battle show">

    <h1>Title: <?php echo h($battle['name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Battle ID:</dt>
        <dd><?php echo h($_SESSION['battle_id']); ?></dd>
      </dl>
      <dl>
        <dt>Battle Name:</dt>
        <dd><?php echo h($battle['name']); ?></dd>
      </dl>
        <dl>
        <dt>Battle Level:</dt>
        <?php $level_array = explode(',', $battle['level']); ?>
          <dd> <?php
          foreach ($level_array as $level => $level_value) {
              $levelname = find_level_by_id($level_value);
              echo h($levelname['level_name']);
              echo "&nbsp&nbsp;";
          }
            ?></dd>
      </dl>
      <dl>
        <dt>Preamble:</dt>
        <dd><?php echo h($battle['preamble']); ?></dd>
      </dl>
      <dl>
        <dt>Owner:</dt>
        <?php $owner_name = find_location_by_id($battle['owner']); ?>

        <dd><?php echo h($owner_name['location_name']); ?></dd>
      </dl>

      <dl>
        <dt>Notes:</dt>
        <dd><?php echo h($battle['notes']); ?></dd>
      </dl>

      <h2>Categories Currently in this Battle</h2>
      <table class="list">
        <tr>
          <th>ID</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>Category</th>
          <th>Preamble</th>
          <th>Notes</th>
          <th># Questions</th>
          <th>&nbsp;</th>
          <?php
            if ($_SESSION['question.owner'] == $battle['owner']) {
                ?>
          <th>&nbsp;</th>

        <?php
            } ?>




        </tr>
        </br/>
        <?php
          $x = 0;
          $current_round = 1;
          $number_of_rounds = mysqli_num_rows($rounds_in_battle);
         ?>
      <?php while ($roundlist = mysqli_fetch_assoc($rounds_in_battle)) {
             ?>
        <?php

          $numquestions = get_number_of_questions_in_round($roundlist['id']);

             $class = ($x%2 == 0)? '#ffffff': '#c4c4c4'; ?><dd>

            <?php
              if (is_blank($roundlist['round_preamble'])) {
                  $roundlist['round_preamble'] = 'None';
              }
             if (is_blank($roundlist['round_notes'])) {
                 $roundlist['round_notes'] = 'None';
             } ?>

        <tr bgcolor='<?php echo $class; ?>'>
          <td><?php echo h($roundlist['id']); ?></td>
          <td>
            <?php if ($current_round != 1) {
                 ?>
            <a class="action" href="<?php echo url_for('/dashboard/battle/round/move_round_up.php?position=' . h(u($roundlist['position'])) . "&battle_id=" . $_SESSION['battle_id']); ?>"><img border="0" width="33" height="46" src="<?php echo url_for('/images/arrow_up.png'); ?>"</a>
        <?php
             } ?></td>

        <td>
        <?php  if ($current_round != $number_of_rounds) {
                 ?>
          <a class="action" href="<?php echo url_for('/dashboard/battle/round/move_round_down.php?position=' . h(u($roundlist['position'])) . "&battle_id=" . $_SESSION['battle_id']); ?>"><img border="0" width="33" height="46" src="<?php echo url_for('/images/arrow_down.png'); ?>"</a>
      <?php
             } ?></td>
          <td><?php echo h($roundlist['round_name']); ?></td>
          <td><?php echo h($roundlist['round_preamble']); ?></td>
          <td><?php echo h($roundlist['round_notes']); ?></td>

          <td><?php echo $numquestions; // shows the # of questions in the round?></td>



          <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/show.php?id=' . h(u($roundlist['id']))); ?>">View
          <?php
            if ($_SESSION['question.owner'] == $battle['owner']) {
                ?>/Add Questions<?php
            } ?>
        </a></td>
          <?php
            if ($_SESSION['question.owner'] == $battle['owner']) {
                ?>
          <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/delete.php?id=' . h(u($roundlist['id']))); ?>">Delete Category</a></td>
      <?php
            } ?>

        </tr>


      <?php
      $current_round = $current_round + 1;
             $x = $x + 1;
         } ?>
      </table>


    </div>

</div>
<br />
<br />
<?php
if ($_SESSION['question.owner'] == $battle['owner']) {
             ?>
<h2><a class="back-link" href="<?php echo url_for('/dashboard/battle/round/new.php'); ?>">Add Category to battle</a></h2><br/>
<?php
         } ?>
<h2><a class="back-link" href="<?php echo url_for('/dashboard/battle/create_author_list.php?id=' . h(u($id))); ?>">Create Author List</a></h2><br/>
<h2><a class="back-link" href="<?php echo url_for('/dashboard/battle/quick_review.php?id=' . h(u($id))); ?>">Quick Review</a></h2><br/>
<h2><a class="back-link" href="<?php echo url_for('/dashboard/battle/print_battle.php?id=' . h(u($id))); ?>">Print this Battle</a></h2><br/>
<h2><a class="back-link" href="<?php echo url_for('/dashboard/battle/print_word_battle.php?id=' . h(u($id))); ?>">Download MS Word Version of Battle</a></h2><br/>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
