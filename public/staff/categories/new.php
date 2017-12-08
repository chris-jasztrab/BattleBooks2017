<?php

require_once('../../../private/initialize.php');
require_admin_login();
if(is_post_request()) {

  $category = [];
  $category['category'] = $_POST['category'] ?? '';
  $category['position'] = $_POST['position'] ?? '';


  $result = insert_category($category);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      redirect_to(url_for('/staff/categories/show.php?id=' . $new_id));
    } else {
      $errors = $result;
      //var_dump($errors);
    }
} else {
    // display the blank form
  $category = [];
  $category["category"] = '';
  $category["position"] = '';
}



$category_set = find_all_categories();
$category_count = mysqli_num_rows($category_set) + 1;
mysqli_free_result($category_set);

?>

<?php $page_title = 'Create Category'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to List</a>

  <div class="category new">
    <h1>Create Category</h1>

  <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/categories/new.php')?>" method="post">
      <dl>
        <dt>Category Name</dt>
        <dd><input type="text" name="category" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
            for ($i=1; $i <= $category_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($category["position"] == $i)
               {
                 echo " selected";
               }
               echo ">{$i}</option>" ;
             }
             ?>
          </select>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Category" />
      </div>
    </form>

  </div>

</div>
