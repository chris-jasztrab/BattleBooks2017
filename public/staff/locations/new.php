<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

//handle the variables sent by new.php

$location = [];
$location['location_name'] = $_POST['location_name'] ?? '';
$location['location_shortname'] = $_POST['location_shortname'] ?? '';

$result = insert_location($location);
if($result === true) {
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/locations/show.php?id=' . $new_id));
} else {
  $errors = $result;
  //var_dump($errors);
}

} else {
    // display the blank form
  $location = [];
  $location["location_name"] = '';
  $location["location_shortname"] = '';

}

$location_set = find_all_locations();
$location_count = mysqli_num_rows($location_set) + 1;
mysqli_free_result($location_set);


?>
<?php $page_title = 'Create Location'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/locations/index.php'); ?>">&laquo; Back to List</a>

  <div class="location new">
    <h1>Create Location</h1>

      <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/locations/new.php')?>" method="post">
      <dl>
        <dt>Location Name</dt>
        <dd><input type="text" name="location_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Location Shortname</dt>
        <dd><input type="text" name="location_shortname" value="" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Location" />
      </div>
    </form>

  </div>

</div>


?>
