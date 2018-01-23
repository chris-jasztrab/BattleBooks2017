<?php require_once('../../../private/initialize.php');?>
<?php require_login();?>
<?php
  $id = $_GET['id'] ?? '1';
  $battle = find_battle_by_id($id);
  $rounds_in_battle = find_rounds_by_battleid($id);
  $_SESSION['battle_id'] = $battle['id'];
  $authors = array();
?>
<head>
  <STYLE TYPE="text/css">
<!--
TD{font-family: Arial; font-size: 14pt;}
--->
</STYLE>
</head>
<body>
  <font face = "arial, verdana, sans-serif" size="+2">

        <?php $page_title = 'Author List'; ?>
        <div class="author list">
          <center>
            <?php $location = find_location_by_id($battle['owner']); ?>
            <h2><?php echo h($location['location_name']) . " Battle of the Books " .  date('Y');  ?></h2>

            <h2></h2>
            <h1><?php echo h($battle['name']); ?></h1>
          </center>

          <table>
          <?php while ($roundlist = mysqli_fetch_assoc($rounds_in_battle)) {
    $questions = find_all_questions_in_round($roundlist['id']); ?>

            <table class="list">
              <ul>
              <?php
                $count = 1;
    while ($question_data = mysqli_fetch_assoc($questions)) {
        $question_detail = find_question_by_id($question_data['question_id']); ?>
                  <tr>

                  <?php
                    //echo $question_detail['author_first_name'] . " " . $question_detail['author_last_name'];
                    $author_name = $question_detail['author_first_name'] . " " . $question_detail['author_last_name'];
        if (in_array($author_name, $authors)) {
            //echo $question_detail['author_first_name'] . " " . $question_detail['author_last_name'] . " Already in list";
        } else {
            //echo "Adding " . $author_name . " to the list.";
            array_push($authors, $author_name);
        } ?>
                  </li>

              <?php
    } // question loop closing
                    ?>
                      </tr>
                   </ul>
              </table>

            </table>
            <?php
} // round while loop closing?>

            <?php
            foreach ($authors as $author_detail) {
                echo "<li>";
                echo $author_detail;
                echo "</li>";
            }
               ?>

    </font>
  </body>
