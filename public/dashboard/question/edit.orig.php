<?php require_once('../../../private/initialize.php');?>

<?php
require_login();
$id = $_GET['id'] ?? '1';

$editerrors = [];
if (isset($_SESSION['editerrorarray'])) {
    $editerrors = $_SESSION['editerrorarray'];
}


    if (!isset($_GET['id'])) {
        redirect_to(url_for('/dashboard/index.php'));
    }

$question = find_question_by_id($id);
$question_level_data = find_question_level_by_id($id);
$question_category_data = find_question_category_by_id($id);
$question_award_data = find_question_award_by_id($id);

foreach ($question_award_data as $award) {
    $awardname = find_award_by_id($award['award_id']);
    echo $awardname['award_name'];
  }


?>


<?php include(SHARED_PATH . '/public_header.php')?>

<head>
  <script type="text/javascript">
  <!--
  function copyAnswer(f) {
    if(f.titleisanswer.checked == true) {
      f.question_answer.value = f.book_title.value;
    }
    if(f.titleisanswer.checked == false) {
      f.answer.value = '';
    }
  }

  function showAwards(g) {
    if(g.isaward.checked == true) {
      document.getElementById('answer1').style.display = 'inline';
    }
    if(g.isaward.checked == false) {
      document.getElementById('answer1').style.display = 'none';
    }
  }

  </script>

</head>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Edit Question'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/search/search2.php?offset=' . $_SESSION['currentpageoffset']); ?>">&laquo; Back to List</a><br/>


    <form action="<?php echo url_for('/dashboard/question/edit2.php?id=' . $id . '"') ; ?> method="post">
  <div class="question show">
      <font face = "arial, verdana, sans-serif" size="+2">
        <br />
        <font color = "red">**</font> Since you are editing a question please enter in why into the notes field. <font color = "red">**</font>
      </font>

      <?php echo display_errors($editerrors); ?>
      <?php //show_session_variables();?>


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
        <dt>Book Title is Answer</dt>
        <dd><input type="checkbox" name="titleisanswer" onclick="copyAnswer(this.form)" /></dd>
      </dl>
      <dl>

      <dl>
        <dt>Answer:</dt>
          <dd><textarea name="question_answer" class="text" value="" cols="40" rows="5" required><?php echo h($question['question_answer']); ?></textarea></dd>
        <dd></dd>
      </dl>
      <dl>
      <?php $level_list = find_all_levels(); ?>
        <dt>Level:</dt>
        <dd>
        <?php while ($levlist = mysqli_fetch_assoc($level_list)) {
    $levelCheckbox = '<input type="checkbox" name="level_id[]" value="';
    $levelCheckbox .= h($levlist['id']) .'"';
    foreach ($question_level_data as $level) {
        $levelcheck = find_level_by_id($level['level_id']);
        if ($levelcheck['id'] == $levlist['id']) {
            $levelCheckbox .= " checked";
        }
    }
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
          <?php

            //echo var_dump($question_category_data);
          while ($catlist = mysqli_fetch_assoc($category_list)) {
              if ($categoryShowCount == 5) {
                  echo "<br />";
                  $categoryShowCount = 0;
              }
              $categoryCheckbox = '<input type="checkbox" name="category_id[]" value="';
              $categoryCheckbox .= h($catlist['id']) .'"';
              foreach ($question_category_data as $category) {
                  $categoryname = find_category_by_id($category['category_id']);
                  if ($categoryname['id'] == $catlist['id']) {
                      $categoryCheckbox .= " checked";
                  }
              }
              $categoryCheckbox .= ">";
              $categoryCheckbox .= h($catlist['category']) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
              echo $categoryCheckbox;
              //  echo "<option value=\"" . h($catlist['id']) . "\"";
              //  echo ">" . h($catlist['category']) . "</option>";
              $categoryShowCount = $categoryShowCount + 1;
          }
            mysqli_free_result($category_list);
          ?>

  

          <?php $awardlist = find_all_awards(); ?>
          <br />
          <select name="award[]" id="answer1" multiple size="6">
            <?php while ($awards = mysqli_fetch_assoc($awardlist)) {
              $awarddrop = '<option value ="';
              $awarddrop .= $awards['id'];
              $awarddrop .= '">';
              $awarddrop .= $awards['award_name'] . '</option>';
              echo $awarddrop;
          }
            ?>
          </select>
        </dd>
        <input type="checkbox" id="awardcheck" name="category_id[]" value="32" style="display:none;">
      </dl>


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
      <?php //echo var_dump($question_level_data) . "<br />";?>
      <?php //echo var_dump($question_category_data) . "<br />";?>
    </div>
     <input type="hidden" name="last_edited_by" value="<?php echo $_SESSION['question.owner']; ?>">
</div>

<div id="operations">
  <input type="submit" value="Update Question" />
</div>
</form>

</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
