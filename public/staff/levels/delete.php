<?php
require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/levels/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_level($id);
  redirect_to(url_for('/staff/levels/index.php'));

} else {
  $level = find_level_by_id($id);
}

?>

<?php $page_title = 'Delete Level'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/levels/index.php'); ?>">&laquo; Back to List</a>

  <div class="level delete">
    <h1>Delete Level</h1>
    <p>
      Are you sure you want to delete the level?  This is very destructive and any questions that have this level...
    </p>
    <p class="item"><?php echo h($level['level_name']); ?></p>

    <form action=<?php echo url_for('/staff/levels/delete.php?id=' .
    h(u($level['id']))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Delete Level" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
