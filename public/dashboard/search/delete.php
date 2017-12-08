<?php
require_once('../../../private/initialize.php');
require_admin_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/dashboard/search/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_question($id);
  redirect_to(url_for('/dashboard/search/search2.php'));

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


  <a class="back-link" href="<?php echo url_for('/dashboard/search/search2.php'); ?>">&laquo; Back to List</a>

  <div class="question delete">
    <h1>Delete Question</h1>
    <p>
      Are you sure you want to delete this question?
    </p>
    <p class="item"><?php echo h($question['book_title']) . " by " . h($question['author_first_name']) . " " . h($question['author_last_name']); ?></p>

    <form action=<?php echo url_for('/dashboard/search/delete.php?id=' .
    h(u($question['id']))); ?>" method="post">
    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($question['id']); ?></dd>
      </dl>
      <dl>
        <dt>Book Title:</dt>
        <dd><?php echo h($question['book_title']); ?></dd>
      </dl>
        <dl>
        <dt>Author First:</dt>
        <dd><?php echo h($question['author_first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Author Last:</dt>
        <dd><?php echo h($question['author_last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Publication Year:</dt>
        <dd><?php echo h($question['book_publication_year']); ?></dd>
      </dl>
      <dl>
        <dt>Question</dt>
        <dd><?php echo h($question['question_text']); ?></dd>
      </dl>
      <dl>
        <dt>Answer:</dt>
        <dd><?php echo h($question['question_answer']); ?></dd>
      </dl>
      <dl>
        <dt>Level:</dt>
        <?php $level_array = explode(',',$question['level']); ?>
          <dd> <?php

          foreach($level_array as $level => $level_value)
          {
            $levelname = find_level_by_id($level_value);
            echo $levelname['level_name'];
            echo "&nbsp&nbsp;";
          }
            ?></dd>
      </dl>
      <dl>
        <dt>Category:</dt>
        <?php $category_array = explode(',',$question['question_category']); ?>
        <dd><?php

        foreach($category_array as $category => $category_value)
        {
          $categoryname = find_category_by_id($category_value);
          echo $categoryname['category'];
          echo "&nbsp&nbsp;";
        }
         ?></dd>

      </dl>
      <dl>
        <dt>Owner:</dt>
        <?php $owner_name = find_location_by_id($question['question_owner']); ?>
        <dd><?php echo h($owner_name['location_name']); ?></dd>
      </dl>

      <dl>
        <dt>Notes:</dt>
        <dd><?php echo h($question['notes']); ?></dd>
      </dl>

    </div>
    <div id="operations">
      <input type="submit" name="commit" value="Delete Question" />
    </div>
  </form>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php')?>
