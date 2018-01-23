<?php

require_once('../../../private/initialize.php');
require_login();
if (is_post_request()) {
    $award = [];
    $award['award_name'] = $_POST['award_name'] ?? '';



    $result = insert_award($award);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/award/show.php?id=' . $new_id));
    } else {
        $errors = $result;
        //var_dump($errors);
    }
} else {
    // display the blank form
    $award = [];
    $award["award"] = '';
}



$award_set = find_all_awards();
$award_count = mysqli_num_rows($award_set) + 1;
mysqli_free_result($award_set);

?>

<?php $page_title = 'Create Award'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/award/index.php'); ?>">&laquo; Back to List</a>

  <div class="award new">
    <h1>Create Award</h1>

  <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/award/new.php')?>" method="post">
      <dl>
        <dt>Award Name</dt>
        <dd><input type="text" name="award_name" value="" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Create Award" />
      </div>
    </form>

  </div>

</div>
