<?php
require_once('../../../private/initialize.php');
require_admin_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/locations/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_location($id);
  redirect_to(url_for('/staff/locations/index.php'));

} else {
  $location = find_location_by_id($id);
}

?>

<?php $page_title = 'Delete Location'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/locations/index.php'); ?>">&laquo; Back to List</a>

  <div class="location delete">
    <h1>Delete Location</h1>
    <p>
      Are you sure you want to delete the location?  This is very destructive and any questions that have this location..
    </p>
    <p class="item"><?php echo h($location['location_name']); ?></p>

    <form action=<?php echo url_for('/staff/locations/delete.php?id=' .
    h(u($location['id']))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Delete Location" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
