<?php
require_once('../../../private/initialize.php');
require_login();
if (is_post_request()) {

//handle the variables sent by new.php

    $level = [];
    $level['level_name'] = $_POST['level_name'] ?? '';
    $level['position'] = $_POST['position'] ?? '';
    $level['visible'] = $_POST['visible'] ?? '';



    $result = insert_level($level);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/levels/show.php?id=' . $new_id));
    } else {
        $errors = $result;
        //var_dump($errors);
    }
} else {
    // display the blank form
    $level = [];
    $level["level_name"] = '';
    $level["position"] = '';
    $level["visible"] = '';
}

$level_set = find_all_levels();
$level_count = mysqli_num_rows($level_set) + 1;
mysqli_free_result($level_set);

?>
<?php $page_title = 'Create Level'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/levels/index.php'); ?>">&laquo; Back to List</a>

  <div class="level new">
    <h1>Create Level</h1>

  <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/levels/new.php')?>" method="post">
      <dl>
        <dt>Level Name</dt>
        <dd><input type="text" name="level_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
            for ($i=1; $i <= $level_count; $i++) {
                echo "<option value=\"{$i}\"";
                if ($level["position"] == $i) {
                    echo " selected";
                }
                echo ">{$i}</option>" ;
            }
             ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Level" />
      </div>
    </form>

  </div>

</div>


?>
