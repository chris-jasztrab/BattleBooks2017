<?php require_once('../../../private/initialize.php');?>
<?php require_admin_login(); ?>

<?php
$id = $_GET['id'] ?? '1';

$admin = find_admin_by_id($id);

?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a><br/>

  <div class="admin show">

    <h1>Name: <?php echo h($admin['first_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First Name</dt>
        <dd><?php echo h($admin['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><?php echo h($admin['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($admin['username']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($admin['email']); ?></dd>
      </dl>
      <dl>
        <dt>Library</dt>
        <?php $location_info = find_location_by_id($admin['location']); ?>
        <dd><?php echo h($location_info['location_name']); ?></dd>
      </dl>
      <dl>
        <dt>Is User a Global Admin</dt>
        <dd><?php
        if($admin['isGlobalAdmin'] == '1')
        {
          echo "Yes";
         }
         else
         { echo "No";
         }
         ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
