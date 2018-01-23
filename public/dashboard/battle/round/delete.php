<?php
require_once('../../../../private/initialize.php');
require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/dashboard/question/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    $result = delete_round($id);
    redirect_to(url_for('/dashboard/battle/show.php?id=' . $_SESSION['battle_id']));
} else {
    $round = find_round_by_id($id);
}

?>

<?php $page_title = 'Delete Category'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Delete Round'; ?>


  <a class="back-link" href="<?php echo url_for('/dashboard/question/index.php'); ?>">&laquo; Back to List</a>

  <div class="question delete">
    <h1>Delete Category</h1>
    <p>
      Are you sure you want to remove this category from the battle?
    </p>
    <p class="item"><?php echo h($round['round_name']); ?></p>

    <form action=<?php echo url_for('/dashboard/battle/round/delete.php?id=' .
    h(u($id))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Delete Category from Battle" />
    </div>
  </form>
  </div>
</div>
