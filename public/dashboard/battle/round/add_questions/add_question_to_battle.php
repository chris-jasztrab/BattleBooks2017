<?php require_once('../../../../../private/initialize.php');?>

<?php
require_login();
$id = $_GET['id'] ?? '1';

$question = find_question_by_id($id);
$inbattle = is_question_in_battle($question['id'], $_SESSION['battle_id']);
$question_category_info = find_question_category_by_id($id);
$question_level_info = find_question_level_by_id($id);
$question_award_info = find_question_award_by_id($id);

//show_session_variables();
?>

<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Create Question'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/battle/round/add_questions/search2.php?offset=' . $_SESSION['currentpageoffset']); ?>">&laquo; Back to Search</a><br/>

  <div class="question show">

    <h1>Title: <?php echo h($question['book_title']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($question['id']); ?></dd>
      </dl>
      <dl>
        <dt>Book Title:</dt>
        <dd><?php echo h($question['book_title']); ?></dd>
      </dl>
        <dl>
        <dt>Author First:</dt>
        <dd><?php echo h($question['author_first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Author Last:</dt>
        <dd><?php echo h($question['author_last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Publication Year:</dt>
        <dd><?php echo h($question['book_publication_year']); ?></dd>
      </dl>
      <dl>
        <dt>Question</dt>
        <dd><?php echo h($question['question_text']); ?></dd>
      </dl>
      <dl>
        <dt>Answer:</dt>
        <dd><?php echo h($question['question_answer']); ?></dd>
      </dl>
      <dl>
        <dt>Level:</dt>
          <dd> <?php
          //echo var_dump($question_level_info);
          foreach($question_level_info as $level)
          {
            //echo $level['level_id'];
            $levelname = find_level_by_id($level['level_id']);
            echo h($levelname['level_name']);
            echo "&nbsp&nbsp";
          }
            ?></dd>
      </dl>
      <dl>
        <dt>Category:</dt>
        <dd> <?php
        $numcat = count($question_category_info);
        //echo var_dump($question_level_info);
        foreach($question_category_info as $category)
        {
          $categoryname = find_category_by_id($category['category_id']);
          echo h($categoryname['category']);
            echo "&nbsp&nbsp";
        }  ?></dd>

      </dl>
      <dl>
        <dt>Awards:</dt>
        <dd> <?php
        //echo var_dump($question_level_info);
        foreach($question_award_info as $award)
        {
          //echo $level['level_id'];
          $awardname = find_award_by_id($award['award_id']);
          echo h($awardname['award_name']);
              echo "&nbsp&nbsp";

          }
          ?></dd>

      </dl>
      <dl>
        <dt>Owner:</dt>
        <?php $owner_name = find_location_by_id($question['question_owner']); ?>
        <dd><?php echo h($owner_name['location_name']); ?></dd>
      </dl>

      <dl>
        <dt>Notes:</dt>
        <dd><?php echo h($question['notes']); ?></dd>
      </dl>

      <dl>
        <dt>Question History:</dt>
        <p>
          &nbsp;
        </p>
        <?php $history = find_battle_info_by_question_id($id); ?>
            <table>
              <table class="list">
                <tr>
                  <th>Battle Name</th>
                  <th>Round Name</th>
                </tr>
                <tr>
                  <?php foreach ($history as $battle_data) { ?>
                  <td><?php echo $battle_data['name']; ?></td>
                  <td><?php echo $battle_data['round_name']; ?></td>
                </tr>
                <?php } ?>
    </table>

      </dl>

    </div>
    <br />
    <?php
    if(!empty($inbattle))
    {
      ?>
        <font face = "arial, verdana, sans-serif" size="+2" color="red">

      This question is already in this battle click below to still add it

      <br />
      <br />
     </font>
    <?php }
    ?>
    <?php
    $battle_info = find_battle_by_id($_SESSION['battle_id']);
    $battle_name = $battle_info['name']; ?>
    <a class="action" href="<?php echo url_for('/dashboard/battle/round/add_questions/add_question_to_battle_2.php?id=' . $id); ?>">
    Add this question to the Battle Named: <?php echo $battle_name; ?></a>
    <?php
    $round_info = find_round_by_id($id);
    $questions = $round_info['round_questions'];
    $question_array = explode(',',$questions);
?>
</div>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
