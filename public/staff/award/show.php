<?php require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
$id = $_GET['id'] ?? '1';

$award = find_award_by_id($id);

?>

<?php $page_title = 'Show Award'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/award/index.php'); ?>">&laquo; Back to List</a><br/>

  <div class="award show">

    <h1>Award: <?php echo h($award['award_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($award['id']); ?></dd>
      </dl>
      <dl>
        <dt>Award Name</dt>
        <dd><?php echo h($award['award_name']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
