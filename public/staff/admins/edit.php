<?php
require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];

if(is_post_request())
{
  //handle the variables sent by new.php
  $admin = [];
  $admin['id'] = $id;
  $admin['first_name'] = $_POST['first_name'] ?? '';
  $admin['last_name'] = $_POST['last_name'] ?? '';
  $admin['email'] = $_POST['email'] ?? '';
  $admin['username'] = $_POST['username'] ?? '';
  $admin['hashed_password'] = $_POST['hashed_password'] ?? '';
  $admin['location'] = $_POST['location'] ?? '';
  $admin['isGlobalAdmin'] = $_POST['isGlobalAdmin'] ?? '';
  $result = update_admin($admin);
  if($result === true)
  {
    redirect_to(url_for('/staff/admins/show.php?id=' . $id));
  }
  else
  {
    $errors = $result;
    //var_dump($errors);
  }
}

else
{
  $admin = find_admin_by_id($id);
}

$admin_set = find_all_admins();
$admin_count = mysqli_num_rows($admin_set);
mysqli_free_result($admin_set);


?>
<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Edit Admin</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>UserName</dt>
        <dd><input type="text" name="username" value="<?php echo h($admin['username']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Library</dt>
        <dd>
        <select name="location">
              <?php
              $location_set = find_all_locations();
              while($location = mysqli_fetch_assoc($location_set)) {
                echo "<option value=\"" . h($location['id']) . "\"";
                if($location['id'] == $admin['location']) { echo "selected";}
                 echo ">" . h($location['location_shortname']) . "</option>";
               }
               mysqli_free_result($location_set);
             ?>
            </select></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($admin['email']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="text" name="hashed_password" value="" /></dd>
      </dl>
      <dl>
        <dt>Is User Global Admin</dt>
        <dd>
        <select name="isGlobalAdmin">
        <option value="0" <?php if ($admin['isGlobalAdmin'] == "0") { echo "selected"; } ?>>No</option>"
        <option value="1" <?php if ($admin['isGlobalAdmin'] == "1") { echo "selected"; } ?>>Yes</option>
        </select>
        </dd>
      </dl>


      <div id="operations">
        <input type="submit" value="Update User" />
      </div>
    </form>

  </div>

</div>
