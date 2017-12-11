<?php

require_once('../../../private/initialize.php');
require_login();
if(is_post_request()) {

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
    redirect_to(url_for('/public/dashboard/question/new.php'));
}

$question_set = find_all_questions();
$question_count = mysqli_num_rows($question_set) + 1;


?>

<?php $page_title = 'Create Question'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Create Question'; ?>
<h2>Questions already in the DB that match your book.</h2>
  <table class="list">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Author First</th>
      <th>Author Last</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    </br/>
    <?php while($questions = mysqli_fetch_assoc($question_set)) { ?>
    <tr>
      <td rowspan="2"><?php echo $questions['id']; ?></td>
      <td><?php echo $questions['book_title']; ?></td>
      <td><?php echo $questions['author_first_name']; ?></td>
      <td><?php echo $questions['author_last_name']; ?></td>
      <td><a class="action" href="<?php echo url_for('/dashboard/question/show.php?id=' . h(u($questions['id'])));
      ?>">View</a></td>
      <td><a class="action" href="<?php echo
      url_for('/dashboard/question/edit.php?id=' . h(u($questions['id'])));
      ?>">Edit</a></td>
      <td><a class="action" href="<?php echo url_for('/dashboard/question/delete.php?id=' . h(u($questions['id'])));
      ?>">Delete</a></td>
    </tr>
    <tr>
    <td colspan="6"><?php echo $questions['question_text']; ?></td>
    </tr>

  <?php } ?>
</table>

</div>


</div>
</div>




<?php mysqli_free_result($question_set); ?>
<?php include(SHARED_PATH . '/public_footer.php')?>
