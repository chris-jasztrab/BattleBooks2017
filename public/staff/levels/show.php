<?php require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
$id = $_GET['id'] ?? '1';

$level = find_level_by_id($id);

?>

<?php $page_title = 'Show Levels'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/levels/index.php'); ?>">&laquo; Back to List</a><br/>

  <div class="level show">

    <h1>Level: <?php echo h($level['level_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($level['id']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($level['position']); ?></dd>
      </dl>
      <dl>
        <dt>Level Name</dt>
        <dd><?php echo h($level['level_name']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo h($level['visible']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
