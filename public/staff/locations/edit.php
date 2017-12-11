<?php
require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/locations/index.php'));
}

$id = $_GET['id'];

if(is_post_request())
{

$location = [];
$location['id'] = $id;
$location['location_name'] = $_POST['location_name'] ?? '';
$location['location_shortname'] = $_POST['location_shortname'] ?? '';


$result = update_location($location);
if($result === true)
{
  redirect_to(url_for('/staff/locations/show.php?id=' . $id));
}
else
{
  $errors = $result;
  //var_dump($errors);
}
}

else {
$location = find_location_by_id($id);
}


?>
<?php $page_title = 'Edit Location'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/locations/index.php'); ?>">&laquo; Back to List</a>

  <div class="location new">
    <h1>Edit Location</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/locations/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Location Name</dt>
        <dd><input type="text" name="location_name" value="<?php echo h($location['location_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Location Shortname</dt>
        <dd><input type="text" name="location_shortname" value="<?php echo h($location['location_shortname']); ?>" /></dd>
      </dl>


      <div id="operations">
        <input type="submit" value="Edit Location" />
      </div>
    </form>

  </div>

</div>


?>
