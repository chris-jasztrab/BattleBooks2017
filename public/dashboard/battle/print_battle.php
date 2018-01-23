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
          <?php while ($roundlist = mysqli_fetch_assoc($rounds_in_battle)) {
    $questions = find_all_questions_in_round($roundlist['id']); ?>

            <h3><?php echo $roundlist['round_name']?></h3>
          <?php
            if (is_blank($roundlist['round_preamble'])) {
                $roundlist['round_preamble'] = 'none';
            }
    if (is_blank($roundlist['round_notes'])) {
        $roundlist['round_notes'] = 'none';
    } ?>

            <?php echo $roundlist['round_preamble']; ?><br />
            <?php echo $roundlist['round_notes']; ?><br />

            <table class="list">
              <tr>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
              <?php
                $count = 1;
    while ($question_data = mysqli_fetch_assoc($questions)) {
        $question_detail = find_question_by_id($question_data['question_id']); ?>
                  <tr>
                    <td rowspan="3"><?php echo $count;
        $count = $count + 1; ?></td>
                   </tr>
                   <tr>
                     <td><b><?php echo "Q. " . $question_detail['question_text']; ?></b></td>
                   </tr>
                   <tr>
                     <td><?php echo "A. " . $question_detail['question_answer'] . " by " . $question_detail['author_first_name'] . " " . $question_detail['author_last_name']; ?><p>

                     </td>
                   </tr>

              <?php
    } // question loop closing

                   ?>

              </table>
              <hr />
            </table>
            <?php
} // round while loop closing?>

    </font>
  </body>
