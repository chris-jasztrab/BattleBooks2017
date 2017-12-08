<?php
require_once('../../../private/initialize.php');
require_admin_login();

if(is_post_request()) {

  $battle = [];
  $battle["battle_name"] = $_POST['battle_name'] ?? '';
  $battle["battle_level"] = $_POST['battle_level'] ??'';
  $battle["battle_route"] = $_POST['battle_round'] ?? '';
  $battle["battle_preamble"] = $_POST['book_title'] ?? '';


//  $result = insert_category($battle);
//    if($result === true) {
//      $new_id = mysqli_insert_id($db);
//      redirect_to(url_for('/staff/categories/show.php?id=' . $new_id));
//    } else {
//      $errors = $result;
      //var_dump($errors);
//    }
} else {
    // display the blank form
  $battle = [];
  $battle["battle_name"] = '';
  $battle["battle_level"] = '';
  $battle["battle_round"] = '';
  $battle["battle_preamble"] = '';

}

echo $battle["battle_name"] . "<br/>";
echo $battle["battle_level"] . "<br/>";
echo $battle["battle_round"] . "<br/>";
echo $battle["battle_preamble"] . "<br/>";

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
    <h1>Create New Battle</h1>

    <?php //echo display_errors($errors); ?>

    <form action="<?php echo url_for('/dashboard/battle/new2.php')?>" method="post">

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
        <dt>Battle Round:</dt>
        <dd><input type="text" name="battle_round" value=""  /></dd>
      </dl>
      <dl>
        <dt>Battle Preamble:</dt>
        <dd><textarea name="battle_preamble" class="text" value="" cols = "40" rows="3"></textarea></dd>
      </dl>
      <dl>


      </dl>


      <input type="hidden" name="book_publication_year" value="" />
      <input type="hidden" name="location" value="" />
      <input type="hidden" name="level_id" value="" />
      <input type="hidden" name="category_id" value="" />



      <div id="operations">
        <input type="submit" value="Create Question" />
      </div>
    </form>

  </div>

</div>


    </div>


  </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php')?>
