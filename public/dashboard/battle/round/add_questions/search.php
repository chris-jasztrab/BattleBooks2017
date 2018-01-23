<?php
require_once('../../../../../private/initialize.php');
require_login();

if (is_post_request()) {
    $searchquestion = [];
    $searchquestion["location"] = $_POST['location'] ?? '';
    $searchquestion["category_id"] = $_POST['category_id'] ?? '';
    $searchquestion["level_id"] = $_POST['level_id'] ?? '';
    $searchquestion["author_first_name"] = $_POST['author_first_name'] ??'';
    $searchquestion["author_last_name"] = $_POST['author_last_name'] ?? '';
    $searchquestion["book_title"] = $_POST['book_title'] ?? '';
    $searchquestion["book_publication_year"] = $_POST['book_publication_year'] ?? '';
} else {
    // display the blank form
    $searchquestion = [];
    $searchquestion["location"] = '';
    $searchquestion["category_id"] = '';
    $searchquestion["level_id"] = '';
    $searchquestion["author_first_name"] = '';
    $searchquestion["author_last_name"] = '';
    $searchquestion["book_title"] = '';
    $searchquestion["book_publication_year"] = '';
}
// GET TOTAL # OF QUESTIONS IN DB
$question_set = find_all_questions();
$question_count = mysqli_num_rows($question_set) + 1;
mysqli_free_result($question_set);
?>

<?php $page_title = 'Search Questions'; ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

<div id="page">

  <div id="content">

  <?php $page_title = 'Search'; ?>


  <div class="question new">
    <?php
    $battle_info = find_battle_by_id($_SESSION['battle_id']);
    $battle_name = $battle_info['name']; ?>
    <a class="back-link" href="<?php echo url_for('/dashboard/battle/round/show.php?id=' . $_SESSION['current_round']); ?>">&laquo; Back to Round</a><br/>
    <h1>Search For Questions To Add To Battle <?php echo $battle_name; ?></h1>

    <?php //echo display_errors($errors);?>

    <form action="<?php echo url_for('/dashboard/battle/round/add_questions/search2.php?offset=0')?>" method="post">

      <dl>
        <dt>Author First Name:</dt>
        <dd><input type="text" name="author_first_name" value=""/></dd>
      </dl>
      <dl>
        <dt>Author Last Name:</dt>
        <dd><input type="text" name="author_last_name" value=""  /></dd>
      </dl>
      <dl>
        <dt>Book Title:</dt>
        <dd><input type="text" name="book_title" value=""  /></dd>
      </dl>
      <dl>
        <dt>Publication Year</dt>
        <dd><input type="text" name="book_publication_year" value="" /></dd>
      </dl>
      <dl>
        <dt>Library</dt>
        <dd>
        <select name="location">
          <option value="9999">
            ---
          </option>
              <?php
              $location_set = find_all_locations();
              while ($location = mysqli_fetch_assoc($location_set)) {
                  echo "<option value=\"" . h($location['id']) . "\"";
                  echo ">" . h($location['location_shortname']) . "</option>";
              }
               mysqli_free_result($location_set);
             ?>
            </select></dd>
      </dl>
      <dl>
      <?php $level_list = find_all_levels(); ?>
        <dt>Level:</dt>
        <dd>

        <select name="level_id">
          <option value="9999">
            ---
          </option>
        <?php while ($levlist = mysqli_fetch_assoc($level_list)) {
                 echo "<option value=\"" . h($levlist['id']) . "\"";
                 echo ">" . h($levlist['level_name']) . "</option>";
             }
          mysqli_free_result($level_list);
        ?>
        </select>
        </dd>
      </dl>
      <dl>
        <?php $category_list = find_all_categories(); ?>
        <dt>Category:</dt>
        <dd>
          <select name="category_id">
            <option value="9999">
              ---
            </option>
          <?php while ($catlist = mysqli_fetch_assoc($category_list)) {
            echo "<option value=\"" . h($catlist['id']) . "\"";
            echo ">" . h($catlist['category']) . "</option>";
        }
            mysqli_free_result($category_list);
          ?>
          </select>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Search for Question" />
      </div>
    </form>
  </div>
</div>
    </div>
  </div>
</div>
<?php include(SHARED_PATH . '/public_footer.php')?>
