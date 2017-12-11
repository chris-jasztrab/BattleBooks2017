<?php require_once('../../../private/initialize.php');?>

<?php include(SHARED_PATH . '/public_header.php')?>
<?php require_login(); ?>
<div id="main">

  <?php include(SHARED_PATH . '/dashboard_navigation.php'); ?>

  <div id="page">

    <div id="content">

      <h2>Question Maintenance</h2>
      <p></p>
      <H2><a href="<?php echo url_for('dashboard/question/new.php'); ?>">NEW QUESTION</a> </H2>

      <H2><a href="<?php echo url_for('dashboard/search/search.php'); ?>">SEARCH QUESTIONS</a> </H2>
      <!-- <div id="service-blocks">
        <div class="service">
          <img src="images/homepage_assets/family_buying_home_L30707.jpg" width="250" height="166" alt="Family in front of sold home" />
          <h1>Buying a home?</h1>
          <p>There's no place like home, and there's no home loan like Globe's.</p>
          <p><a href="#" class="learnmore">Learn More...</a> </p>
        </div>


        <div class="service">
          <img src="images/homepage_assets/owner_salon_L30714.jpg" width="250" height="166" alt="Small business owner" />
          <h1>Starting a business?</h1>
          <p>From small business loans to merchant accounts, our service are designed to help your small business thrive.</p>
          <p><a href="#" class="learnmore">Learn More...</a> </p>
        </div>

        <div class="service">
          <img src="images/homepage_assets/owner_salon_L30714.jpg" width="250" height="166" alt="Small business owner" />
          <h1>Starting a business?</h1>
          <p>From small business loans to merchant accounts, our service are designed to help your small business thrive.</p>
          <p><a href="#" class="learnmore">Learn More...</a> </p>
        </div>
      </div>-->

    </div>


  </div>

</div>


<?php include(SHARED_PATH . '/public_footer.php')?>
