<!doctype html>

<html lang="en">
  <head>
    <title>Battle of the Books <?php if (isset($page_title)) {
    echo '- ' . h($page_title);
} ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  </head>

  <body>

    <header>

      <h1>
        <a href="<?php echo url_for('/index.php'); ?>">
          <img src="<?php echo url_for('/images/BOB_1.png'); ?>" width="200" height="85" alt="" />
        </a>
      </h1>
    </header>
