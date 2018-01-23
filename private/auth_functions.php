<?php

// Performs all actions needed to login an admin
function log_in_admin($admin)
{
    //Regenerating ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin['username'];
    $_SESSION['question.owner'] = $admin['location'];
    $_SESSION['isGlobalAdmin'] = $admin['isGlobalAdmin'];
    return true;
}

// Performs all actions necessary to log out an admin
function log_out_admin()
{
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    unset($_SESSION['isGlobalAdmin']);
    unset($_SESSION['question.owner']);

    unset($_SESSION["battle_id"]);
    unset($_SESSION["current_round"]);
    unset($_SESSION["questionsearch.authorfirst"]);
    unset($_SESSION["questionsearch.authorlast"]);
    unset($_SESSION["questionsearch.book_title"]);
    unset($_SESSION["questionsearch.book_publication_year"]);
    unset($_SESSION["questionsearch.level"]);
    unset($_SESSION["questionsearch.category_id"]);
    unset($_SESSION["questionsearch.location"]);
    // session_destroy(); // optional: destroys the whole session
    return true;
}


// is_logged_in() contains all the logic for determining if a
// request should be considered a "logged in" request or not.
// It is the core of require_login() but it can also be called
// on its own in other contexts (e.g. display one link if an admin
// is logged in and display another link if they are not)
function is_logged_in()
{
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['admin_id']);
}

// Call require_login() at the top of any page which needs to
// require a valid login before granting acccess to the page.
function require_login()
{
    if (!is_logged_in()) {
        redirect_to(url_for('/staff/login.php'));
    } else {
        // Do nothing, let the rest of the page proceed
    }
}

// Call require_login() at the top of any page which needs to
// require a valid login before granting acccess to the page.
function require_admin_login()
{
    if (!is_logged_in()) {
        redirect_to(url_for('/staff/login.php'));
    } else {
        redirect_to(url_for('/staff/index.php'));
    }
}
