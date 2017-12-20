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
TD{font-family: Arial; font-size: 12pt;}
--->
</STYLE>
</head>
<body>
  <font face = "arial, verdana, sans-serif" >

        <?php $page_title = 'Print Battle'; ?>
        <div class="battle show">

            <?php $location = find_location_by_id($battle['owner']); ?>
            <?php echo h($battle['name']); ?>

          <hr>
          <table>
          <?php while($roundlist = mysqli_fetch_assoc($rounds_in_battle)) {
            $questions = find_all_questions_in_round($roundlist['id']); ?>

        <?php echo $roundlist['round_name']?>

            <table class="list">
              <tr>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
              <?php
                $count = 1;
                while($question_data = mysqli_fetch_assoc($questions)) {
                  $question_detail = find_question_by_id($question_data['question_id']); ?>
                  <tr>
                    <td rowspan="3"><?php echo $count;
                    $count = $count + 1; ?></td>
                   </tr>
                   <tr>
                     <td><?php echo "Q. " . $question_detail['question_text']; ?></td>
                   </tr>
                   <tr>
                     <td><?php echo "A. " . $question_detail['question_answer'] . "  -  Book: " . $question_detail['book_title']; ?><p>
                     </td>
                   </tr>


              <?php } // question loop closing

                   ?>

              </table>
              <hr />
            </table>
            <?php } // round while loop closing ?>
<a class="back-link" href="<?php echo url_for('/dashboard/battle/show.php?id=' . $_SESSION['battle_id']); ?>">&laquo; Back to Battle Page</a><br/>
    </font>
  </body>
