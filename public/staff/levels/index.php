<?php require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
  $levels = find_all_levels();
?>

<?php $page_title = 'Levels Maintenance'; ?>
<?php include(SHARED_PATH . '/staff_header.php')?>

    <div id="content">
      <div class="levels listing">
        <h1>Levels</h1>

        <div class="actions">
          <a class="action" href="<?php echo url_for('/staff/levels/new.php')?>">Create New Level</a>
        </div>

      	<table class="list">
      	  <tr>
            <th>ID</th>
            <th>Position</th>
            <th>Visible</th>
      	    <th>Name</th>
      	    <th>&nbsp;</th>
      	    <th>&nbsp;</th>
            <th>&nbsp;</th>
      	  </tr>

          <?php foreach($levels as $level) { ?>
            <tr>
              <td><?php echo $level['id']; ?></td>
              <td><?php echo $level['position']; ?></td>
              <td><?php echo $level['visible'] == 1 ? 'true' : 'false'; ?></td>
              <td><?php echo $level['level_name']; ?></td>
              <td><a class="action" href="<?php echo
              url_for('/staff/levels/show.php?id=' . h(u($level['id'])));
              ?>">View</a></td>
              <td><a class="action" href="<?php echo
              url_for('/staff/levels/edit.php?id=' . h(u($level['id'])));
              ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('/staff/levels/delete.php?id=' . h(u($level['id'])));
              ?>">Delete</a></td>
        	  </tr>
          <?php } ?>
      	</table>

      </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
