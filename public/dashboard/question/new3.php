<?php

require_once('../../../private/initialize.php');
require_login();
?>

<?php $page_title = 'Create Question'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">

    <div class="question new">
      <h1>Create New Question</h1>

      <?php //echo display_errors($errors); ?>

      <form action="<?php echo url_for('/dashboard/question/new4.php')?>" method="post">

        <dl>
          <dt>Author First Name:</dt>
          <dd><input type="text" name="author_first_name" value="<?php echo $_SESSION['question.authorfirst']; ?>" /></dd>
        </dl>
        <dl>
          <dt>Author Last Name:</dt>
          <dd><input type="text" name="author_last_name" value="<?php echo $_SESSION['question.authorlast']; ?>"  /></dd>
        </dl>
        <dl>
          <dt>Book Title:</dt>
          <dd><input type="text" name="book_title" value="<?php echo $_SESSION['question.book_title']; ?>"  /></dd>
        </dl>
        <dl>
          <dt>Publication Year:</dt>
          <dd><input type="text" name="book_publication_year" value="" /></dd>
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
          <?php $category_list = find_all_categories(); ?>
          <dt>Category:</dt>
          <dd>
            <?php while($catlist = mysqli_fetch_assoc($category_list)) {
              $categoryCheckbox = '<input type="checkbox" name="category_id[]" value="';
              $categoryCheckbox .= h($catlist['id']) .'"';
              $categoryCheckbox .= ">";
              $categoryCheckbox .= h($catlist['category']) . "&nbsp;&nbsp;&nbsp;";
              echo $categoryCheckbox;
              //  echo "<option value=\"" . h($catlist['id']) . "\"";
              //  echo ">" . h($catlist['category']) . "</option>";
              }
              mysqli_free_result($category_list);
            ?>

          </dd>
        </dl>
        <br />
        </dl>
        <dl>
          <dt>Question:</dt>
          <dd><textarea name="question" class="text" value="" cols="40" rows="5"></textarea></dd>
        </dl>
        <dl>
          <dt>Answer</dt>
          <dd><textarea name="answer" class="text" value="" cols = "40" rows="3"></textarea></dd>
        </dl>
        <dl>
          <dt>Extra Notes</dt>
          <dd><textarea name="notes" class="text" value="" cols = "40" rows="3"></textarea></dd>
        </dl>


        <div id="operations">
          <input type="submit" value="Create Question" />
        </div>
      </form>

    </div>


</div>


</div>
</div>




<?php //mysqli_free_result($question_set); ?>
<?php include(SHARED_PATH . '/public_footer.php')?>
