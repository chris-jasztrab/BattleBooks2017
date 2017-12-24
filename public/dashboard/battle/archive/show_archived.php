<?php require_once('../../../../private/initialize.php');?>

<?php
require_login();
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
    <?php $page_title = 'Archived Battle View'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/archived_list.php'); ?>">&laquo; Back to Archived Battles</a><br/>


  <div class="battle show">
    <p style="color:#ff471a; font-weight:bold; font-size:25px">
      ARCHIVED BATTLE
    </p>
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
        <?php $level_array = explode(',',$battle['level']); ?>
          <dd> <?php
          foreach($level_array as $level => $level_value)
          {
            $levelname = find_level_by_id($level_value);
            echo $levelname['level_name'];
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

      <h2>Rounds Currently in this Battle</h2>
      <table class="list">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Notes</th>
          <th>Preamble</th>
          <th># Questions</th>
          <th>&nbsp;</th>




        </tr>
        </br/>
        <?php
          $x = 0;
         ?>
      <?php while($roundlist = mysqli_fetch_assoc($rounds_in_battle)) { ?>
        <?php

          $numquestions = explode(',',$roundlist['round_questions']);
          $r_numquestions = get_number_of_questions_in_round($roundlist['id']);
          $q_count = 0;
          foreach($numquestions as $get_num_quest => $numquestion_value)
          {
            if(!empty($numquestion_value))
            $q_count = $q_count + 1;
          }
          $class = ($x%2 == 0)? '#ffffff': '#c4c4c4'; ?><dd>

        <tr bgcolor='<?php echo $class; ?>'>
          <td><?php echo $roundlist['id']; ?></td>
          <td><?php echo $roundlist['round_name']; ?></td>
          <td><?php echo $roundlist['round_notes']; ?></td>
          <td><?php echo $roundlist['round_preamble']; ?></td>
          <td><?php echo $r_numquestions; ?></td>

          <td><a class="action" href="<?php echo url_for('/dashboard/battle/archive/show_archive_round_question.php?id=' . h(u($roundlist['id'])));
          ?>">View Questions</a></td>



        </tr>


      <?php
      $x = $x + 1;
      } ?>
      </table>


    </div>


</div>
<br />
<br />

</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
