<?php require_once('../../../private/initialize.php');?>
<?php require_login();?>
<?php
  $id = $_GET['id'] ?? '1';
  $battle = find_battle_by_id($id);
  $rounds_in_battle = find_rounds_by_battleid($id);
  $_SESSION['battle_id'] = $battle['id'];
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

        <?php $page_title = 'Print Battle'; ?>
        <div class="battle show">
          <center>
            <?php $location = find_location_by_id($battle['owner']); ?>
            <h2><?php echo h($location['location_name']) . " Battle of the Books " .  date('Y');  ?></h2>

            <h2></h2>
            <h1><?php echo h($battle['name']); ?></h1>
          </center>
          <hr>
          <table>
          <?php while($roundlist = mysqli_fetch_assoc($rounds_in_battle)) {
            $questions = find_all_questions_in_round($roundlist['id']); ?>

            <table class="list">
              <tr>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
              <ul>



              <?php
                $count = 1;
                while($question_data = mysqli_fetch_assoc($questions)) {
                  $question_detail = find_question_by_id($question_data['question_id']); ?>
                  <tr>
                  <li>
                  <?php echo $question_detail['author_first_name'] . " " . $question_detail['author_last_name']; ?>
                  </li>
                   </tr>

              <?php } // question loop closing
                    ?>

                   </ul>

              </table>
              <hr />
            </table>
            <?php } // round while loop closing ?>

    </font>
  </body>
