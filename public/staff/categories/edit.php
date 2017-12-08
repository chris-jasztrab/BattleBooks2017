<?php

require_once('../../../private/initialize.php');
require_admin_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/categories/index.php'));
}

$id = $_GET['id'];

if(is_post_request())
{
  //handle the variables sent by new.php
  $category = [];
  $category['id'] = $id;
  $category['category'] = $_POST['category_name'] ?? '';
  $category['position'] = $_POST['position'] ?? '';

  $result = update_category($category);
  if($result === true)
  {
    redirect_to(url_for('/staff/categories/show.php?id=' . $id));
  }
  else
  {
    $errors = $result;
    //var_dump($errors);
  }
}

else
{
  $category = find_category_by_id($id);
}

$category_set = find_all_categories();
$category_count = mysqli_num_rows($category_set);
mysqli_free_result($category_set);


?>
<?php $page_title = 'Edit Category'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/categories/index.php'); ?>">&laquo; Back to List</a>

  <div class="category new">
    <h1>Edit Category</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/categories/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Category Name</dt>
        <dd><input type="text" name="category_name" value="<?php echo h($category['category']); ?>" /></dd>
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
        <input type="submit" value="Edit Category" />
      </div>
    </form>

  </div>

</div>
