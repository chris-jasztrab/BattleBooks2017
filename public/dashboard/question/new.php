<?php
require_once('../../../private/initialize.php');
require_login();

if (is_post_request()) {
    $question = [];
    $question["question_owner"] = $_POST['question_owner'] ?? '';
    $question["author_first_name"] = $_POST['author_first_name'] ??'';
    $question["author_last_name"] = $_POST['author_last_name'] ?? '';
    $question["book_title"] = $_POST['book_title'] ?? '';
    $question["book_publication_year"] = $_POST['book_publication_year'] ?? '';

//  $result = insert_category($question);
//    if($result === true) {
//      $new_id = mysqli_insert_id($db);
//      redirect_to(url_for('/staff/categories/show.php?id=' . $new_id));
//    } else {
//      $errors = $result;
      //var_dump($errors);
//    }
} else {
    // display the blank form
    $question = [];
    $question["author_first_name"] = '';
    $question["author_last_name"] = '';
    $question["book_title"] = '';
    $question["book_publication_year"] = '';
}

//echo $question["author_first_name"] . "<br/>";
//echo $question["author_last_name"] . "<br/>";
//echo $question["book_title"] . "<br/>";
//echo $question["book_publication_year"] . "<br/>";

// GET TOTAL # OF QUESTIONS IN DB
$question_set = find_all_questions();
$question_count = mysqli_num_rows($question_set) + 1;
mysqli_free_result($question_set);

?>

<?php $page_title = 'Create Question'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>
  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
<div id="main">
<div id="page">

  <div id="content">

  <?php $page_title = 'Search Question'; ?>


  <div class="question new">
    <h1>Create New Question</h1>

    <?php //echo display_errors($errors);?>

    <form action="<?php echo url_for('/dashboard/question/new2.php')?>" method="post">

      <dl>
        <dt>Author First Name:</dt>
        <dd><input type="text" name="author_first_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Author Last Name:</dt>
        <dd><input type="text" name="author_last_name" value=""  /></dd>
      </dl>
      <dl>
        <dt>Book Title:</dt>
        <dd><input type="text" name="book_title" value=""  /></dd>
      </dl>
      <dl>
        <dt>Publication Year</dt>
        <dd><input type="text" name="book_publication_year" value="" /></dd>
      </dl>

      
      <input type="hidden" name="location" value="" />
      <input type="hidden" name="level_id" value="" />
      <input type="hidden" name="category_id" value="" />



      <div id="operations">
        <input type="submit" value="Create Question" />
      </div>
    </form>

  </div>

</div>


    </div>


  </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php')?>
