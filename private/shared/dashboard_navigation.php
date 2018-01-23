<navigation>
  <ul class="subjects">
      <li>
        <ul class="pages">
          <li>
            <a href="<?php echo url_for('dashboard/index.php'); ?>">VIEW YOUR BATTLES</a>
          </li>
          <br />
            <li>
              <a href="<?php echo url_for('dashboard/battle/new.php'); ?>">NEW BATTLE</a>
            </li>
            <li>
              <br />
            </li>


            <li>
            <a href="<?php echo url_for('dashboard/question/index.php'); ?>">QUESTIONS</a>
            </li>
            <li>
              <br />
            </li>
          
            <li>
              <br />
            </li>
            <li>
              <br />
            </li>
            <li>
              <br />
            </li>
            <li>
              <br />
            </li>
            <li>
            <?php
              if (isset($_SESSION['isGlobalAdmin'])) {
                  if ($_SESSION['isGlobalAdmin'] == '1') {
                      $admin_url = "<a href='";
                      $admin_url .= url_for('staff/index.php');
                      $admin_url .= "'>ADMIN MENU</a>";
                      echo $admin_url;
                  }
              }
              ?>
            </li>
            <li>
              <?php if (is_logged_in()) {
                  $logoff_url = "<a href='";
                  $logoff_url .= url_for('staff/logout.php');
                  $logoff_url .= "'>LOGOUT</a>";
                  echo $logoff_url;
              } else {
                  $login_url = "<a href='";
                  $login_url .= url_for('staff/login.php');
                  $login_url .= "'>LOGIN</a>";
                  echo $login_url;
              }
              ?>
            </li>
        </ul>
      </li>
  </ul>

</navigation>
