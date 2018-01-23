<?php
require_once('../../../private/initialize.php');

require_login();

if (is_post_request()) {
    $admin = [];
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['hashed_password'] = $_POST['hashed_password'] ?? '';
    $admin['location'] = $_POST['location'] ?? '';
    $admin['isGlobalAdmin'] = $_POST['isGlobalAdmin'] ?? '';

    $result = insert_admin($admin);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
    } else {
        $errors = $result;
        //var_dump($errors);
    }
} else {
    // display the blank form
    $admin = [];
    $admin['first_name'] = '';
    $admin['last_name'] = '';
    $admin['email'] = '';
    $admin['username'] = '';
    $admin['hashed_password'] = '';
    $admin['location'] = '';
    $admin['isGlobalAdmin'] = '';
}

$admin_set = find_all_admins();
$admin_count = mysqli_num_rows($admin_set) + 1;
mysqli_free_result($admin_set);

?>

<?php $page_title = 'Create Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php
$location_set = find_all_locations();
$location_count = mysqli_num_rows($location_set);
mysqli_free_result($location_set);
?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Create Admin</h1>

  <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/admins/new.php')?>" method="post">
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Email Address</dt>
        <dd><input type="text" name="email" value="" /></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="" /></dd>
      </dl>
      <dl>
        <dt>Library</dt>
        <dd>
        <select name="location">
              <?php
              $location_set = find_all_locations();
              while ($location = mysqli_fetch_assoc($location_set)) {
                  echo "<option value=\"" . h($location['id']) . "\"";

                  echo ">" . h($location['location_shortname']) . "</option>";
              }
               mysqli_free_result($location_set);
             ?>
            </select></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="text" name="hashed_password" value="" /></dd>
      </dl>
      <dl>
        <dt>Is User Global Admin</dt>
        <dd>
        <select name="isGlobalAdmin">
        <option value="0">No</option>" ;
        <option value="1">Yes</option>" ;
        </select>
        </dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Create Admin" />
      </div>
    </form>

  </div>

</div>
