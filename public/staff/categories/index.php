<?php require_once('../../../private/initialize.php');?>
<?php require_login(); ?>
<?php
  $category_set = find_all_categories();
?>

<?php $page_title = 'Categories Maintenance'; ?>
<?php include(SHARED_PATH . '/staff_header.php')?>

    <div id="content">
      <div class="categories listing">
        <h1>Categories</h1>

        <div class="actions">
          <a class="action" href="<?php echo url_for('/staff/categories/new.php')?>">Create New Category</a>
        </div>

      	<table class="list">
      	  <tr>
            <th>ID</th>
            <th>Position</th>
            <th>Name</th>
      	    <th>&nbsp;</th>
      	    <th>&nbsp;</th>
      	    <th>&nbsp;</th>

      	  </tr>
            </br/>

          <?php while($category = mysqli_fetch_assoc($category_set)) { ?>
            <tr>
              <td><?php echo $category['id']; ?></td>
              <td><?php echo $category['position']; ?></td>
        	    <td><?php echo $category['category']; ?></td>
              <td><a class="action" href="<?php echo url_for('/staff/categories/show.php?id=' . h(u($category['id'])));
              ?>">View</a></td>
              <td><a class="action" href="<?php echo
              url_for('/staff/categories/edit.php?id=' . h(u($category['id'])));
              ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('/staff/categories/delete.php?id=' . h(u($category['id'])));
              ?>">Delete</a></td>
        	  </tr>
          <?php } ?>
      	</table>
        <?php mysqli_free_result($category_set); ?>
      </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
