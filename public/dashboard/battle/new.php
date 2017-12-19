<?php
require_once('../../../private/initialize.php');
require_login();

if(is_post_request()) {

  $battle = [];
  $battle["battle_name"] = $_POST['battle_name'] ?? '';
  $battle["battle_level"] = $_POST['battle_level'] ??'';
  $battle["battle_preamble"] = $_POST['battle_preamble'] ?? '';
  $battle["notes"] = $_POST['notes'] ?? '';
  $battle['owner'] = $_SESSION['question.owner'] ?? '0';

  $result = insert_battle($battle);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['battle_id'] = $new_id;
      redirect_to(url_for('/dashboard/battle/show.php?id=' . $new_id));
    } else {
      $errors = $result;
      }
    } else {
    // display the blank form
  $battle = [];
  $battle["battle_name"] = '';
  $battle["battle_level"] = '';
  $battle["battle_preamble"] = '';

}

//echo $battle["battle_name"] . "<br/>";
//echo $battle["battle_level"] . "<br/>";
//echo $battle["battle_preamble"] . "<br/>";

// GET TOTAL # OF QUESTIONS IN DB
$battle_set = find_all_battles();
$battle_count = mysqli_num_rows($battle_set) + 1;
mysqli_free_result($battle_set);

?>

<?php $page_title = 'Create Battle'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'New Battle'; ?>


  <div class="question new">
    <?php $location_info = find_location_by_id($_SESSION['question.owner']);
    $location_name = $location_info['location_name'];
    ?>
    <h1>Create New Battle for <?php echo $location_name;?></h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/dashboard/battle/new.php')?>" method="post">

      <dl>
        <dt>Battle Name:</dt>
        <dd><input type="text" name="battle_name" value="" /></dd>
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
        <dd><textarea name="battle_preamble" class="text" value="" cols = "60" rows="6"></textarea></dd>
      </dl>
      <dl>
        <dt>Notes:</dt>
        <dd><textarea name="notes" class="text" value="" cols = "60" rows="6"></textarea></dd>

      </dl>


      <div id="operations">
        <input type="submit" value="Create Battle" />
      </div>
    </form>

  </div>

</div>


    </div>


  </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php')?>
