<?php require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
$id = $_GET['id'] ?? '1';

$category = find_category_by_id($id);

?>

<?php $page_title = 'Show Categories'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to List</a><br/>

  <div class="category show">

    <h1>Category: <?php echo h($category['category']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($category['id']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($category['position']); ?></dd>
      </dl>
      <dl>
        <dt>Category Name</dt>
        <dd><?php echo h($category['category']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
