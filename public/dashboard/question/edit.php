<?php require_once('../../../private/initialize.php');?>

<?php
require_login();
$id = $_GET['id'] ?? '1';

if(is_post_request())
{

  $question = [];
  $question['id'] = $id;
  $question['author_first_name'] = $_POST['author_first_name'];
  $question['author_last_name'] = $_POST['author_last_name'];
  $question['book_publication_year'] = $_POST['book_publication_year'];
  $question['book_title'] = $_POST['book_title'];
  $question['level'] = $_POST['level'];
  $question['notes'] = $_POST['notes'];
  $question['question_answer'] = $_POST['question_answer'];
  $question['question_category'] = $_POST['question_category'];
  $question['question_text'] = $_POST['question_text'];
  $question['last_edited_by'] = $_SESSION['question.owner'];

  $result = update_question($question);
  if($result === true)
  {
    redirect_to(url_for('/dashboard/search/show.php?id=' . $id));
  }
  //else
//  {
  //  $errors = $result;
    //var_dump($errors);
//  }
  else
  {
    if(!isset($_GET['id']))
    {
    redirect_to(url_for('/dashboard/index.php'));
    }
  }
}

$question = find_question_by_id($id);

?>

<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Edit Question'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/search/search2.php'); ?>">&laquo; Back to List</a><br/>

  <div class="question show">

    <h1>Title: <?php echo h($question['book_title']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($question['id']); ?></dd>
      </dl>
      <dl>
        <dt>Book Title:</dt>
        <dd><input type="text" name="book_title" value="<?php echo h($question['book_title']); ?>" /></dd>
      </dl>
        <dl>
        <dt>Author First:</dt>
        <dd><input type="text" name="author_first_name" value="<?php echo h($question['author_first_name']); ?>" /></dd>

      </dl>
      <dl>
        <dt>Author Last:</dt>
        <dd><input type="text" name="author_last_name" value="<?php echo h($question['author_last_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Publication Year:</dt>
          <dd><input type="text" name="book_publication_year" value="<?php echo h($question['book_publication_year']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Question</dt>
        <dd><textarea name="question_text" class="text" value="" cols="40" rows="5" required><?php echo h($question['question_text']); ?></textarea></dd>
      </dl>
      <dl>
        <dt>Answer:</dt>
          <dd><textarea name="question_answer" class="text" value="" cols="40" rows="5" required><?php echo h($question['question_answer']); ?></textarea></dd>
        <dd></dd>
      </dl>
      <dl>
      <?php $level_list = find_all_levels(); ?>
        <dt>Level:</dt>
        <dd>
        <?php while($levlist = mysqli_fetch_assoc($level_list)) {

          $levelCheckbox = '<input type="checkbox" name="level_id[]" value="';
          $levelCheckbox .= h($levlist['id']) .'"';
          $levelCheckbox .= ">";
          $levelCheckbox .= h($levlist['level_name']) . "&nbsp;&nbsp;&nbsp;";
          echo $levelCheckbox;

          //echo "<input type='checkbox' name='level_name' value='" . h($levlist['id']) . ">" . h($levlist['level_name']) . "  ";
          }
          mysqli_free_result($level_list);
        ?>
        </dd>
      </dl>
      <br />
      <dl>
        <?php $categoryShowCount = 0; ?>
        <?php $category_list = find_all_categories(); ?>
        <dt>Category:</dt>
        <dd>
          <?php while($catlist = mysqli_fetch_assoc($category_list)) {
            if($categoryShowCount == 5)
             {
                echo "<br />";
                $categoryShowCount = 0;
              }
            $categoryCheckbox = '<input type="checkbox" name="category_id[]" value="';
            $categoryCheckbox .= h($catlist['id']) .'"';
            $categoryCheckbox .= ">";
            $categoryCheckbox .= h($catlist['category']) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo $categoryCheckbox;
            //  echo "<option value=\"" . h($catlist['id']) . "\"";
            //  echo ">" . h($catlist['category']) . "</option>";
            $categoryShowCount = $categoryShowCount + 1;
            }
            mysqli_free_result($category_list);
          ?>

        </dd>
      </dl>
      <br />
      </dl>
      <dl>
        <dt>Owner:</dt>
        <?php $owner_name = find_location_by_id($question['question_owner']); ?>
        <dd><?php echo h($owner_name['location_name']); ?></dd>
      </dl>

      <dl>
        <dt>Notes:</dt>
          <dd><textarea name="notes" class="text" value="" cols="40" rows="5" required><?php echo h($question['notes']); ?></textarea></dd>
      </dl>

    </div>

</div>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
