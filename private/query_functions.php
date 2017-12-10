<?php

// Functions to find all info

  function find_all_categories() {
      global $db;
      $sql = "SELECT * FROM categories ";
      $sql .= "ORDER BY position ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }

  function find_all_levels() {
      global $db;

      $sql = "SELECT * FROM level ";
      $sql .= "ORDER BY position ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }

  function find_all_locations() {
      global $db;

      $sql = "SELECT * FROM locations ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }

  function find_all_questions($question_page=[]) {
        global $db;
        $page= $question_page['count'] ?? '0';
        $sql = "SELECT * FROM questions ";
        $sql .= "ORDER BY id ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
      }

  function find_all_admins() {
        global $db;
        $sql = "SELECT * FROM admins ";
        $sql .= "ORDER BY id ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
      }

  function find_all_battles() {
      global $db;
      $sql = "SELECT * FROM battle ";
      $sql .= "ORDER BY id ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }

// Functions to find by ID

  function find_category_by_id($id) {
      global $db;

      $sql = "SELECT * FROM categories ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $category = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $category; // returns an assoc array
    }

  function find_level_by_id($id) {
      global $db;

      $sql = "SELECT * FROM level ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $category = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $category; // returns an assoc array
    }

  function find_location_by_id($id) {
      global $db;

      $sql = "SELECT * FROM locations ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $locinfo = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $locinfo; // returns an assoc array
    }

  function find_question_by_id($id) {
      global $db;

      $sql = "SELECT * FROM questions ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $question = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $question; // returns an assoc array
    }

  function find_admin_by_id($id) {
      global $db;

      $sql = "SELECT * FROM admins ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $admin = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $admin; // returns an assoc array
    }

  function find_admin_by_username($username) {
      global $db;

      $sql = "SELECT * FROM admins ";
      $sql .= "WHERE username='" .  db_escape($db, $username) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $admin = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $admin; // returns an assoc array
    }

  function find_battle_by_id($id) {
      global $db;

      $sql = "SELECT * FROM battle ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $battle = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $battle; // returns an assoc array
    }

  function find_questions_by_round_id($id) {
      global $db;

      $sql = "SELECT * FROM round ";
      $sql .= "WHERE id='" .  db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $questions_from_round = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $questions_from_round; // returns an assoc array
    }

  function find_round_by_id($id) {
      global $db;

      $sql = "SELECT * FROM round ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $round = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $round; // returns an assoc array
    }

  function find_rounds_by_battleid($id) {
      global $db;

      $sql = "SELECT * FROM round ";
      $sql .= "WHERE battle_id='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
    }

// Function to find questions based on criteria

  function find_question_by_info($forminfo, $question_page=[]) {
      global $db;

      $page= $question_page['count'] ?? '0';
      $sql = "SELECT * FROM questions ";
      $sql .= "WHERE ";
      // author first name
      if($forminfo['author_first_name'] != '')
      {
        $sql .= "author_first_name LIKE '%" . db_escape($db,$forminfo['author_first_name']) . "%' ";
      } else {
        $sql .= "author_first_name LIKE '%' ";
      }
      // author last name
      if($forminfo['author_last_name'] != '')
      {
        $sql .= "AND author_last_name LIKE '%" . db_escape($db,$forminfo['author_last_name']) . "%' ";
      } else {
        $sql .= "AND author_last_name LIKE '%' ";
      }
      // title
      if($forminfo['book_title'] != '')
      {
        $sql .= "AND book_title LIKE '%" . db_escape($db,$forminfo['book_title']) . "%' ";
      } else {
        $sql .= "AND book_title LIKE '%' ";
      }
      //publication year
      if($forminfo['book_publication_year'] != '')
      {
        $sql .= "AND book_publication_year LIKE '%" . db_escape($db,$forminfo['book_publication_year']) . "%' ";
      } else {
        $sql .= "AND book_publication_year LIKE '%' ";
      }
      //library
      if($forminfo['location'] != '9999')
      {
        $sql .= "AND question_owner LIKE '%" . db_escape($db,$forminfo['location']) . "%' ";
      } else {
        $sql .= "AND question_owner LIKE '%' ";
      }
      //level
      if($forminfo['level_id'] != '9999')
      {
        $sql .= "AND level LIKE '%" . db_escape($db,$forminfo['level_id']) . "%' ";
      } else {
        $sql .= "AND level LIKE '%' ";
      }
      //category
      if($forminfo['category_id'] != '9999')
      {
        $sql .= "AND question_category LIKE '%" . db_escape($db,$forminfo['category_id']) . "%' ";
      } else {
        $sql .= "AND question_category LIKE '%' ";
      }
      // this should change the offset based on what $page is
        //$sql .= "LIMIT 10 OFFSET " . $page;
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; // returns an assoc array
    }


    function search_question_by_info($forminfo) {
        global $db;

        $sql = "SELECT * FROM questions ";
        $sql .= "WHERE ";
        $sql .= "author_first_name='" . db_escape($db,$forminfo['author_first_name']) . "' ";
        $sql .= "AND author_last_name='" . db_escape($db,$forminfo['author_last_name']) . "' ";
        if($forminfo['book_title'] != ``)
        {
           $sql .= "AND book_title='" . db_escape($db,$forminfo['book_title']) ."'";
        }
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result; // returns an assoc array
      }

// Functions to insert

  function insert_category($category) {
    global $db;

    $errors = validate_category($category);
    if(!empty($errors)) {
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
    if($result) {
      return true;
    }
    else {
      // INSERT FAILED
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_level($level) {
    global $db;

    $errors = validate_level($level);
    if(!empty($errors)) {
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
    if($result) {
      return true;
    }
    else {
      // INSERT FAILED
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_location($location) {
    global $db;

    $errors = validate_location($location);
    if(!empty($errors)) {
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
    if($result) {
      return true;
    }
    else {
      // INSERT FAILED
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_question($question_data) {
    global $db;

    //$errors = validate_location($location);
    //if(!empty($errors)) {
    //  return $errors;
    //}

    $sql = "INSERT INTO questions ";
    $sql .= "(author_first_name, author_last_name, book_publication_year, book_title, level, question_category, question_text, question_owner, question_answer, notes) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $question_data['author_first_name']) . "',";
    $sql .= "'" . db_escape($db, $question_data['author_last_name']) . "',";
    $sql .= "'" . db_escape($db, $question_data['book_publication_year']) . "',";
    $sql .= "'" . db_escape($db, $question_data['book_title']) . "',";
    $sql .= "'" . db_escape($db, $question_data['level_id']) . "',";
    $sql .= "'" . db_escape($db, $question_data['category_id']) . "',";
    $sql .= "'" . db_escape($db, $question_data['question_text']) . "',";
    $sql .= "'" . db_escape($db, $question_data['question_owner']) . "',";
    $sql .= "'" . db_escape($db, $question_data['question_answer']) . "',";
    $sql .= "'" . db_escape($db, $question_data['notes']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    }
    else {
      // INSERT FAILED
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_admin($admin) {
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
    if($result) {
      return true;
    }
    else {
      // INSERT FAILED
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_battle($battle) {
    global $db;

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
    if($result) {
      echo $sql;
      return true;
    }
    else {
      // INSERT FAILED
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_round($round) {
    global $db;

    $sql = "INSERT INTO round ";
    $sql .= "(round_name, round_preamble, battle_id, round_notes) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $round['round_name']) . "',";
    $sql .= "'" . db_escape($db, $round['round_preamble']) . "',";
    $sql .= "'" . db_escape($db, $round['battle_id']) . "',";
    $sql .= "'" . db_escape($db, $round['round_notes']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      echo $sql;
      return true;
    }
    else {
      // INSERT FAILED
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }


// Functions to update

  function update_category($category) {
    global $db;

    $errors = validate_category($category);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE categories SET ";
    $sql .= "category='" . db_escape($db, $category['category']) . "', ";
    $sql .= "position='" . db_escape($db, $category['position']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $category['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // FOR UPDATE statements, the result is true or false
    if ($result)
      {
        return true;
      }
      else
      { // UPDDATE FAILED
        echo $sql;
        echo "<br/>";
        echo mysqli_error($db);
        db_dissconnect($db);
        exit;
      }
  }

  function update_level($level) {
    global $db;

    $errors = validate_level($level);
    if(!empty($errors)) {
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
    if ($result)
      {
        return true;
      }
      else
      { // UPDDATE FAILED
        echo $sql;
        echo "<br/>";
        echo mysqli_error($db);
        db_dissconnect($db);
        exit;
      }
  }

  function update_location($location) {
    global $db;

    $errors = validate_location($location);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE locations SET ";
    $sql .= "location_name='" . db_escape($db, $location['location_name']) . "', ";
    $sql .= "location_shortname='" . db_escape($db, $location['location_shortname']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $location['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    // FOR UPDATE statements, the result is true or false
    if ($result)
      {
        return true;
      }
      else
      { // UPDDATE FAILED
        echo $sql;
        echo "<br/>";
        echo mysqli_error($db);
        db_dissconnect($db);
        exit;
      }
  }

  function update_admin($admin) {
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
    if(!is_blank($admin['hashed_password'])) {
    $hashed_password = password_hash($admin['hashed_password'], PASSWORD_BCRYPT);
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "isGlobalAdmin='" . db_escape($db, $admin['isGlobalAdmin']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    // FOR UPDATE statements, the result is true or false
    if ($result)
      {
        return true;
      }
      else
      { // UPDDATE FAILED
        echo $sql;
        echo "<br/>";
        echo mysqli_error($db);
        db_dissconnect($db);
        exit;
      }
  }


// Functions to delete

  function delete_category($id) {
    global $db;
    $sql = "DELETE FROM categories ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    // For DELETE statements the results is true or false
    if($result) {
      return true;
    }
    else {
      //DELETE FAILED
      echo mysqli_error($db);
      db_dissconnect($db);
      exit;
    }

  }

  function delete_level($id) {
    global $db;
    $sql = "DELETE FROM level ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    // For DELETE statements the results is true or false
    if($result) {
      return true;
    }
    else {
      //DELETE FAILED
      echo mysqli_error($db);
      db_dissconnect($db);
      exit;
    }

  }

  function delete_location($id) {
    global $db;
    $sql = "DELETE FROM locations ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    // For DELETE statements the results is true or false
    if($result) {
      return true;
    }
    else {
      //DELETE FAILED
      echo mysqli_error($db);
      db_dissconnect($db);
      exit;
    }

  }

  function delete_admin($adminid) {
      global $db;
      $sql = "DELETE FROM admins ";
      $sql .= "WHERE id='" . db_escape($db, $adminid) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For DELETE statements the results is true or false
      if($result) {
        return true;
      }
      else
      {
        //DELETE FAILED
        echo mysqli_error($db);
        db_dissconnect($db);
        exit;
      }
    }

  function delete_question($id) {
    global $db;
    $sql = "DELETE FROM questions ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    // For DELETE statements the results is true or false
    if($result) {
      return true;
    }
    else {
      //DELETE FAILED
      echo mysqli_error($db);
      db_dissconnect($db);
      exit;
    }

  }

  function delete_round($id) {
    global $db;
    $sql = "DELETE FROM round ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    // For DELETE statements the results is true or false
    if($result) {
      return true;
    }
    else {
      //DELETE FAILED
      echo mysqli_error($db);
      db_dissconnect($db);
      exit;
    }

  }

// Functions to validate

  function validate_category($category){
    $errors = [];

    // menu_name
    if(is_blank($category['category'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($category['category'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $category['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    return $errors;
  }

  function validate_level($level){
    $errors = [];

    // name
    if(is_blank($level['level_name'])) {
      $errors[] = "Level name cannot be blank.";
    } elseif(!has_length($level['level_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Level name must be between 2 and 255 characters.";
    }
    // position
    // Make sure we are working with an integer
    $postion_int = (int) $level['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }
    // visible
    // Make sure we are working with a string
    $visible_str = (string) $level['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }

  function validate_location($location){
    $errors = [];

    // name
    if(is_blank($location['location_name'])) {
      $errors[] = "Location name cannot be blank.";
    } elseif(!has_length($location['location_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Level name must be between 2 and 255 characters.";
    }
    if(is_blank($location['location_shortname'])) {
      $errors[] = "Location shortname cannot be blank.";
    } elseif(!has_length($location['location_shortname'], ['min' => 2, 'max' => 4])) {
      $errors[] = "Level shortname must be between 2 and 4 characters.";
    }

    return $errors;
  }


?>
