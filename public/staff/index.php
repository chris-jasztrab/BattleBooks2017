<?php require_once('../../private/initialize.php');?>
<?php require_admin_login(); ?>
<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php')?>

    <div id="content">
      <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
          <li><a href="<?php echo url_for('staff/categories/index.php'); ?>">Categories</a></li>
          <li><a href="<?php echo url_for('staff/levels/index.php'); ?>">Levels</a></li>
          <li><a href="<?php echo url_for('staff/locations/index.php'); ?>">Locations</a></li>
          <li><a href="<?php echo url_for('staff/admins/index.php'); ?>">Manage Admins</a></li>
          <li><a href="<?php echo url_for('/dashboard/index.php'); ?>">Back to Main Dashboard</a></li>
        </ul>
      </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
