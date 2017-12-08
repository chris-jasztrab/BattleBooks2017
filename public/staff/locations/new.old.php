<?php

require_once('../../../private/initialize.php');

$location_name = '';
$position = '';
$visible = '';

if(is_post_request()) {

//handle the variables sent by new.php

$location_name = $_POST['location_name'] ?? '';
$position = $_POST['position'] ?? '';
$visible = $_POST['visible'] ?? '';

echo "Form Parameters<br />";
echo "Menu Name: " . $location_name . "<br />";
echo "Position: " . $position . "<br />";
echo "Visible: " . $visible . "<br />";
}


?>
<?php $page_title = 'Create Location'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/locations/index.php'); ?>">&laquo; Back to List</a>

  <div class="location new">
    <h1>Create Location</h1>

    <form action="<?php echo url_for('/staff/locations/new.php')?>" method="post">
      <dl>
        <dt>Location Name</dt>
        <dd><input type="text" name="location_name" value="<?php echo h($location_name); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1" <?php if($position == "1") { echo " selected";} ?>>1</option>
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
        <input type="submit" value="Create Location" />
      </div>
    </form>

  </div>

</div>


?>
