<?php
require_once('../../../../../private/initialize.php');
require_login();

  $currentpage = $_GET['offset'] ?? 0;
  $nextpageoffset = $_GET['offset'] + 10;
  $prevpageoffset = $_GET['offset'] - 10;

  if (is_post_request()) {
    $searchquestion = [];
    $searchquestion["location"] = $_POST['location'] ?? '';
    $searchquestion["category_id"] = $_POST['category_id'] ?? '';
    $searchquestion["level_id"] = $_POST['level_id'];
    $searchquestion["author_first_name"] = $_POST['author_first_name'] ??'';
    $searchquestion["author_last_name"] = $_POST['author_last_name'] ?? '';
    $searchquestion["book_title"] = $_POST['book_title'] ?? '';
    $searchquestion["book_publication_year"] = $_POST['book_publication_year'] ?? '';
    $searchquestion["award_id"] = $_POST['award_id'] ?? '';

    $_SESSION['questionsearch.authorfirst'] = $_POST['author_first_name'] ??'';
    $_SESSION['questionsearch.authorlast'] = $_POST['author_last_name'] ??'';
    $_SESSION['questionsearch.book_title'] = $_POST['book_title'] ??'';
    $_SESSION['questionsearch.book_publication_year'] = $_POST['book_publication_year'] ?? '';
    $_SESSION['questionsearch.level'] = $_POST['level_id'] ??'';
    $_SESSION['questionsearch.category_id'] = $_POST['category_id'] ??'';
    $_SESSION['questionsearch.location'] = $_POST['location'] ??'';
    $_SESSION['questionsearch.award_id'] = $_POST['award_id'] ?? '';

    $searchquestion['offset'] = $_GET['offset'] ?? '0';
    $question_result = find_question_by_info($searchquestion);
    $all_matched_questions = find_question_by_info_no_offset($searchquestion);
    $_SESSION['rows_returned_from_db'] = mysqli_num_rows($all_matched_questions);

// copying our search result to a session variable.
} else {
    $searchquestion = [];
    $searchquestion["location"] = $_SESSION['questionsearch.location'] ?? '';
    $searchquestion["category_id"] = $_SESSION['questionsearch.category_id'] ?? '';
    $searchquestion["level_id"] = $_SESSION['questionsearch.level'];
    $searchquestion["award_id"] = $_SESSION['questionsearch.award_id'];
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

  while ($rowinfo = mysqli_fetch_assoc($rowcount)) {
      $rowcounter = $rowcounter + 1;
  }

  $rows_returned = $_SESSION['rows_returned_from_db'];

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
        <?php
        if($rows_returned == 0)
        { // there were no results so let them know this

        echo "There are<b> no questions</b> that are already in the database that match your search. ";
        echo "Use the Questions menu to the left to add your question to the database first then ";
        echo "try adding the question to this battle.";
        echo "<br /><br />";

        }
          if ($currentpage + 10 < $rows_returned) {
              $question_bracket = $currentpage + 10;
          } else {
              $question_bracket = $currentpage + ($rows_returned - $currentpage);
          }

          echo "Showing Questions " . $currentpage . " to " . $question_bracket . " of " . $rows_returned;
          echo "<br /><br />";
        ?>
          <?php if ($nextpageoffset > 10) {
            ?>
            <a class="action" href="<?php echo url_for('/dashboard/battle/round/add_questions/search2.php?offset=' . $prevpageoffset); ?>">&nbsp;&laquo&laquoPrevious 10 Results&nbsp&nbsp&nbsp&nbsp</a>
          <?php
        }
          ?>

          <?php

          if ($nextpageoffset < $total_number_questions && $rowcounter == 10) {
              ?>
        <a class="action" href="<?php echo url_for('/dashboard/battle/round/add_questions/search2.php?offset=' . $nextpageoffset); ?>">&nbsp;Next 10 Results&nbsp;&raquo&raquo</a>
        <?php
          } ?>


      <br /><br />

  <a class="back-link" href="<?php echo url_for('/dashboard/battle/round/add_questions/search.php'); ?>">Search for other questions</a><br/>

  <table class="list">
    <tr>
      <th>Title</th>
      <th>Author First</th>
      <th>Author Last</th>
      <th>Level</th>
      <th>Category</th>
      <th>Awards</th>
      <th>&nbsp;</th>
    </tr>
    </br/>

  </br>
    <?php
      $x = 0;
     ?>
  <?php while ($bookinfo = mysqli_fetch_assoc($question_result)) {
         ?>
    <?php // get friendly names for categories levels etc.
        $location_info = find_location_by_id($bookinfo['question_owner']);
         //$category_info = find_category_by_id($bookinfo['question_category']);
         $level_info = find_level_by_id($bookinfo['level_id']);
         $question_level_info = find_question_level_by_id($bookinfo['id']);
         $question_category_info = find_question_category_by_id($bookinfo['id']);
         $question_award_info = find_question_award_by_id($bookinfo['id']); ?>
    <?php
      $class = ($x%2 == 0)? '#ffffff': '#ddd'; ?>
    <tr bgcolor='<?php echo $class; ?>'>

      <td><?php echo $bookinfo['book_title']; ?></td>
      <td><?php echo $bookinfo['author_first_name']; ?></td>
      <td><?php echo $bookinfo['author_last_name']; ?></td>
      <td><?php
      //echo var_dump($question_level_info);
      foreach ($question_level_info as $level) {
          //echo $level['level_id'];
          $levelname = find_level_by_id($level['level_id']);
          echo h($levelname['level_name']) . "&nbsp";
      } ?></td>
      <td><?php
      $numcat = count($question_category_info);
         //echo var_dump($question_level_info);
         foreach ($question_category_info as $category) {
             //echo $level['level_id'];
             $categoryname = find_category_by_id($category['category_id']);
             echo h($categoryname['category']);
             echo "&nbsp";
         } ?></td>
      <td><?php
      //echo var_dump($question_level_info);
      foreach ($question_award_info as $award) {
          //echo $level['level_id'];
          $awardname = find_award_by_id($award['award_id']);
          echo h($awardname['award_name']);
          echo "&nbsp&nbsp";
      } ?></td>
      <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/add_questions/add_question_to_battle.php?id=' . h(u($bookinfo['id']))); ?>">Add to Battle</a></td>
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

</div>
</div>
</div>

<?php mysqli_free_result($question_result); ?>
<?php // include(SHARED_PATH . '/public_footer.php')?>
