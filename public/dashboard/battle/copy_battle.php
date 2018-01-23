<?php require_once('../../../private/initialize.php');?>
<?php require_login();?>
<?php
if (is_post_request()) {

  //handle the variables sent by copy_battle.php

    $level = [];
    $level['level_name'] = $_POST['level_name'] ?? '';
    $level['position'] = $_POST['position'] ?? '';
    $level['visible'] = $_POST['visible'] ?? '';

    $battle = [];
    $battle["battle_name"] = $_POST["battle_name"];
    $battle["battle_preamble"] =  $_POST["battle_preamble"];
    $battle["battle_level"] = $_POST["battle_level"];
    $battle["notes"] =  $_POST["notes"];
    $battle['owner'] = $_SESSION['question.owner'] ?? '0';
    //insert the battle
    $result = insert_battle($battle);
    // if battle inserted OK get the ID
    if ($result === true) {
        $new_battle_id = mysqli_insert_id($db);
        // write the new battle ID to a session variable
        $_SESSION['new_battle_id'] = $new_battle_id;
        // get all the rounds from the battle we are copying
        $rounds_in_battle = find_rounds_by_battleid($_SESSION['copied_battle_id']);
        //iterate through the rounds - BEGIN ROUND LOOP
        while ($roundlist = mysqli_fetch_assoc($rounds_in_battle)) {
            //grab all the questions from this round
            $questions = find_all_questions_in_round($roundlist['id']);
            // create an empty round and fill it up with details from the round we are copying
            $round = [];
            $round["round_name"] = $roundlist['round_name'] ?? '';
            $round["round_preamble"] = $roundlist['round_preamble'] ?? '';
            $round["round_notes"] = $roundlist['round_notes'] ?? '';
            $round['battle_id'] = $new_battle_id ?? '';
            //insert that round into the DB with the new battleID
            $add_round_result = insert_round($round);
            // if we were able to insert the round we want to add all the questions into it
            if ($add_round_result === true) {
                // get my new round ID
                $new_round_id = mysqli_insert_id($db);
                $_SESSION['new_round_id'] = $new_round_id;
                //BEGIN QUEST LOOP
                while ($questionlist = mysqli_fetch_assoc($questions)) {
                    //create an empty question and fill it up with details from the q. we are copying
                    // since questions aren't uniqiue, we only need the quest ID and round ID.
                    $question_id = $questionlist['question_id'];
                    $round_id = $new_round_id;
                    $question_result = add_question_to_round($round_id, $question_id);
                } // END QUEST LOOP
            } // END IF LOOP LINE 41
        } // END ROUND LOOP
    } // END IF LOOP WHERE WE TRIED TO ADD A BATTLE IN
     redirect_to(url_for('/dashboard/battle/show.php?id=' . $new_battle_id));
} // END IF IS POST REQUEST STATEMENT


 ?>

<?php
  $id = $_GET['id'] ?? '1';
  $copiedbattle = find_battle_by_id($id);
  $_SESSION['copied_battle_id'] = $copiedbattle['id'];

  $battle = [];
  $battle["battle_name"] = '';
  $battle["battle_preamble"] =  '';
  $battle["battle_level"] = '';
  $battle["notes"] =  '';
  $battle['owner'] = $_SESSION['question.owner'] ?? '0';
// GET TOTAL # OF QUESTIONS IN DB
  $battle_set = find_all_battles();
  $battle_count = mysqli_num_rows($battle_set) + 1;
  mysqli_free_result($battle_set);
?>


<head>
  <STYLE TYPE="text/css">
<!-- TD{font-family: Arial; font-size: 14pt;}
--->
</STYLE>

</head>


<?php $page_title = 'Copy Battle'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Copy Battle'; ?>


  <div class="copy battle new">
    <?php $location_info = find_location_by_id($_SESSION['question.owner']);
    $location_name = $location_info['location_name'];
    ?>
    <h1>Copy Battle <?php echo $copiedbattle['name'] ?> to <?php echo $location_name;?>'s Battles</h1>

    <?php //echo display_errors($errors);?>

    <form action="<?php echo url_for('/dashboard/battle/copy_battle.php')?>" method="post">

      <dl>
        <dt>New Battle Name:</dt>
        <dd><input type="text" name="battle_name" value="" /></dd>
      </dl>
      <dl>
        <dt>New Battle Level:</dt>
        <dd>
              <select name="battle_level">
              <?php $level_list = find_all_levels(); ?>
              <?php while ($levlist = mysqli_fetch_assoc($level_list)) {
        echo "<option value=\"" . h($levlist['id']) . "\"";
        echo ">" . h($levlist['level_name']) . "</option>";
    }
                mysqli_free_result($level_list);
              ?>
              </select></dd>
      </dl>

      <dl>
        <dt>Battle Preamble:</dt>
        <dd><textarea name="battle_preamble" class="text" value="" cols = "60" rows="6"></textarea></dd>
      </dl>
      <dl>
        <dt>Notes:</dt>
        <dd><textarea name="notes" class="text" value="" cols = "60" rows="6"></textarea></dd>

      </dl>


      <div id="operations">
        <input type="submit" value="Copy Battle" />
        <a class="back-link" href="<?php echo url_for('/dashboard/index.php'); ?>"> <br /><br />&laquo; Cancel and go back to the Dashboard</a><br/>
      </div>
    </form>

  </div>

</div>


    </div>


  </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php')?>
