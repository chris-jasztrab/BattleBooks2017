<?php require_once('../../../private/initialize.php');?>
<?php require_login();

$id = $_GET['id'] ?? '1';

$question = find_question_by_id($id);
$question_level_info = find_question_level_by_id($id);
$question_category_info = find_question_category_by_id($id);
$question_award_info = find_question_award_by_id($id);

?>

<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">
<?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
  <div id="page">
  <div id="content">
    <?php $page_title = 'Create Question'; ?>

<a class="back-link" href="<?php echo url_for('/dashboard/search/search2.php?offset=' . $_SESSION['currentpageoffset']); ?>">&laquo; Back to List</a><br/>

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
            echo h($levelname['level_name']) . "&nbsp&nbsp";
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
          //echo $level['level_id'];
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
      <dl>
        <dt>Owner:</dt>
        <?php $owner_name = find_location_by_id($question['question_owner']); ?>
        <dd><?php echo h($owner_name['location_name']); ?></dd>
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

</div>
</div>
</div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
