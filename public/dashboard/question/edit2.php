<?php

// THIS IS THE SHOW PAGE
require_once('../../../private/initialize.php');
require_login();
if (isset($_SESSION['editerrorarray'])) {
    unset($_SESSION['editerrorarray']);
}

$questionerrors = [];

  $question = [];
  $question["question_owner"] = $_POST['question_owner'] ?? '';
  $question["author_first_name"] = $_POST['author_first_name'] ??'';
  $question["author_last_name"] = $_POST['author_last_name'] ?? '';
  $question["book_title"] = $_POST['book_title'] ?? '';
  $question["book_publication_year"] = $_POST['book_publication_year'] ?? '';
  $question["level_id"] = $_POST['level_id'] ?? '';
  $question["category_id"] = $_POST['category_id'] ?? '';
  $question["question_text"] = $_POST['question_text'] ?? '';
  $question["question_answer"] = $_POST['question_answer'] ?? '';
  $question["notes"] = $_POST['notes'] ?? '';
  $question['id'] = $_GET['id'];
  $question["question_owner"] = $_SESSION['question.owner'];
  $_SESSION['question.authorfirst'] = $_POST['author_first_name'] ?? '';
  $_SESSION['question.authorlast'] = $_POST['author_last_name'] ?? '';
  $_SESSION['question.book_title'] = $_POST['book_title'] ?? '';
  $_SESSION['question.book_publication_year'] = $_POST['book_publication_year'] ?? '';
  $_SESSION["question_answer"] = $_POST['question_answer'];
  $_SESSION["question_text"] = $_POST['question_text'];
  $_SESSION['notes'] = $_POST['notes'];
  $question['last_edited_by'] = $_SESSION['question.owner'];

  if (empty($question['level_id'])) {
      $questionerrors[] = "You must select at least one level.";
  }

  if (empty($question['category_id'])) {
      $questionerrors[] = "You must select at least one category.";
  }

if (isset($_POST['isaward']) && empty($_POST['award'])) {
    $questionerrors[] = "If this is an award winner you need to select at least one award from the list";
}

if (!empty($questionerrors)) {
    $_SESSION['editerrorarray'] = $questionerrors;
    redirect_to(url_for('/dashboard/question/edit.php?id=' . $_GET['id']));
}

//echo var_dump($questionerrors);
//echo $question['level_id'];
//echo $question['category_id'];

$result = update_question($question);
if ($result === true) {
    delete_question_level($_GET['id']);
    delete_question_category($_GET['id']);
}
  $levelinsert = insert_question_level($_GET['id'], $_POST['level_id']);
  $categoryinsert = insert_question_category($_GET['id'], $_POST['category_id']);

// no functions to edit awards at this time



if ($result === true) {
    //$new_id = mysqli_insert_id($db);
    redirect_to(url_for('/dashboard/search/show.php?id=' . $_GET['id']));
}
$errors = $result;
//var_dump($errors);



// GET TOTAL # OF QUESTIONS IN DB
$question_set = find_all_questions();
$question_count = mysqli_num_rows($question_set) + 1;
mysqli_free_result($question_set);

?>

<?php $page_title = 'Create Question'; ?>
<?php include(SHARED_PATH . '/public_header.php');?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Show Question'; ?>

    <div class="level show">

      <h1>Title: <?php echo h($question["book_title"]); ?></h1>

      <div class="attributes">
        <dl>
          <dt>ID:</dt>
          <dd><?php echo $new_id; ?></dd>
        </dl>
        <dl>
          <dt>Author:</dt>
          <dd><?php echo h($question["author_first_name"]) . " " . h($question["author_last_name"]); ?></dd>
        </dl>
        <dl>
          <dt>Publication Year</dt>
          <dd><?php echo h($question["book_publication_year"]); ?></dd>
        </dl>
        <dl>
          <dt>Level</dt>
          <?php $level_name = find_level_by_id($question['level_id']); ?>
          <dd> <?php echo h($level_name['level_name']); ?></dd>
        </dl>
        <dl>
          <dt>Category</dt>
          <?php $category_name = find_category_by_id($question['category_id']); ?>
          <dd><?php echo h($category_name['category']); ?></dd>
        </dl>
        <dl>
          <dt>Question</dt>
          <dd><?php echo h($question['question_text']); ?></dd>
        </dl>
        <dl>
          <dt>Answer</dt>
          <dd><?php echo h($question['question_answer']); ?></dd>
        </dl>
        <dl>
          <dt>Owner</dt>
          <?php $owner_name = find_location_by_id($question['question_owner']); ?>
          <dd><?php echo h($owner_name['location_name']); ?></dd>
        </dl>
        <dl>
          <dt>Notes</dt>
          <dd><?php echo h($question['notes']); ?></dd>
        </dl>
      </div>

<br />
<a class="back-link" href="<?php echo url_for('/dashboard/question/new2.php'); ?>">&laquo; Add another question for this book</a><br/>


    </div>

</div>


    </div>


  </div>

</div>

<?php
  include(SHARED_PATH . '/public_footer.php');
?>
