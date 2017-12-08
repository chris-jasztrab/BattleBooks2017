<?php require_once('../../../private/initialize.php');?>

<?php
$id = $_GET['id'] ?? '1';

$question = find_question_by_id($id);

?>

<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Create Question'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/question/new2.php'); ?>">&laquo; Back to List</a><br/>

  <div class="question show">

    <h1>Title: <?php echo h($question['book_title']); ?></h1>

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

    </div>

</div>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
