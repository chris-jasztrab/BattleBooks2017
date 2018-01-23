<?php
require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/categories/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    $result = delete_category($id);
    redirect_to(url_for('/staff/categories/index.php'));
} else {
    $category = find_category_by_id($id);
}

?>

<?php $page_title = 'Delete Category'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to List</a>

  <div class="category delete">
    <h1>Delete Category</h1>
    <p>
      Are you sure you want to delete the category?  This is very destructive and any questions that have this category..
    </p>
    <p class="item"><?php echo h($category['category']); ?></p>

    <form action=<?php echo url_for('/staff/categories/delete.php?id=' .
    h(u($category['id']))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Delete Category" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
