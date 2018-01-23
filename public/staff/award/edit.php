<?php

require_once('../../../private/initialize.php');
require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/award/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
    //handle the variables sent by new.php
    $award = [];
    $award['id'] = $id;
    $award['award_name'] = $_POST['award_name'] ?? '';


    $result = update_award($award);
    if ($result === true) {
        redirect_to(url_for('/staff/award/show.php?id=' . $id));
    } else {
        $errors = $result;
        //var_dump($errors);
    }
} else {
    $award = find_award_by_id($id);
}

$award_set = find_all_awards();
$award_count = mysqli_num_rows($award_set);
mysqli_free_result($award_set);


?>
<?php $page_title = 'Edit Award'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/award/index.php'); ?>">&laquo; Back to List</a>

  <div class="award new">
    <h1>Edit Award</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/award/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Award Name</dt>
        <dd><input type="text" name="award_name" value="<?php echo h($award['award_name']); ?>" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Edit Award" />
      </div>
    </form>

  </div>

</div>
