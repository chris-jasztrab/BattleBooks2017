<?php
require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/award/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    $result = delete_award($id);
    redirect_to(url_for('/staff/award/index.php'));
} else {
    $award = find_award_by_id($id);
}

?>

<?php $page_title = 'Delete Award'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/award/index.php'); ?>">&laquo; Back to List</a>

  <div class="award delete">
    <h1>Delete Award</h1>
    <p>
      Are you sure you want to delete the award?  This is very destructive and any questions that have this award..
    </p>
    <p class="item"><?php echo h($award['award_name']); ?></p>

    <form action=<?php echo url_for('/staff/award/delete.php?id=' .
    h(u($award['id']))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Delete Award" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
