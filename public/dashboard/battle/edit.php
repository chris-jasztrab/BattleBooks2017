<?php

require_once('../../../private/initialize.php');

require_login();


if(is_post_request())
{

  $battle = [];
  $battle['id'] = $_SESSION['battle.id'];
  $battle['name'] = $_POST['battle_name'];
  $battle['battle_preamble'] = $_POST['battle_preamble'];
  $battle['notes'] = $_POST['notes'];
  $battle['level'] = $_POST['battle_level'];

  $result = update_battle($battle);
  if($result === true)
  {

    redirect_to(url_for('/dashboard/battle/show.php?id=' . $_SESSION['battle.id']));
  }
  else
  {
    $errors = $result;
    //var_dump($errors);
  }
}

  else {

    if(!isset($_GET['id'])) {
      redirect_to(url_for('/dashboard/index.php'));
    }

    $_SESSION['battle.id'] = $_GET['id'];


  $battle = find_battle_by_id($_SESSION['battle.id']);
  }

  $level_set = find_all_levels();
  $level_count = mysqli_num_rows($level_set);
  mysqli_free_result($level_set);

?>
<?php $page_title = 'Edit Battle'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>


<div id="page">

  <div id="content">

  <?php $page_title = 'Edit Battle'; ?>


  <div class="battle edit">
    <?php $location_info = find_location_by_id($_SESSION['question.owner']);
    $location_name = $location_info['location_name'];
    ?>
    <a class="back-link" href="<?php echo url_for('/dashboard/index.php'); ?>">&laquo; Back to Dashboard</a><br/>
    <h1>Edit Battle for <?php echo $location_name;?></h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/dashboard/battle/edit.php')?>" method="post">

      <dl>
        <dt>Battle Name:</dt>
        <dd><input type="text" name="battle_name" value="<?php echo $battle['name'];?>" /></dd>
      </dl>
      <dl>
        <dt>Battle Level:</dt>
        <dd>
              <select name="battle_level">
              <?php $level_list = find_all_levels(); ?>
              <?php while($levlist = mysqli_fetch_assoc($level_list)) {
                  echo "<option value=\"" . h($levlist['id']) . "\"";
                  echo ">" . h($levlist['level_name']) . "</option>";
                }
                mysqli_free_result($level_list);
              ?>
              </select></dd>
      </dl>

      <dl>
        <dt>Battle Preamble:</dt>
        <dd><textarea name="battle_preamble" class="text" value="" cols = "60" rows="6"><?php echo $battle['preamble']; ?></textarea></dd>
      </dl>
      <dl>
        <dt>Notes:</dt>
        <dd><textarea name="notes" class="text" value="" cols = "60" rows="6"><?php echo $battle['notes']; ?></textarea></dd>

      </dl>


      <div id="operations">
        <input type="submit" value="Update Battle" />
      </div>
    </form>

  </div>

</div>


    </div>


  </div>

</div>
