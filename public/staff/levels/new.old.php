<?php

require_once('../../../private/initialize.php');

$level_name = '';
$position = '';
$visible = '';

if(is_post_request()) {

//handle the variables sent by new.php

$level_name = $_POST['level_name'] ?? '';
$position = $_POST['position'] ?? '';
$visible = $_POST['visible'] ?? '';

echo "Form Parameters<br />";
echo "Level Name: " . $level_name . "<br />";
echo "Position: " . $position . "<br />";
echo "Visible: " . $visible . "<br />";
}


?>
<?php $page_title = 'Create Level'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/levels/index.php'); ?>">&laquo; Back to List</a>

  <div class="level new">
    <h1>Create Level</h1>

    <form action="<?php echo url_for('/staff/levels/new.php')?>" method="post">
      <dl>
        <dt>Level Name</dt>
        <dd><input type="text" name="level_name" value="<?php echo h($level_name); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1"<?php if($position == "1") { echo " selected"; } ?>>1</option>
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
