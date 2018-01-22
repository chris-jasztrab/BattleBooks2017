<?php

require_once('../../../private/initialize.php');
require_login();
if(isset($_SESSION['errorarray']))
{
  unset($_SESSION['errorarray']);
}
unset($_SESSION['question_text']);
unset($_SESSION['question_answer']);
unset($_SESSION['notes']);


if(is_post_request()) {

  $postinfo_question = [];
  $postinfo_question["author_first_name"] = $_POST['author_first_name'] ??'';
  $postinfo_question["author_last_name"] = $_POST['author_last_name'] ?? '';
  $postinfo_question["book_title"] = $_POST['book_title'] ?? '';
  $postinfo_question["book_publication_year"] = $_POST['book_publication_year'] ??'';
  $postinfo_question["location"] = $_POST['location'] ?? '';
  $postinfo_question["level_id"] = $_POST['level_id'] ?? '';
  $postinfo_question["category_id"] = $_POST['category_id'] ?? '';
  $question_set = find_question_by_info($postinfo_question);
  $_SESSION['question.authorfirst'] = $_POST['author_first_name'] ??'';
  $_SESSION['question.authorlast'] = $_POST['author_last_name'] ??'';
  $_SESSION['question.book_title'] = $_POST['book_title'] ??'';
  $_SESSION['question.book_publication_year'] = $_POST['book_publication_year'] ??'';
  $_SESSION['question.location'] = $_POST['location'] ??'';
  $_SESSION['question.level_id'] = $_POST['level_id'] ??'';
  $_SESSION['question.category_id'] = $_POST['category_id'] ??'';
  }
  elseif(isset($_SESSION['question.authorfirst'])){
      $postinfo_question["author_first_name"] = $_SESSION['question.authorfirst'];
      $postinfo_question["author_last_name"] = $_SESSION['question.authorlast'];
      $postinfo_question["book_title"] = $_SESSION['question.book_title'];
      $postinfo_question["book_publication_year"] = $_SESSION['question.book_publication_year'];
      $postinfo_question["location"] = $_SESSION['question.location'];
      $postinfo_question["level_id"] = $_SESSION['question.level_id'];
      $postinfo_question["category_id"] = $_SESSION['question.category_id'];
      $question_set = find_question_by_info($postinfo_question);
    }
  else {
     redirect_to(url_for('/public/dashboard/question/new.php'));
  }
?>

<?php $page_title = 'List Questions'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $headerString = "Questions already in the database that match Book: ";
          $headerString .= $postinfo_question['book_title'] . " by Author: ";
          $headerString .= $postinfo_question['author_first_name'] . " ";
          $headerString .= $postinfo_question['author_last_name'];
      ?>
  <h2><?php echo $headerString; ?></h2>
  <table class="list">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Author First</th>
      <th>Author Last</th>
      <th>&nbsp;</th>


    </tr>
    </br/>
    <?php
      $x = 0;
     ?>
  <?php while($bookinfo = mysqli_fetch_assoc($question_set)) { ?>
    <?php
      $class = ($x%2 == 0)? '#ffffff': '#c4c4c4'; ?>
    <tr bgcolor='<?php echo $class; ?>'>
      <td rowspan="3"><?php echo $bookinfo['id']; ?></td>
      <td><?php echo $bookinfo['book_title']; ?></td>
      <td><?php echo $bookinfo['author_first_name']; ?></td>
      <td><?php echo $bookinfo['author_last_name']; ?></td>
      <td><a class="action" href="<?php echo url_for('/dashboard/question/show.php?id=' . h(u($bookinfo['id'])));
      ?>">View</a></td>


    </tr>
    <tr>
    <td bgcolor='<?php echo $class; ?>' colspan="6"><?php echo "Q. " . $bookinfo['question_text']; ?></td>
    </tr>
    <tr>
    <td bgcolor='<?php echo $class; ?>' colspan="6"><?php echo "A. " . $bookinfo['question_answer']; ?></td>
    </tr>

  <?php
  $x = $x + 1;
 } ?>
</table>

<?php
$_SESSION['author_first_name'] = $_POST['author_first_name'] ??'';
$_SESSION['author_last_name'] = $_POST['author_last_name'] ??'';
$_SESSION['book_title'] = $_POST['book_title'] ??'';
$_SESSION['book_publication_year'] = $_POST['book_publication_year'] ?? '';
 ?>
<br />
<a class="action" href="<?php echo url_for('/dashboard/question/new3.php');?>">Continue Creating Question</a></td>



</div>


</div>
</div>

<?php mysqli_free_result($question_set); ?>
<?php //include(SHARED_PATH . '/public_footer.php')?>
