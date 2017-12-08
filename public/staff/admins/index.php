<?php require_once('../../../private/initialize.php');?>
<?php require_admin_login(); ?>

<?php
  $admin_list = find_all_admins();
?>

<?php $page_title = 'Admin Management Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php')?>

    <div id="content">
      <div id="main-menu">
        <h2>Admin Management Menu</h2>
        <div class="admin listing">
          <h1>Admins</h1>

          <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/admins/new.php')?>">Create New Admin</a>
          </div>

        	<table class="list">
        	  <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Is Global Admin</th>
              <th>Username</th>

        	    <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>

        	  </tr>
              </br/>

            <?php while($admins = mysqli_fetch_assoc($admin_list)) { ?>
              <tr>
                <td><?php echo $admins['id']; ?></td>
                <td><?php echo $admins['first_name']; ?></td>
          	    <td><?php echo $admins['isGlobalAdmin']; ?></td>
                <td><?php echo $admins['username']; ?></td>

                <td><a class="action" href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admins['id'])));
                ?>">View</a></td>
                <td><a class="action" href="<?php echo
                url_for('/staff/admins/edit.php?id=' . h(u($admins['id'])));
                ?>">Edit</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admins['id'])));
                ?>">Delete</a></td>
          	  </tr>
            <?php } ?>
        	</table>
          <?php mysqli_free_result($admin_list); ?>
        </div>
      </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
