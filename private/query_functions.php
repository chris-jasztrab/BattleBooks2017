<?php

// Functions to find all info

  function show_session_variables()
  {
      echo '<pre>';
      echo var_dump($_SESSION);
      echo '</pre>';
  }

  function find_all_categories()
  {
      global $db;
      $sql = "SELECT * FROM categories ";
      $sql .= "ORDER BY position ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_all_awards()
  {
      global $db;
      $sql = "SELECT * FROM awards ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_number_of_questions()
  {
      global $db;
      $sql = "SELECT * FROM questions ";
      $result = mysqli_query($db, $sql);
      $numrows = mysqli_num_rows($result);
      return $numrows;
  }

  function find_all_levels()
  {
      global $db;

      $sql = "SELECT * FROM level ";
      $sql .= "ORDER BY position ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_all_locations()
  {
      global $db;

      $sql = "SELECT * FROM locations ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_all_questions($question_page=[])
  {
      global $db;
      $page= $question_page['count'] ?? '0';
      $sql = "SELECT * FROM questions ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_all_admins()
  {
      global $db;
      $sql = "SELECT * FROM admins ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_all_battles()
  {
      global $db;
      $sql = "SELECT * FROM battle ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }


// finds all questions in the round_questions table that match the given ID

  function find_all_questions_in_round($round_id)
  {
      global $db;
      $sql = "SELECT * FROM round_questions ";
      $sql .= "WHERE round_id='" . db_escape($db, $round_id) . "'";
      $sql .= "ORDER BY position ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
  }

  function is_question_in_battle($question_id, $battle_id)
  {
      global $db;
      $sql = "SELECT bob.battle.name, bob.round.round_name, bob.battle.id, bob.round.id AS id1, bob.questions.id AS id2 ";
      $sql .= "FROM bob.battle ";
      $sql .= "INNER JOIN bob.round ON bob.round.battle_id = bob.battle.id ";
      $sql .= "INNER JOIN bob.round_questions ON bob.round_questions.round_id = bob.round.id ";
      $sql .= "INNER JOIN bob.questions ON bob.questions.id = bob.round_questions.question_id ";
      $sql .= "WHERE bob.questions.id = '" . db_escape($db, $question_id) . "' ";
      $sql .= "AND bob.battle.id = '" . db_escape($db, $battle_id) . "' ";
      $result = mysqli_query($db, $sql);
      $inbattle = mysqli_fetch_assoc($result);
      //echo $sql;
      mysqli_free_result($result);
      return $inbattle; // returns an assoc array
  }

// Functions to find by ID

  function find_category_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM categories ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $category = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $category; // returns an assoc array
  }

  function find_award_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM awards ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $category = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $category; // returns an assoc array
  }

  function find_author_by_question_id($id)
  {
      global $db;

      $sql = "SELECT * FROM questions ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $question_info = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      $author_name = $question_info['author_first_name'] . " " . $question_info['author_last_name'];
      return $author_name; // returns an assoc array
  }

  function find_level_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM level ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $category = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $category; // returns an assoc array
  }

  function find_location_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM locations ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $locinfo = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $locinfo; // returns an assoc array
  }

  function find_question_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM questions ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $question = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $question; // returns an assoc array
  }

  function find_question_level_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM questions_level ";
      $sql .= "WHERE question_id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_question_category_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM questions_category ";
      $sql .= "WHERE question_id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_question_award_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM book_awards ";
      $sql .= "WHERE question_id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_admin_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM admins ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $admin = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $admin; // returns an assoc array
  }

  function find_admin_by_username($username)
  {
      global $db;

      $sql = "SELECT * FROM admins ";
      $sql .= "WHERE username='" .  db_escape($db, $username) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $admin = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $admin; // returns an assoc array
  }

  function find_battle_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM battle ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $battle = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $battle; // returns an assoc array
  }

  function find_questions_by_round_id($id)
  {
      global $db;

      $sql = "SELECT * FROM round_questions ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

  function find_round_by_id($id)
  {
      global $db;

      $sql = "SELECT * FROM round ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $round = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $round; // returns an assoc array
  }

  function find_rounds_by_battleid($id)
  {
      global $db;

      $sql = "SELECT * FROM round ";
      $sql .= "WHERE battle_id='" . db_escape($db, $id) . "'";
      $sql .= "ORDER by position ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
  }

  function find_battles_by_location($location_id)
  {
      global $db;

      $sql = "SELECT * FROM battle ";
      $sql .= "WHERE owner='" . db_escape($db, $location_id) . "' ";
      $sql .= "AND is_archived != 1";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;// returns an assoc array
  }

  function find_other_library_battles($location_id)
  {
      global $db;

      $sql = "SELECT * FROM battle ";
      $sql .= "WHERE owner!='" . db_escape($db, $location_id) . "' ";
      $sql .= "AND is_archived != 1 ";
      $sql .= "ORDER BY owner ASC";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;// returns an assoc array
  }

  function find_archived_battles_by_location($location_id)
  {
      global $db;
      $sql = "SELECT * FROM battle ";
      $sql .= "WHERE owner='" . db_escape($db, $location_id) . "' ";
      $sql .= "AND is_archived = 1";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;// returns an assoc array
  }

  function find_other_library_archived_battles($location_id)
  {
      global $db;

      $sql = "SELECT * FROM battle ";
      $sql .= "WHERE owner!='" . db_escape($db, $location_id) . "' ";
      $sql .= "AND is_archived = 1";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;// returns an assoc array
  }

  function get_number_of_questions_in_round($id)
  {
      global $db;

      $sql = "SELECT * FROM round_questions ";
      $sql .= "WHERE round_id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      $row_cnt = mysqli_num_rows($result);
      return $row_cnt; // returns an assoc array
  }

  function move_question_down($round_id, $position)
  {
      global $db;
      // set first value to 9999
      $sql = "UPDATE round_questions SET ";
      $sql .= "position=9999 ";
      $sql .= "WHERE position='" . db_escape($db, $position) . "' ";
      $sql .= "AND round_id='" . db_escape($db, $round_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_question_down_p2($round_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_question_down_p2($round_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round_questions SET ";
      $sql .= "position='" . db_escape($db, $position) . "' ";
      $sql .= "WHERE position='" . db_escape($db, $position+1) . "' ";
      $sql .= "AND round_id='" . db_escape($db, $round_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_question_down_p3($round_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_question_down_p3($round_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round_questions SET ";
      $sql .= "position='" . db_escape($db, $position+1) . "' ";
      $sql .= "WHERE position='9999' ";
      $sql .= "AND round_id='" . db_escape($db, $round_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_question_up($round_id, $position)
  {
      global $db;
      // set first value to 9999
      $sql = "UPDATE round_questions SET ";
      $sql .= "position=9999 ";
      $sql .= "WHERE position='" . db_escape($db, $position) . "' ";
      $sql .= "AND round_id='" . db_escape($db, $round_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_question_up_p2($round_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_question_up_p2($round_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round_questions SET ";
      $sql .= "position='" . db_escape($db, $position) . "' ";
      $sql .= "WHERE position='" . db_escape($db, $position-1) . "' ";
      $sql .= "AND round_id='" . db_escape($db, $round_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_question_up_p3($round_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_question_up_p3($round_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round_questions SET ";
      $sql .= "position='" . db_escape($db, $position-1) . "' ";
      $sql .= "WHERE position='9999' ";
      $sql .= "AND round_id='" . db_escape($db, $round_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function find_question_position_in_round_by_id($round_id, $question_id)
  {
      global $db;

      $sql = "SELECT * FROM round_questions ";
      $sql .= "WHERE round_id='" . db_escape($db, $round_id) . "'";
      $sql .= "AND question_id='" . db_escape($db, $question_id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $round = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $round; // returns an assoc array
  }

  function find_battle_info_by_question_id($question_id)
  {
      global $db;

      $sql = "SELECT * FROM bob.battle ";
      $sql .= "INNER JOIN bob.round ON bob.battle.id = bob.round.battle_id ";
      $sql .= "INNER JOIN bob.round_questions ON bob.round.id = bob.round_questions.round_id ";
      $sql .= "WHERE bob.round_questions.question_id = " . $question_id;

      $result = mysqli_query($db, $sql);
      return $result; // returns an assoc array
  }

  function move_round_down($battle_id, $position)
  {
      global $db;
      // set first value to 9999
      $sql = "UPDATE round SET ";
      $sql .= "position=9999 ";
      $sql .= "WHERE position='" . db_escape($db, $position) . "' ";
      $sql .= "AND battle_id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_round_down_p2($battle_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_round_down_p2($battle_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round SET ";
      $sql .= "position='" . db_escape($db, $position) . "' ";
      $sql .= "WHERE position='" . db_escape($db, $position+1) . "' ";
      $sql .= "AND battle_id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_round_down_p3($battle_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_round_down_p3($battle_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round SET ";
      $sql .= "position='" . db_escape($db, $position+1) . "' ";
      $sql .= "WHERE position='9999' ";
      $sql .= "AND battle_id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_round_up($battle_id, $position)
  {
      global $db;
      // set first value to 9999
      $sql = "UPDATE round SET ";
      $sql .= "position=9999 ";
      $sql .= "WHERE position='" . db_escape($db, $position) . "' ";
      $sql .= "AND battle_id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_round_up_p2($battle_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_round_up_p2($battle_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round SET ";
      $sql .= "position='" . db_escape($db, $position) . "' ";
      $sql .= "WHERE position='" . db_escape($db, $position-1) . "' ";
      $sql .= "AND battle_id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          move_round_up_p3($battle_id, $position);
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function move_round_up_p3($battle_id, $position)
  {
      global $db;
      // set second value to first value
      $sql = "UPDATE round SET ";
      $sql .= "position='" . db_escape($db, $position-1) . "' ";
      $sql .= "WHERE position='9999' ";
      $sql .= "AND battle_id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      echo $sql . "<br />";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

// Function to find questions based on criteria

  function find_question_by_info($forminfo)
  {
      global $db;
      $questionoffset = $forminfo['offset'] ?? 0;
      $sql = "SELECT questions_level.level_id, ";
      $sql .= "questions.book_title, ";
      $sql .= "questions.question_text, ";
      $sql .= "questions.question_answer, ";
      $sql .= "questions.author_first_name, ";
      $sql .= "questions.author_last_name, ";
      $sql .= "questions.book_publication_year, ";
      $sql .= "questions.notes, ";
      $sql .= "questions.id, ";
      if ($forminfo['award_id'] != '9999') {
        $sql .= "book_awards.award_id, ";
      }
      $sql .= "questions.question_owner ";


      $sql .= "FROM questions ";

      $sql .= "INNER JOIN questions_level ON questions.id = questions_level.question_id ";
      $sql .= "INNER JOIN questions_category ON questions.id = questions_category.question_id ";
      if ($forminfo['award_id'] != '9999') {
        $sql .= "INNER JOIN book_awards ON questions.id = book_awards.question_id ";
      }

      $sql .= "WHERE ";

      // author first name
      if ($forminfo['author_first_name'] != '') {
          $sql .= "questions.author_first_name LIKE '%" . db_escape($db, $forminfo['author_first_name']) . "%' ";
      } else {
          $sql .= "questions.author_first_name LIKE '%' ";
      }
      // author last name
      if ($forminfo['author_last_name'] != '') {
          $sql .= "AND questions.author_last_name LIKE '%" . db_escape($db, $forminfo['author_last_name']) . "%' ";
      } else {
          $sql .= "AND questions.author_last_name LIKE '%' ";
      }
      // title
      if ($forminfo['book_title'] != '') {
          $sql .= "AND questions.book_title LIKE '%" . db_escape($db, $forminfo['book_title']) . "%' ";
      } else {
          $sql .= "AND questions.book_title LIKE '%' ";
      }
      //publication year
      if ($forminfo['book_publication_year'] != '') {
          $sql .= "AND questions.book_publication_year LIKE '%" . db_escape($db, $forminfo['book_publication_year']) . "%' ";
      } else {
          $sql .= "AND questions.book_publication_year LIKE '%' ";
      }
      //library
      if ($forminfo['location'] != '9999') {
          $sql .= "AND questions.question_owner LIKE '%" . db_escape($db, $forminfo['location']) . "%' ";
      } else {
          $sql .= "AND questions.question_owner LIKE '%' ";
      }
      //level
      if ($forminfo['level_id'] != '9999') {
          //echo "LEVELID " . $forminfo['level_id'];
          $sql .= "AND questions_level.level_id LIKE '%" . db_escape($db, $forminfo['level_id']) . "%' ";
      } else {
          //echo "LEVELID " . $forminfo['level_id'];
          $sql .= "AND questions_level.level_id LIKE '%' ";
      }

      //award
      if ($forminfo['award_id'] != '9999') {
          $sql .= "AND book_awards.award_id = '" . db_escape($db, $forminfo['award_id']) . "' ";
       }
      //category
      if ($forminfo['category_id'] != '9999') {
          $sql .= "AND questions_category.category_id = '" . db_escape($db, $forminfo['category_id']) . "' ";
      } else {
          $sql .= "AND questions_category.category_id LIKE '%' ";
      }
      // this should change the offset based on what $page is

      $sql .= " GROUP BY questions.id ";
      $sql .= "LIMIT 10 OFFSET " . $questionoffset;

      //echo $sql;
    //echo "<br /><br />";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
  }

  function find_question_by_info_no_offset($forminfo)
  {
      global $db;
      $questionoffset = $forminfo['offset'] ?? 0;
      $sql = "SELECT questions_level.level_id, ";
      $sql .= "questions.book_title, ";
      $sql .= "questions.question_text, ";
      $sql .= "questions.question_answer, ";
      $sql .= "questions.author_first_name, ";
      $sql .= "questions.author_last_name, ";
      $sql .= "questions.book_publication_year, ";
      $sql .= "questions.notes, ";
      $sql .= "questions.id, ";
      $sql .= "questions.question_owner ";

      $sql .= "FROM questions ";

      $sql .= "INNER JOIN questions_level ON questions.id = questions_level.question_id ";
      $sql .= "INNER JOIN questions_category ON questions.id = questions_category.question_id ";

      $sql .= "WHERE ";

      // author first name
      if ($forminfo['author_first_name'] != '') {
          $sql .= "questions.author_first_name LIKE '%" . db_escape($db, $forminfo['author_first_name']) . "%' ";
      } else {
          $sql .= "questions.author_first_name LIKE '%' ";
      }
      // author last name
      if ($forminfo['author_last_name'] != '') {
          $sql .= "AND questions.author_last_name LIKE '%" . db_escape($db, $forminfo['author_last_name']) . "%' ";
      } else {
          $sql .= "AND questions.author_last_name LIKE '%' ";
      }
      // title
      if ($forminfo['book_title'] != '') {
          $sql .= "AND questions.book_title LIKE '%" . db_escape($db, $forminfo['book_title']) . "%' ";
      } else {
          $sql .= "AND questions.book_title LIKE '%' ";
      }
      //publication year
      if ($forminfo['book_publication_year'] != '') {
          $sql .= "AND questions.book_publication_year LIKE '%" . db_escape($db, $forminfo['book_publication_year']) . "%' ";
      } else {
          $sql .= "AND questions.book_publication_year LIKE '%' ";
      }
      //library
      if ($forminfo['location'] != '9999') {
          $sql .= "AND questions.question_owner LIKE '%" . db_escape($db, $forminfo['location']) . "%' ";
      } else {
          $sql .= "AND questions.question_owner LIKE '%' ";
      }
      //level
      if ($forminfo['level_id'] != '9999') {
          //echo "LEVELID " . $forminfo['level_id'];
          $sql .= "AND questions_level.level_id LIKE '%" . db_escape($db, $forminfo['level_id']) . "%' ";
      } else {
          //echo "LEVELID " . $forminfo['level_id'];
          $sql .= "AND questions_level.level_id LIKE '%' ";
      }
      //category
      if ($forminfo['category_id'] != '9999') {
          $sql .= "AND questions_category.category_id LIKE '%" . db_escape($db, $forminfo['category_id']) . "%' ";
      } else {
          $sql .= "AND questions_category.category_id LIKE '%' ";
      }
      // this should change the offset based on what $page is
      $sql .= " GROUP BY questions.id ";

       //echo $sql;
       //echo "<br /><br />";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
  }

  function find_question_by_info_v2($forminfo)
  {
      global $db;
      $questionoffset = $forminfo['offset'] ?? 0;
      $sql = "SELECT * FROM questions ";
      $sql .= "INNER JOIN questions_level ON questions.id = questions_level.question_id ";
      $sql .= "INNER JOIN questions_category ON questions.id = questions_category.question_id ";
      $sql .= "INNER JOIN level ON level.id = questions_level.level_id ";
      $sql .= "INNER JOIN categories ON categories.id = questions_category.category_id ";
      $sql .= "INNER JOIN locations ON locations.id = questions.question_owner ";
      $sql .= "WHERE ";
      // author first name
      if ($forminfo['author_first_name'] != '') {
          $sql .= "questions.author_first_name LIKE '%" . db_escape($db, $forminfo['author_first_name']) . "%' ";
      } else {
          $sql .= "questions.author_first_name LIKE '%' ";
      }
      // author last name
      if ($forminfo['author_last_name'] != '') {
          $sql .= "AND questions.author_last_name LIKE '%" . db_escape($db, $forminfo['author_last_name']) . "%' ";
      } else {
          $sql .= "AND questions.author_last_name LIKE '%' ";
      }
      // title
      if ($forminfo['book_title'] != '') {
          $sql .= "AND questions.book_title LIKE '%" . db_escape($db, $forminfo['book_title']) . "%' ";
      } else {
          $sql .= "AND questions.book_title LIKE '%' ";
      }
      //publication year
      if ($forminfo['book_publication_year'] != '') {
          $sql .= "AND questions.book_publication_year LIKE '%" . db_escape($db, $forminfo['book_publication_year']) . "%' ";
      } else {
          $sql .= "AND questions.book_publication_year LIKE '%' ";
      }
      //library
      if ($forminfo['location'] != '9999') {
          $sql .= "AND questions.question_owner LIKE '%" . db_escape($db, $forminfo['location']) . "%' ";
      } else {
          $sql .= "AND questions.question_owner LIKE '%' ";
      }
      //level
      if ($forminfo['level_id'] != '9999') {
          $sql .= "AND questions_level.level_id =" . db_escape($db, $forminfo['level_id']);
      } else {
          $sql .= "AND questions_level.level_id LIKE '%' ";
      }
      //category
      //  if($forminfo['category_id'] != '9999')
      //  {
      //    $sql .= "AND question_category LIKE '%" . db_escape($db,$forminfo['category_id']) . "%' ";
      //  } else {
      //    $sql .= "AND question_category LIKE '%' ";
      //  }
      // this should change the offset based on what $page is
      $sql .= " GROUP BY questions.id ";
      $sql .= "LIMIT 10 OFFSET " . $questionoffset;

      //echo $sql;
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
  }

  function search_question_by_info($forminfo)
  {
      global $db;

      $sql = "SELECT * FROM questions ";
      $sql .= "WHERE ";
      $sql .= "author_first_name='" . db_escape($db, $forminfo['author_first_name']) . "' ";
      $sql .= "AND author_last_name='" . db_escape($db, $forminfo['author_last_name']) . "' ";
      if ($forminfo['book_title'] != ``) {
          $sql .= "AND book_title='" . db_escape($db, $forminfo['book_title']) ."'";
      }
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
  }

// Functions to insert

  function insert_category($category)
  {
      global $db;

      $errors = validate_category($category);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "INSERT INTO categories ";
      $sql .= "(category, position) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $category['category']) . "',";
      $sql .= "'" . db_escape($db, $category['position']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_award($award)
  {
      global $db;

      //$errors = validate_category($category);
      //if(!empty($errors)) {
      //  return $errors;
      //}

      $sql = "INSERT INTO awards ";
      $sql .= "(award_name) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $award['award_name']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_level($level)
  {
      global $db;

      $errors = validate_level($level);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "INSERT INTO level ";
      $sql .= "(level_name, position, visible) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $level['level_name']) . "',";
      $sql .= "'" . db_escape($db, $level['position']) . "',";
      $sql .= "'" . db_escape($db, $level['visible']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_location($location)
  {
      global $db;

      $errors = validate_location($location);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "INSERT INTO locations ";
      $sql .= "(location_name, location_shortname) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $location['location_name']) . "',";
      $sql .= "'" . db_escape($db, $location['location_shortname']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_question($question_data)
  {
      global $db;

      //$errors = validate_location($location);
      //if(!empty($errors)) {
      //  return $errors;
      //}

      $sql = "INSERT INTO questions ";
      $sql .= "(author_first_name, author_last_name, book_publication_year, book_title, question_text, question_owner, question_answer, notes) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $question_data['author_first_name']) . "',";
      $sql .= "'" . db_escape($db, $question_data['author_last_name']) . "',";
      $sql .= "'" . db_escape($db, $question_data['book_publication_year']) . "',";
      $sql .= "'" . db_escape($db, $question_data['book_title']) . "',";
      //$sql .= "'" . db_escape($db, $question_data['level_id']) . "',";
      //$sql .= "'" . db_escape($db, $question_data['category_id']) . "',";
      $sql .= "'" . db_escape($db, $question_data['question_text']) . "',";
      $sql .= "'" . db_escape($db, $question_data['question_owner']) . "',";
      $sql .= "'" . db_escape($db, $question_data['question_answer']) . "',";
      $sql .= "'" . db_escape($db, $question_data['notes']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          $new_id = mysqli_insert_id($db);
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_question_level($question_id, $question_level_data)
  {
      global $db;

      //$errors = validate_question_level($question_level_data);
      //if(!empty($errors)) {
      //  return $errors;
      //}
      //echo var_dump($question_level_data);
      $sql = "INSERT INTO questions_level ";
      $sql .= "(question_id, level_id) ";
      $sql .= "VALUES ";
      $number_levels = count($question_level_data);
      foreach ($question_level_data as $level_data) {
          $sql .= "(" . $question_id . "," . $level_data . ") ";
          if ($number_levels > 1) {
              $sql .= ",";
              $number_levels = $number_levels -1;
          }
      }
      //echo $sql;

      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_question_award($question_id, $question_award_data)
  {
      global $db;
      //echo var_dump($question_level_data);
      $sql = "INSERT INTO book_awards ";
      $sql .= "(question_id, award_id) ";
      $sql .= "VALUES ";
      $number_awards = count($question_award_data);
      foreach ($question_award_data as $award_data) {
          $sql .= "(" . $question_id . "," . $award_data . ") ";
          if ($number_awards > 1) {
              $sql .= ",";
              $number_awards = $number_awards -1;
          }
      }
      //echo $sql;

      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_question_category($question_id, $question_category_data)
  {
      global $db;
      //  $errors = validate_question_category($question_category_data);
      //  if(!empty($errors)) {
      //      return $errors;
      //    }
      //echo var_dump($question_level_data);
      $sql = "INSERT INTO questions_category ";
      $sql .= "(question_id, category_id) ";
      $sql .= "VALUES ";
      $number_categories = count($question_category_data);
      foreach ($question_category_data as $category_data) {
          $sql .= "(" . $question_id . "," . $category_data . ") ";
          if ($number_categories > 1) {
              $sql .= ",";
              $number_categories = $number_categories -1;
          }
      }
      //echo "<br />";
      //echo $sql;

      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return $question_id;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_admin($admin)
  {
      global $db;

      //$errors = validate_location($location);
      //if(!empty($errors)) {
      //  return $errors;
      //}
      $hashed_password = password_hash($admin['hashed_password'], PASSWORD_BCRYPT);

      $sql = "INSERT INTO admins ";
      $sql .= "(email, first_name, last_name, hashed_password, username, location, isGlobalAdmin) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $admin['email']) . "',";
      $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
      $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
      $sql .= "'" . db_escape($db, $hashed_password) . "',";
      $sql .= "'" . db_escape($db, $admin['username']) . "',";
      $sql .= "'" . db_escape($db, $admin['location']) . "',";
      $sql .= "'" . db_escape($db, $admin['isGlobalAdmin']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_battle($battle)
  {
      global $db;

      $errors = validate_battle_name($battle);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "INSERT INTO battle ";
      $sql .= "(name, level, notes, owner, preamble) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $battle['battle_name']) . "',";
      $sql .= "'" . db_escape($db, $battle['battle_level']) . "',";
      $sql .= "'" . db_escape($db, $battle['notes']) . "',";
      $sql .= "'" . db_escape($db, $battle['owner']) . "',";
      $sql .= "'" . db_escape($db, $battle['battle_preamble']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          echo $sql;
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function insert_round($round)
  {
      global $db;

      $rounds_in_this_battle = find_rounds_by_battleid($round['battle_id']);
      $number_of_rounds_in_battle = mysqli_num_rows($rounds_in_this_battle);


      $sql = "INSERT INTO round ";
      $sql .= "(round_name, round_preamble, battle_id, round_notes, position) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $round['round_name']) . "',";
      $sql .= "'" . db_escape($db, $round['round_preamble']) . "',";
      $sql .= "'" . db_escape($db, $round['battle_id']) . "',";
      $sql .= "'" . db_escape($db, $round['round_notes']) . "',";
      $sql .= "'" . db_escape($db, $number_of_rounds_in_battle +1) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          echo $sql;
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }


// Functions to update

  function update_category($category)
  {
      global $db;

      $errors = validate_category($category);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "UPDATE categories SET ";
      $sql .= "category='" . db_escape($db, $category['category']) . "', ";
      $sql .= "position='" . db_escape($db, $category['position']) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $category['id']) . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_award($award)
  {
      global $db;

      //$errors = validate_category($category);
      //if(!empty($errors)) {
      //  return $errors;
      //}

      $sql = "UPDATE awards SET ";
      $sql .= "award_name='" . db_escape($db, $award['award_name']) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $award['id']) . "' ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_question($question_info)
  {
      global $db;

      //$errors = validate_category($category);
      //if(!empty($errors)) {
      //  return $errors;
      //}

      $sql = "UPDATE questions SET ";
      $sql .= "author_first_name='" . db_escape($db, $question_info['author_first_name']) . "', ";
      $sql .= "author_last_name='" . db_escape($db, $question_info['author_last_name']) . "', ";
      $sql .= "book_publication_year='" . db_escape($db, $question_info['book_publication_year']) . "', ";
      $sql .= "book_title='" . db_escape($db, $question_info['book_title']) . "', ";
      $sql .= "last_edited_by='" . db_escape($db, $question_info['last_edited_by']) . "', ";
      $sql .= "notes='" . db_escape($db, $question_info['notes']) . "', ";
      $sql .= "question_answer='" . db_escape($db, $question_info['question_answer']) . "', ";
      //$sql .= "question_category='" . db_escape($db, $question_info['question_category']) . "', ";
      $sql .= "question_text='" . db_escape($db, $question_info['question_text']) . "' ";
      //$sql .= "level='" . db_escape($db, $question_info['level']) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $question_info['id']) . "' ";
      $sql .= "LIMIT 1";
      echo $sql;
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_question_level($question_id)
  {
      global $db;
      $sql = "DELETE FROM questions_level ";
      $sql .= "WHERE question_id='" . db_escape($db, $question_id) . "' ";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          $sql;
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_question_category($question_id)
  {
      global $db;
      $sql = "DELETE FROM questions_category ";
      $sql .= "WHERE question_id='" . db_escape($db, $question_id) . "' ";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          $sql;
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_question_awards($question_id)
  {
      global $db;
      $sql = "DELETE FROM book_awards ";
      $sql .= "WHERE question_id='" . db_escape($db, $question_id) . "' ";
      $result = mysqli_query($db, $sql);
      echo $sql;
      // For DELETE statements the results is true or false
      if ($result) {
          $sql;
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_level($level)
  {
      global $db;

      $errors = validate_level($level);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "UPDATE level SET ";
      $sql .= "level_name='" . db_escape($db, $level['category']) . "', ";
      $sql .= "position='" . db_escape($db, $level['position']) . "', ";
      $sql .= "visible='" . db_escape($db, $level['visible']) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $level['id']) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_location($location)
  {
      global $db;

      $errors = validate_location($location);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "UPDATE locations SET ";
      $sql .= "location_name='" . db_escape($db, $location['location_name']) . "', ";
      $sql .= "location_shortname='" . db_escape($db, $location['location_shortname']) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $location['id']) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_admin($admin)
  {
      global $db;

      //$errors = validate_location($location);
      //if(!empty($errors)) {
      //  return $errors;
      //}
      $sql = "UPDATE admins SET ";
      $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
      $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
      $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
      $sql .= "location='" . db_escape($db, $admin['location']) . "', ";
      $sql .= "username='" . db_escape($db, $admin['username']) . "', ";
      if (!is_blank($admin['hashed_password'])) {
          $hashed_password = password_hash($admin['hashed_password'], PASSWORD_BCRYPT);
          $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
      }
      $sql .= "isGlobalAdmin='" . db_escape($db, $admin['isGlobalAdmin']) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_battle($battle)
  {
      global $db;

      //$errors = validate_location($location);
      //if(!empty($errors)) {
      //  return $errors;
      //}
      $sql = "UPDATE battle SET ";
      $sql .= "name='" . db_escape($db, $battle['name']) . "', ";
      $sql .= "preamble='" . db_escape($db, $battle['battle_preamble']) . "', ";
      $sql .= "notes='" . db_escape($db, $battle['notes']) . "', ";
      $sql .= "level='" . db_escape($db, $battle['level']) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $battle['id']) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_battle_name($id, $newname)
  {
      global $db;

      $errors = validate_location($battleinfo);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "UPDATE battle SET ";
      $sql .= "name='" . db_escape($db, $newname) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function add_question_to_round($round_id, $question_id)
  {
      global $db;
      $current_round_questions = find_all_questions_in_round($round_id);
      $number_of_questions_in_round = mysqli_num_rows($current_round_questions);
      //$errors = validate_level($level);
      //if(!empty($errors)) {
      //  return $errors;
      //}

      $sql = "INSERT INTO round_questions ";
      $sql .= "(round_id, question_id, position) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $round_id) . "',";
      $sql .= "'" . db_escape($db, $question_id) . "',";
      $sql .= "'" . db_escape($db, $number_of_questions_in_round +1) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      // For INSERT statements, $result is true/false
      if ($result) {
          return true;
      } else {
          // INSERT FAILED
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

  function archive_battle($battle_id)
  {
      global $db;

      //$errors = validate_location($location);
      //if(!empty($errors)) {
      //  return $errors;
      //}

      $sql = "UPDATE battle SET ";
      $sql .= "is_archived=1 ";
      $sql .= "WHERE id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function restore_battle($battle_id)
  {
      global $db;

      //$errors = validate_location($location);
      //if(!empty($errors)) {
      //  return $errors;
      //}

      $sql = "UPDATE battle SET ";
      $sql .= "is_archived=0 ";
      $sql .= "WHERE id='" . db_escape($db, $battle_id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

// Functions to delete

  function delete_category($id)
  {
      global $db;
      $sql = "DELETE FROM categories ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_award($id)
  {
      global $db;
      $sql = "DELETE FROM awards ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_level($id)
  {
      global $db;
      $sql = "DELETE FROM level ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_location($id)
  {
      global $db;
      $sql = "DELETE FROM locations ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_admin($adminid)
  {
      global $db;

      $errors = validate_admin_delete($adminid);
      if (!empty($errors)) {
          return $errors;
      }

      $sql = "DELETE FROM admins ";
      $sql .= "WHERE id='" . db_escape($db, $adminid) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_question($id)
  {
      global $db;
      $sql = "DELETE FROM questions ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_question_from_round($question_row_id)
  {
      global $db;
      $sql = "DELETE FROM round_questions ";
      $sql .= "WHERE id='" . db_escape($db, $question_row_id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function update_question_position($row_id, $position)
  {
      global $db;

      $sql = "UPDATE round_questions SET ";
      $sql .= "position='" . db_escape($db, $position) . "' ";
      $sql .= "WHERE id='" . db_escape($db, $row_id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // FOR UPDATE statements, the result is true or false
      if ($result) {
          return true;
      } else { // UPDDATE FAILED
          echo $sql;
          echo "<br/>";
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

  function delete_round($id)
  {
      global $db;
      $sql = "DELETE FROM round ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if ($result) {
          $sql2 = "DELETE FROM round_questions ";
          $sql2 .= "WHERE round_id='" . db_escape($db, $id) . "' ";
          $result2 = mysqli_query($db, $sql2);
          if ($result2) {
              return true;
          }
          return true;
      } else {
          //DELETE FAILED
          echo mysqli_error($db);
          db_dissconnect($db);
          exit;
      }
  }

// Functions to validate

  function validate_category($category)
  {
      $errors = [];

      // menu_name
      if (is_blank($category['category'])) {
          $errors[] = "Name cannot be blank.";
      } elseif (!has_length($category['category'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Name must be between 2 and 255 characters.";
      }

      // position
      // Make sure we are working with an integer
      $postion_int = (int) $category['position'];
      if ($postion_int <= 0) {
          $errors[] = "Position must be greater than zero.";
      }
      if ($postion_int > 999) {
          $errors[] = "Position must be less than 999.";
      }

      return $errors;
  }

  function validate_level($level)
  {
      $errors = [];

      // name
      if (is_blank($level['level_name'])) {
          $errors[] = "Level name cannot be blank.";
      } elseif (!has_length($level['level_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Level name must be between 2 and 255 characters.";
      }
      // position
      // Make sure we are working with an integer
      $postion_int = (int) $level['position'];
      if ($postion_int <= 0) {
          $errors[] = "Position must be greater than zero.";
      }
      if ($postion_int > 999) {
          $errors[] = "Position must be less than 999.";
      }
      // visible
      // Make sure we are working with a string
      $visible_str = (string) $level['visible'];
      if (!has_inclusion_of($visible_str, ["0","1"])) {
          $errors[] = "Visible must be true or false.";
      }

      return $errors;
  }

  function validate_question_level($level_array)
  {
      $errors = [];

      // name
      if (count($level_array) == 0) {
          $errors[] = "You must select at least one level.";
      }
      return $errors;
  }

  function validate_question_category($category_array)
  {
      $errors = [];

      // name
      if (count($category_array) == 0) {
          $errors[] = "You must select at least one category.";
      }
      return $errors;
  }

  function validate_battle_name($battlename)
  {
      $errors = [];

      // name
      if (is_blank($battlename['battle_name'])) {
          $errors[] = "Battle name cannot be blank.";
      } elseif (!has_length($battlename['battle_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Battle name must be between 2 and 255 characters.";
      }
      return $errors;
  }

  function validate_location($location)
  {
      $errors = [];

      // name
      if (is_blank($location['location_name'])) {
          $errors[] = "Location name cannot be blank.";
      } elseif (!has_length($location['location_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Level name must be between 2 and 255 characters.";
      }
      if (is_blank($location['location_shortname'])) {
          $errors[] = "Location shortname cannot be blank.";
      } elseif (!has_length($location['location_shortname'], ['min' => 2, 'max' => 4])) {
          $errors[] = "Level shortname must be between 2 and 4 characters.";
      }

      return $errors;
  }

// Admin Functions

  function validate_admin_delete($adminid)
  {
      $errors = [];

      // name
      if ($adminid == 1) {
          $errors[] = "Cannot delete this admin.";
      }
      return $errors;
  }
