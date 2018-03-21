<?php

require_once('../../../private/initialize.php');
require_login();
if (isset($_SESSION['errorarray'])) {
    $errors = $_SESSION['errorarray'];
}
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
    </style>


    <div class="question new">
      <h1>Create New Question</h1>

      <?php echo display_errors($errors); ?>
      <?php //show_session_variables();?>

      <form action="<?php echo url_for('/dashboard/question/new4.php')?>" method="post">

        <dl>
          <dt>Author First Name:</dt>
          <dd><input type="text" name="author_first_name" value="<?php if (isset($_SESSION['question.authorfirst'])) {
    echo $_SESSION['question.authorfirst'];
} ?>" required /></dd>
        </dl>
        <dl>
          <dt>Author Last Name:</dt>
          <dd><input type="text" name="author_last_name" value="<?php if (isset($_SESSION['question.authorlast'])) {
    echo $_SESSION['question.authorlast'];
} ?>" required  /></dd>
        </dl>
        <dl>
          <dt>Book Title:</dt>
          <dd><input type="text" name="book_title" value="<?php if (isset($_SESSION['question.book_title'])) {
    echo $_SESSION['question.book_title'];
} ?>" required /></dd>
        </dl>
        <dl>
          <dt>Publication Year:</dt>
          <dd><input type="text" name="book_publication_year" value="<?php if (isset($_SESSION['question.book_publication_year'])) {
    echo $_SESSION['question.book_publication_year'];
} ?>" required/></dd>
        </dl>


        <dl>
        <?php $level_list = find_all_levels(); ?>
          <dt>Level:</dt>
          <dd>

          <?php while ($levlist = mysqli_fetch_assoc($level_list)) {
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
                $awarddrop .= '">';
                $awarddrop .= $awards['award_name'] . '</option>';
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
          <dd><textarea name="question" class="text" value="" cols="40" rows="5" required><?php if (isset($_SESSION['question_text'])) {
                  echo $_SESSION['question_text'];
              } ?></textarea></dd>
        </dl>
        <dl>
          <dt>Book Title is Answer</dt>
          <dd><input type="checkbox" name="titleisanswer" onclick="copyAnswer(this.form)" /></dd>
        </dl>
        <dl>
          <dt>Answer</dt>
          <dd><textarea name="answer" class="text" value="" cols = "40" rows="3" required><?php if (isset($_SESSION['question_answer'])) {
                  echo $_SESSION['question_answer'];
              } ?></textarea></dd>
        </dl>
        <dl>
          <dt>Extra Notes</dt>
          <dd><textarea name="notes" class="text" value="" cols = "40" rows="3"><?php if (isset($_SESSION['notes'])) {
                  echo $_SESSION['notes'];
              } ?></textarea></dd>
        </dl>


        <div id="operations">
          <input type="submit" value="Create Question" />
        </div>
      </form>

    </div>


</div>


</div>
</div>




<?php //mysqli_free_result($question_set);?>
<?php include(SHARED_PATH . '/public_footer.php')?>
