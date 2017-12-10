<?php
require_once('../../../../private/initialize.php');
require_admin_login();

if(is_post_request()) {

  $round = [];
  $round["round_name"] = $_POST['round_name'] ?? '';
  $round["round_preamble"] = $_POST['round_preamble'] ?? '';
  $round["round_notes"] = $_POST['round_notes'] ?? '';
  $round['battle_id'] = $_SESSION['battle_id'] ?? '';

  $result = insert_round($round);

    if($result === true) {
      $new_id = mysqli_insert_id($db);
      redirect_to(url_for('/dashboard/battle/show.php?id=' . $_SESSION['battle_id']));
}
    //} else {
      //$errors = $result;
      //var_dump($errors);
//    }
} else {
    // display the blank form
  $round = [];
  $round["round_name"] = '';
  $round["round_preamble"] = '';
  $round["round_notes"] = '';
  $round['battle_id'] = $_SESSION['battle_id'] ?? '';
}

// GET TOTAL # OF QUESTIONS IN DB
$round_set = find_rounds_by_battleid($_SESSION['battle_id']);
$round_count = mysqli_num_rows($round_set) + 1;
mysqli_free_result($round_set);

$current_battle = find_battle_by_id($_SESSION['battle_id']);

?>

<?php $page_title = 'Create Round'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Add Round to Battle'; ?>

  <div class="round new">
    <h1>Add Round to Battle <?php echo $current_battle['name'] . " ID " . $_SESSION['battle_id'];?></h1>

    <?php //echo display_errors($errors); ?>

    <form action="<?php echo url_for('/dashboard/battle/round/new.php')?>" method="post">
      <dl>
        <dt>Round Name:</dt>
        <dd><input type="text" name="round_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Round Preamble:</dt>
        <dd><textarea name="round_preamble" class="text" value="" cols = "60" rows="6"></textarea></dd>
      </dl>

      <dl>
        <dt>Notes:</dt>
        <dd><textarea name="round_notes" class="text" value="" cols = "60" rows="6"></textarea></dd>
      </dl>


      <div id="operations">
        <input type="submit" value="Create Round" />
      </div>
    </form>

  </div>

</div>


    </div>


  </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php')?>
