<?php

require_once('../../../private/initialize.php');
require_login();
if (!isset($_GET['id'])) {
    redirect_to(url_for('/dashboard/question/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {
  delete_question_level($id);
  delete_question_category($id);
  delete_question_awards($id);
  delete_question($id);

    redirect_to(url_for('/dashboard/question/new2.php'));
} else {
    $question = find_question_by_id($id);
}

?>

<?php $page_title = 'Delete Question'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Delete Question'; ?>


  <a class="back-link" href="<?php echo url_for('/dashboard/question/index.php'); ?>">&laquo; Back to List</a>

  <div class="question delete">
    <h1>Delete Question</h1>
    <p>
      Are you sure you want to delete this question?
    </p>
    <p class="item"><?php echo h($question['book_title']); ?></p>

    <form action=<?php echo url_for('/dashboard/question/delete.php?id=' .
    h(u($question['id']))); ?>" method="post">
    <div id="operations">
      <input type="submit" name="commit" value="Delete Question" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php')?>
