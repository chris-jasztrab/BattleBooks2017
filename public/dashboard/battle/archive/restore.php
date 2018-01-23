<?php
require_once('../../../../private/initialize.php');
require_login();
if (!isset($_GET['id'])) {
    redirect_to(url_for('/dashboard/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    $result = restore_battle($id);
    redirect_to(url_for('/dashboard/index.php'));
} else {
    $battle_info = find_battle_by_id($id);
}

?>

<?php $page_title = 'Restore Battle'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Restore Battle'; ?>

  <a class="back-link" href="<?php echo url_for('/dashboard/index.php'); ?>">&laquo; Back to List of Battles</a>

  <div class="question delete">
    <h1>Restore Battle</h1>
    <p>
      Are you sure you want to restore this battle?
    </p>
    <p class="item"><?php echo h($battle_info['name']); ?></p>

    <form action=<?php echo url_for('/dashboard/battle/archive/restore.php?id=' .
    h(u($battle_info['id']))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Restore Battle" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php')?>
