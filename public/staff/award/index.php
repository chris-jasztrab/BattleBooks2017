<?php require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
  $award_set = find_all_awards();
?>

<?php $page_title = 'Awards Maintenance'; ?>
<?php include(SHARED_PATH . '/staff_header.php')?>

    <div id="content">
      <div class="awards listing">
        <h1>Awards</h1>

        <div class="actions">
          <a class="action" href="<?php echo url_for('/staff/award/new.php')?>">Create New Award</a>
        </div>

      	<table class="list">
      	  <tr>
            <th>ID</th>
            <th>Name</th>
      	    <th>&nbsp;</th>
      	    <th>&nbsp;</th>
      	    <th>&nbsp;</th>

      	  </tr>
            </br/>

          <?php while($award = mysqli_fetch_assoc($award_set)) { ?>
            <tr>
              <td><?php echo $award['id']; ?></td>
        	    <td><?php echo $award['award_name']; ?></td>
              <td><a class="action" href="<?php echo url_for('/staff/award/show.php?id=' . h(u($award['id'])));
              ?>">View</a></td>
              <td><a class="action" href="<?php echo
              url_for('/staff/award/edit.php?id=' . h(u($award['id'])));
              ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('/staff/award/delete.php?id=' . h(u($award['id'])));
              ?>">Delete</a></td>
        	  </tr>
          <?php } ?>
      	</table>
        <?php mysqli_free_result($award_set); ?>
      </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
