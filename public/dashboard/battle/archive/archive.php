<?php

require_once('../../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/dashboard/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  $result = archive_battle($id);
  redirect_to(url_for('/dashboard/index.php'));

} else {
  $battle_info = find_battle_by_id($id);
}

?>

<?php $page_title = 'Archive Battle'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Archive Battle'; ?>

  <a class="back-link" href="<?php echo url_for('/dashboard/index.php'); ?>">&laquo; Back to List of Battles</a>

  <div class="question delete">
    <h1>Archive Battle</h1>
    <p>
      Are you sure you want to archive this battle?
    </p>
    <p class="item"><?php echo h($battle_info['name']); ?></p>

    <form action=<?php echo url_for('/dashboard/battle/archive/archive.php?id=' .
    h(u($battle_info['id']))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Archive Battle" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php')?>
