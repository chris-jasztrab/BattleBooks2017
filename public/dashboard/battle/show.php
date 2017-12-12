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
          <th>&nbsp;</th>




        </tr>
        </br/>
        <?php
          $x = 0;
         ?>
      <?php while($roundlist = mysqli_fetch_assoc($rounds_in_battle)) { ?>
        <?php

          $numquestions = explode(',',$roundlist['round_questions']);
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
          <td><?php echo $q_count; // shows the # of questions in the round ?></td>



          <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/show.php?id=' . h(u($roundlist['id'])));
          ?>">View/Add Questions</a></td>
          <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/delete.php?id=' . h(u($roundlist['id'])));
          ?>">Delete Round</a></td>


        </tr>


      <?php
      $x = $x + 1;
      } ?>
      </table>


    </div>

</div>
<br />
<br />
<h2><a class="back-link" href="<?php echo url_for('/dashboard/battle/round/new.php'); ?>">Add round to battle</a></h2><br/>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
