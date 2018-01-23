<?php

require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/levels/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    $level = [];
    $level['id'] = $id;
    $level['level_name'] = $_POST['level_name'] ?? '';
    $level['visible'] = $_POST['visible'] ?? '';
    $level['position'] = $_POST['position'] ?? '';

    $result = update_level($level);
    if ($result === true) {
        redirect_to(url_for('/staff/levels/show.php?id=' . $id));
    } else {
        $errors = $result;
        //var_dump($errors);
    }
} else {
      $level = find_level_by_id($id);
  }

  $level_set = find_all_levels();
  $level_count = mysqli_num_rows($level_set);
  mysqli_free_result($level_set);

?>
<?php $page_title = 'Edit Levels'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/levels/index.php'); ?>">&laquo; Back to List</a>

  <div class="level new">
    <h1>Edit Level</h1>

      <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/levels/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Level Name</dt>
        <dd><input type="text" name="level_name" value="<?php echo h($level['level_name']); ?>" /></dd>
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
          <input type="checkbox" name="visible" value="1"<?php if ($level['visible'] == "1") {
                 echo " checked";
             } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Level" />
      </div>
    </form>

  </div>

</div>


?>
