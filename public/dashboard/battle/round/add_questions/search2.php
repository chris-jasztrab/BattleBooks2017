<?php
require_once('../../../../../private/initialize.php');
require_login();

if(is_post_request()) {

  $searchquestion = [];
  $searchquestion["location"] = $_POST['location'] ?? '';
  $searchquestion["category_id"] = $_POST['category_id'] ?? '';
  $searchquestion["level_id"] = $_POST['level_id'] ?? '';
  $searchquestion["author_first_name"] = $_POST['author_first_name'] ??'';
  $searchquestion["author_last_name"] = $_POST['author_last_name'] ?? '';
  $searchquestion["book_title"] = $_POST['book_title'] ?? '';
  $searchquestion["book_publication_year"] = $_POST['book_publication_year'] ?? '';
  $question_page['count'] = 0;
  $question_result = find_question_by_info($searchquestion, $question_page);
  $_SESSION['questionsearch.authorfirst'] = $_POST['author_first_name'] ??'';
  $_SESSION['questionsearch.authorlast'] = $_POST['author_last_name'] ??'';
  $_SESSION['questionsearch.book_title'] = $_POST['book_title'] ??'';
  $_SESSION['questionsearch.book_publication_year'] = $_POST['book_publication_year'] ?? '';
  $_SESSION['questionsearch.level'] = $_POST['level_id'] ??'';
  $_SESSION['questionsearch.category_id'] = $_POST['category_id'] ??'';
  $_SESSION['questionsearch.location'] = $_POST['location'] ??'';

  }
  elseif(isset($_SESSION['questionsearch.authorfirst'])){
    $question_page['count'] = $_GET['question_page'] ?? 0;
    $searchquestion["location"] = $_SESSION['questionsearch.location'];
    $searchquestion["category_id"] = $_SESSION['questionsearch.category_id'];
    $searchquestion["level_id"] = $_SESSION['questionsearch.level'];
    $searchquestion["author_first_name"] = $_SESSION['questionsearch.authorfirst'];
    $searchquestion["author_last_name"] = $_SESSION['questionsearch.authorlast'];
    $searchquestion["book_title"] = $_SESSION['questionsearch.book_title'];
    $searchquestion["book_publication_year"] = $_SESSION['questionsearch.book_publication_year'];
    $question_result = find_question_by_info($searchquestion, $question_page);
    } else {
     redirect_to(url_for('/public/dashboard/question/search.php'));
  }
?>

<?php $page_title = 'List Questions'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">

  <h2>Questions that match your search</h2>
  <table class="list">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Author First</th>
      <th>Author Last</th>
      <th>Category</th>
      <th>Level</th>
      <th>Location</th>
      <th>&nbsp;</th>


    </tr>
    </br/>
    <a class="back-link" href="<?php echo url_for('/dashboard/battle/round/add_questions/search.php'); ?>">&laquo; Search for other questions</a><br/>
  </br>
    <?php
      $x = 0;
     ?>
  <?php while($bookinfo = mysqli_fetch_assoc($question_result)) { ?>
    <?php // get friendly names for categories levels etc.
        $location_info = find_location_by_id($bookinfo['question_owner']);
        $category_info = find_category_by_id($bookinfo['question_category']);
        $level_info = find_level_by_id($bookinfo['level']);
        ?>
    <?php
      $class = ($x%2 == 0)? '#ffffff': '#ddd'; ?>
    <tr bgcolor='<?php echo $class; ?>'>
      <td rowspan="3"><?php echo $bookinfo['id']; ?></td>
      <td><?php echo $bookinfo['book_title']; ?></td>
      <td><?php echo $bookinfo['author_first_name']; ?></td>
      <td><?php echo $bookinfo['author_last_name']; ?></td>
      <td><?php echo h($category_info['category']); ?></td>
      <td><?php echo h($level_info['level_name']); ?></td>

      <td><?php echo h($location_info['location_name']); ?></td>
      <td><a class="action" href="<?php echo url_for('/dashboard/battle/round/add_questions/add_question_to_battle.php?id=' . h(u($bookinfo['id'])));
      ?>">Add to Battle</a></td>



    </tr>
    <tr>
    <td bgcolor='<?php echo $class; ?>' colspan="10"><?php echo "Q. " . $bookinfo['question_text']; ?></td>
    </tr>
    <tr>
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
