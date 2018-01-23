<?php require_once('../../private/initialize.php');?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

  <div id="page">
<?php $location_battles = find_other_library_archived_battles($_SESSION['question.owner']); ?>
<p style="color:#ff471a; font-weight:bold; font-size:25px">
  ARCHIVED BATTLES
</p>
    <?php include(SHARED_PATH . '/static_homepage.php'); ?>
    <h2>Other Libraries Archived battles</h2>
    <div id="content">
      <div class="battle listing">
        <table archived>

        <h1>Archived Battles</h1>

        <div class="actions">
        </div>

        <table class="list">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>&nbsp;</th>



          </tr>

          <?php foreach ($location_battles as $battle) {
    ?>
            <tr>
              <td><?php echo $battle['id']; ?></td>
              <td><?php echo $battle['name']; ?></td>
              <td><a class="action" href="<?php echo
              url_for('/dashboard/battle/archive/show_otherlib_archived.php?id=' . h(u($battle['id']))); ?>">View</a></td>


            </tr>
          <?php
} ?>
        </table>

      </div>
      <br />
      <br />
      <br />
      <a class="back-link" href="<?php echo url_for('/dashboard/index.php'); ?>">Back to Current Battles</a><br/>
    </div>

  </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php')?>
