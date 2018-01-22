<?php
require_once('../../../private/initialize.php');
require_login();

  $currentpage = $_GET['offset'] ?? 0;
  $nextpageoffset = $_GET['offset'] + 10;
  $prevpageoffset = $_GET['offset'] - 10;

if(is_post_request()) {
  $searchquestion = [];
  $searchquestion["location"] = $_POST['location'] ?? '';
  $searchquestion["category_id"] = $_POST['category_id'] ?? '';
  $searchquestion["level_id"] = $_POST['level_id'];
  $searchquestion["author_first_name"] = $_POST['author_first_name'] ??'';
  $searchquestion["author_last_name"] = $_POST['author_last_name'] ?? '';
  $searchquestion["book_title"] = $_POST['book_title'] ?? '';
  $searchquestion["book_publication_year"] = $_POST['book_publication_year'] ?? '';
  $searchquestion['offset'] = $_GET['offset'] ?? '0';
  $question_result = find_question_by_info($searchquestion);
// copying our search result to a session variable.
}
else {
$searchquestion = [];
$searchquestion["location"] = $_SESSION['questionsearch.location'] ?? '';
$searchquestion["category_id"] = $_SESSION['questionsearch.category_id'] ?? '';
$searchquestion["level_id"] = $_SESSION['questionsearch.level'];
$searchquestion["author_first_name"] = $_SESSION['questionsearch.authorfirst'] ??'';
$searchquestion["author_last_name"] = $_SESSION['questionsearch.authorlast'] ?? '';
$searchquestion["book_title"] = $_SESSION['questionsearch.book_title'] ?? '';
$searchquestion["book_publication_year"] = $_SESSION['questionsearch.book_publication_year'] ?? '';
$searchquestion['offset'] = $_GET['offset'] ?? '0';
$question_result = find_question_by_info($searchquestion);
}

  //ghetto way to figure out # of rows i am getting from the DB
  $rowcount = find_question_by_info($searchquestion);
  $rowcounter = 0;
  while($rowinfo = mysqli_fetch_assoc($rowcount)) {
    $rowcounter = $rowcounter + 1;
  }

  $_SESSION['questionsearch.authorfirst'] = $_POST['author_first_name'] ??'';
  $_SESSION['questionsearch.authorlast'] = $_POST['author_last_name'] ??'';
  $_SESSION['questionsearch.book_title'] = $_POST['book_title'] ??'';
  $_SESSION['questionsearch.book_publication_year'] = $_POST['book_publication_year'] ?? '';
  $_SESSION['questionsearch.level'] = $_POST['level_id'] ??'';
  $_SESSION['questionsearch.category_id'] = $_POST['category_id'] ??'';
  $_SESSION['questionsearch.location'] = $_POST['location'] ??'';
  $_SESSION['currentpageoffset'] = $currentpage;
  $total_number_questions = find_number_of_questions();
?>

<?php $page_title = 'List Questions'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">

  <h2>Questions that match your search</h2>

    <?php if($nextpageoffset > 10)
    {
      ?>
      <a class="action" href="<?php echo url_for('/dashboard/search/search2.php?offset=' . $prevpageoffset);
      ?>">&nbsp;&laquo&laquoPrevious 10 Results</a>
    <?php
      }
    ?>

    <?php

    if($nextpageoffset < $total_number_questions && $rowcounter == 10)
    {
   ?>
  <a class="action" href="<?php echo url_for('/dashboard/search/search2.php?offset=' . $nextpageoffset);
  ?>">&nbsp;Next 10 Results&nbsp;&raquo&raquo</a>
  <?php } ?>





    <a class="back-link" href="<?php echo url_for('/dashboard/search/search.php'); ?>">Search for other questions</a><br/>

  <br />

  <table class="list">
    <tr>

      <th>Title</th>
      <th>Author First</th>
      <th>Author Last</th>

      <th>Level</th>
      <th>Location</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    </br/>

    <?php
      $x = 0;
     ?>
  <?php while($bookinfo = mysqli_fetch_assoc($question_result)) { ?>
    <?php
        //var_dump($bookinfo);// get friendly names for categories levels etc.
        $location_info = find_location_by_id($bookinfo['question_owner']);
        //$category_info = find_category_by_id($bookinfo['question_category']);
        $level_info = find_level_by_id($bookinfo['level_id']);
        ?>
    <?php
      $class = ($x%2 == 0)? '#ffffff': '#ddd'; ?>
    <tr bgcolor='<?php echo $class; ?>'>

      <td><?php echo $bookinfo['book_title']; ?></td>
      <td><?php echo $bookinfo['author_first_name']; ?></td>
      <td><?php echo $bookinfo['author_last_name']; ?></td>

      <td><?php echo h($level_info['level_name']); ?></td>

      <td><?php echo h($location_info['location_name']); ?></td>
      <td><a class="action" href="<?php echo url_for('/dashboard/search/show.php?id=' . h(u($bookinfo['id'])));
      ?>">&nbsp;View&nbsp;</a></td>
      <td><a class="action" href="<?php echo
      url_for('/dashboard/question/edit.php?id=' . h(u($bookinfo['id'])));
      ?>">&nbsp;Edit&nbsp;</a></td>
      <td><a class="action" href="<?php echo url_for('/dashboard/search/delete.php?id=' . h(u($bookinfo['id'])));
      ?>">&nbsp;Delete</a></td>
    </tr>
    <tr>
    <td bgcolor='<?php echo $class; ?>' colspan="10"><?php echo "Q. " . $bookinfo['question_text']; ?></td>
    </tr>
    <tr style="border-bottom: solid thick;">
    <td bgcolor='<?php echo $class; ?>' colspan="10"><?php echo "A. " . $bookinfo['question_answer']; ?></td>
    </tr>


  <?php
  $x = $x + 1;
 } ?>
</table>


<form action="<?php echo url_for('/dashboard/question/search3.php')?>" method="post">
<input type="hidden" name="author_first_name" value="<?php echo $_POST['author_first_name']; ?>">
<input type="hidden" name="author_last_name" value="<?php echo $_POST['author_last_name']; ?>">
<input type="hidden" name="book_title" value="<?php echo $_POST['book_title']; ?>">
<br />

</form>


</br>

</div>


</div>
</div>

<?php mysqli_free_result($question_result); ?>
<?php // include(SHARED_PATH . '/public_footer.php')?>
