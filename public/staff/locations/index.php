<?php require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
  $locations = find_all_locations();
?>

<?php $page_title = 'Locations Maintenance'; ?>
<?php include(SHARED_PATH . '/staff_header.php')?>

    <div id="content">
      <div class="location listing">
        <h1>Locations</h1>

        <div class="actions">
          <a class="action" href="<?php echo url_for('/staff/locations/new.php')?>">Create New Location</a>
        </div>

      	<table class="list">
      	  <tr>
            <th>ID</th>
            <th>Location Name</th>
            <th>Location Shortname</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>

      	  </tr>

          <?php foreach($locations as $location) { ?>
            <tr>
              <td><?php echo $location['id']; ?></td>
              <td><?php echo $location['location_name']; ?></td>
              <td><?php echo $location['location_shortname'];?></td>
              <td><a class="action" href="<?php echo
              url_for('/staff/locations/show.php?id=' . h(u($location['id'])));
              ?>">View</a></td>
              <td><a class="action" href="<?php echo
              url_for('/staff/locations/edit.php?id=' . h(u($location['id'])));
              ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('/staff/locations/delete.php?id=' . h(u($location['id'])));
              ?>">Delete</a></td>
        	  </tr>
          <?php } ?>
      	</table>

      </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
