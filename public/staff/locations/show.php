<?php require_once('../../../private/initialize.php');?>
<?php require_admin_login(); ?>
<?php
$id = $_GET['id'] ?? '1';

$location = find_location_by_id($id);

?>

<?php $page_title = 'Show Locations'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/locations/index.php'); ?>">&laquo; Back to List</a><br/>

  <div class="locations show">

    <h1>Location: <?php echo h($location['location_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($location['id']); ?></dd>
      </dl>
      <dl>
        <dt>Location Name</dt>
        <dd><?php echo h($location['location_name']); ?></dd>
      </dl>
      <dl>
        <dt>Location Short Name</dt>
        <dd><?php echo h($location['location_shortname']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
