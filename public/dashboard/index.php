<?php require_once('../../private/initialize.php');?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/public_header.php')?>

<?php $logged_in_admin = find_admin_by_id($_SESSION['admin_id']);
      $location_info = find_location_by_id($logged_in_admin['location']);
      $location_name = $location_info['location_name'];

      $welcome_string = $logged_in_admin['first_name'] . " ";
      $welcome_string .= $logged_in_admin['last_name'] . " From ";
      $welcome_string .= $location_name;
      ?>

<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>
<?php echo $welcome_string; ?>
  <div id="page">
<?php $location_battles = find_battles_by_location($_SESSION['question.owner']); ?>
<?php $other_library_battles = find_other_library_battles($_SESSION['question.owner']); ?>
    <?php include(SHARED_PATH . '/static_homepage.php'); ?>


    <h2>Your current battles</h2>
    <div id="content">
      <div class="battle listing">
        <h1>Battles</h1>

        <div class="actions">
        </div>
          <?php if(is_logged_in()){ ?>
        <table class="list">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>

          <?php foreach($location_battles as $battle) { ?>
            <tr>
              <td><?php echo $battle['id']; ?></td>
              <td><?php echo $battle['name']; ?></td>
              <td><a class="action" href="<?php echo
              url_for('/dashboard/battle/edit.php?id=' . h(u($battle['id'])));
              ?>">Edit</a></td>
              <td><a class="action" href="<?php echo
              url_for('/dashboard/battle/show.php?id=' . h(u($battle['id'])));
              ?>">View</a></td>
              <td><a class="action" href="<?php echo url_for('/dashboard/battle/archive/archive.php?id=' . h(u($battle['id'])));
              ?>">Archive</a></td>
            </tr>
          <?php } ?>
        </table>

      </div>
      <br />


          <a class="back-link" href="<?php echo url_for('/dashboard/archived_list.php'); ?>">View Your Archived Battles</a><br/>
            <?php } ?>
            <br />
            <br />
    </div>

    <div id="content">
      <div class="battle listing">
        <h2>Other Library's Current Battles</h2>

        <div class="actions">
        </div>

        <table class="list">
          <tr>
            <th>ID</th>
            <th>Battle Name</th>
            <th>Library</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>



          </tr>

          <?php foreach($other_library_battles as $otherlibbattle) { ?>
            <tr>
              <?php $location_info = find_location_by_id($otherlibbattle['owner']); ?>
              <td><?php echo $otherlibbattle['id']; ?></td>
              <td><?php echo $otherlibbattle['name']; ?></td>
              <td><?php echo $location_info['location_name']; ?></td>
              <td><a class="action" href="<?php echo
              url_for('/dashboard/battle/show.php?id=' . h(u($otherlibbattle['id'])));
              ?>">View</a></td>
              <td><a class="action" href="<?php echo
              url_for('/dashboard/battle/copy_battle.php?id=' . h(u($otherlibbattle['id'])));
              ?>">Copy this Battle to your Battles</a></td>

            </tr>
        <?php } ?>


        </table>
        <br /><br /><br />
            <a class="back-link" href="<?php echo url_for('/dashboard/other_archived_list.php'); ?>">View Other Libraries Archived Battles</a><br/>
      </div>
      <br />
      <br />
      <br />




    </div>

  </div>

</div>


<?php //include(SHARED_PATH . '/public_footer.php')?>
