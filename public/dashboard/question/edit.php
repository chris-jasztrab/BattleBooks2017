<?php

require_once('../../../private/initialize.php');
require_login();
if (isset($_SESSION['errorarray'])) {
    $errors = $_SESSION['errorarray'];
}

//unset($_SESSION['editquestionid']);
$id = $_GET['id'] ?? '1';
$question = find_question_by_id($id);
$question_level_data = find_question_level_by_id($id);
$question_category_data = find_question_category_by_id($id);
$question_award_data = find_question_award_by_id($id);
$is_award_winner = mysqli_num_rows($question_award_data);


$_SESSION['editquestionid'] = $_GET['id'];


?>
<head>
  <script type="text/javascript">
  <!--
  function copyAnswer(f) {
    if(f.titleisanswer.checked == true) {
      f.answer.value = f.book_title.value;
    }
    if(f.titleisanswer.checked == false) {
      f.answer.value = '';
    }
  }

  function showAwards(g) {
    if(g.isaward.checked == true) {
      document.getElementById('answer1').style.display = 'inline';
      document.getElementById('awardcheck').checked = true;
    }
    if(g.isaward.checked == false) {
      document.getElementById('answer1').style.display = 'none';
      document.getElementById('awardcheck').checked = false;
    }
  }

  </script>

</head>
<?php $page_title = 'Create Question'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">


    <style type="text/css">
    #answer1 {display:none;}
    <?php
    if ($is_award_winner > 0)
    {
      echo "#answer1 {display:inline;}";
    }
     ?>

    </style>


    <div class="question new">
      <h1>Update Question</h1>


      <font face = "arial, verdana, sans-serif" size="+2">
        <br />
        <font color = "red">**</font> Since you are editing a question please enter in why into the notes field. <font color = "red">**</font>
      </font>
      <br /><br />

      <?php echo display_errors($errors); ?>
      <?php //show_session_variables();?>

      <form action="<?php echo url_for('/dashboard/question/edit2.php')?>" method="post">

        <dl>
          <dt>Author First Name:</dt>
          <dd><input type="text" name="author_first_name" value="<?php echo h($question['author_first_name']); ?>" required /></dd>
        </dl>
        <dl>
          <dt>Author Last Name:</dt>
          <dd><input type="text" name="author_last_name" value="<?php echo h($question['author_last_name']); ?>" required  /></dd>
        </dl>
        <dl>
          <dt>Book Title:</dt>
          <dd><input type="text" name="book_title" value="<?php echo h($question['book_title']); ?>" required /></dd>
        </dl>
        <dl>
          <dt>Publication Year:</dt>
          <dd><input type="text" name="book_publication_year" value="<?php echo h($question['book_publication_year']); ?>" required/></dd>
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
            while ($catlist = mysqli_fetch_assoc($category_list)) {
                if ($categoryShowCount == 5) {
                    echo "<br />";
                    $categoryShowCount = 0;
                }
                $catid = $catlist['id'];

                $categoryCheckbox = '<input type="checkbox" ';
                if ($catlist['id'] == 32) {
                    $categoryCheckbox .= 'name="isaward"';
                } else {
                    $categoryCheckbox .= 'name="category_id[]"';
                }
                $categoryCheckbox .= 'value="';
                $categoryCheckbox .= h($catlist['id']) .'" ';
                if ($catlist['id'] == 32) {
                    $categoryCheckbox .= 'onclick="showAwards(this.form)"';
                }
                foreach ($question_category_data as $category) {
                    $categoryname = find_category_by_id($category['category_id']);
                    if ($categoryname['id'] == $catlist['id']) {
                        $categoryCheckbox .= " checked";
                    }
                    if($is_award_winner != 0 && $catlist['id'] == 32)
                    {
                      $categoryCheckbox .= " checked";
                    }

                }
                $categoryCheckbox .= ">";
                $categoryCheckbox .= h($catlist['category']) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo $categoryCheckbox;

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
                $awarddrop .= '" ';
                foreach ($question_award_data as $award_detail) {
                  $awardinfo = find_award_by_id($award_detail['award_id']);
                  if($awardinfo['id'] == $awards['id'])
                  {
                    $awarddrop .= " selected ";
                  }
                }
                $awarddrop .= '">';

                $awarddrop .= $awards['award_name'];

                $awarddrop .= ' </option>';
                echo $awarddrop;
            }
              ?>
            </select>
          </dd>
          <input type="checkbox" id="awardcheck" name="category_id[]" value="32" style="display:none;">
        </dl>

        <br />
        </dl>
      <br />



        <dl>
          <dt>Question:</dt>
          <dd><textarea name="question_text" class="text" value="" cols="40" rows="5" required><?php echo h($question['question_text']); ?></textarea></dd>
        </dl>

        <dl>
          <dt>Answer</dt>
          <dd><textarea name="question_answer" class="text" value="" cols = "40" rows="3" required><?php echo h($question['question_answer']); ?></textarea></dd>
        </dl>
        <dl>
          <dt>Extra Notes</dt>
          <dd><textarea name="notes" class="text" value="" cols = "40" rows="3"><?php echo h($question['notes']); ?></textarea></dd>
        </dl>


        <div id="operations">
          <input type="submit" value="Update Question" />
        </div>
      </form>

    </div>


</div>


</div>
</div>




<?php //mysqli_free_result($question_set);?>
<?php include(SHARED_PATH . '/public_footer.php')?>
