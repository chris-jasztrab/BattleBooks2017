<?php

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}


  if (is_post_request()) {

    $lib_info['library_name'] = $_POST['library_name'];
    $lib_info['dbServer'] = $_POST['dbServer'];
    $lib_info['encoreServer'] = $_POST['encoreServer'];
    $lib_info['appServer'] = $_POST['appServer'];
    $lib_info['apiVer'] = $_POST['apiVer'];
    $lib_info['apiKey'] = $_POST['apiKey'];
    $lib_info['apiSecret'] = $_POST['apiSecret'];
    $lib_info['numberOfResults'] = $_POST['numberOfResults'];
    $lib_info['resultOffset'] = $_POST['resultOffset'];
    $lib_info['mailFrom'] = $_POST['mailFrom'];
    $lib_info['mailSubject'] = $_POST['mailSubject'];
    $lib_info['sendCCEmail'] = $_POST['sendCCEmail'];
    $lib_info['ccAddress'] = $_POST['ccAddress'];
    $lib_info['sendSummaryEmail'] = $_POST['sendSummaryEmail'];
    $lib_info['summaryEmailAddress'] = $_POST['summaryEmailAddress'];
    $lib_info['emailBody'] = $_POST['emailBody'];
    $lib_info['emailBody_2'] = $_POST['emailBody_2'];
    $lib_info['sendEmails'] = $_POST['sendEmails'];

    $config_file = fopen("config.php", "w") or die("Unable to open file!");

    $txt = "<?php\n\n";
    fwrite($config_file, $txt);

    $txt = "define('institutionName', '" . $lib_info['library_name'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('dbServer', '" . $lib_info['dbServer'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('encoreServer', '" . $lib_info['encoreServer'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('appServer', '" . $lib_info['appServer'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('apiVer', '" . $lib_info['apiVer'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('apiKey', '" . $lib_info['apiKey'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('apiSecret', '" . $lib_info['apiSecret'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('numberOfResults', '" . $lib_info['numberOfResults'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('resultOffset', '" . $lib_info['resultOffset'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('mailFrom', '" . $lib_info['mailFrom'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('mailSubject', '" . $lib_info['mailSubject'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('sendCCEmail', '" . $lib_info['sendCCEmail'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('ccAddress', '" . $lib_info['ccAddress'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('sendSummaryEmail', '" . $lib_info['sendSummaryEmail'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('summaryEmailAddress', '" . $lib_info['summaryEmailAddress'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('emailBody', '" . $lib_info['emailBody'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('emailBody_2', '" . $lib_info['emailBody_2'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "define('sendEmails', '" . $lib_info['sendEmails'] . "');\n\n";
    fwrite($config_file, $txt);

    $txt = "?>\n";
    fwrite($config_file, $txt);

    fclose($config_file);

  }

?>
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />


<script src="ckeditor\ckeditor.js"></script>



<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form action="install.php" method="post">
     <div class="form-group ">
      <label class="control-label " for="library_name">
       Library Name
      </label>
      <input class="form-control" id="library_name" name="library_name" placeholder="Your Library Name" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="dbServer">
       DB Server FQDN
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="dbServer" name="dbServer" placeholder="dbserver.yourlibrary.ca" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="encoreServer">
       Encore Server FQDN
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="encoreServer" name="encoreServer" placeholder="encore.yourlibrary.ca" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="appServer">
       App Server FQDN
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="appServer" name="appServer" placeholder="app.yourlibrary.ca" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="apiVer">
       API Version
       <span class="asteriskField">
        *
       </span>
      </label>
      <select class="select form-control" id="apiVer" name="apiVer">
       <option value="4">
        4
       </option>
       <option value="3">
        3
       </option>
      </select>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="apiKey">
       API Key
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="apiKey" name="apiKey" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="apiSecret">
       API Secret
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="apiSecret" name="apiSecret" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="numberOfResults">
       Number of Results to Return
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="numberOfResults" name="numberOfResults" placeholder="10000" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="resultOffset">
       Result Offset
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="resultOffset" name="resultOffset" placeholder="0" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="mailFrom">
       Email to Send Notices From:
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="mailFrom" name="mailFrom" placeholder="notices@yourlibrary.ca" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="mailSubject">
       Email Subject
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="mailSubject" name="mailSubject" type="text"/>
     </div>

     <div class="form-group ">
      <label class="control-label requiredField" for="sendEmails">
       Send Emails or Just Output to Screen?
       <span class="asteriskField">
        *
       </span>
      </label>
      <select class="select form-control" id="sendEmails" name="sendEmails">
       <option value="1">
        Yes
       </option>
       <option value="0">
        No
       </option>
      </select>
     </div>
     <div class="form-group ">

     <div class="form-group ">
      <label class="control-label requiredField" for="sendCCEmail">
       Send CC Emails to Another Email Address?
       <span class="asteriskField">
        *
       </span>
      </label>
      <select class="select form-control" id="sendCCEmail" name="sendCCEmail">
       <option value="1">
        Yes
       </option>
       <option value="0">
        No
       </option>
      </select>
     </div>
     <div class="form-group ">
      <label class="control-label " for="ccAddress">
       CC Email Address
      </label>
      <input class="form-control" id="ccAddress" name="ccAddress" placeholder="notices@yourlibrary.ca" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="sendSummaryEmail">
       Send Summary Email
       <span class="asteriskField">
        *
       </span>
      </label>
      <select class="select form-control" id="sendSummaryEmail" name="sendSummaryEmail">
       <option value="1">
        Yes
       </option>
       <option value="0">
        No
       </option>
      </select>
     </div>
     <div class="form-group ">
      <label class="control-label " for="summaryEmailAddress">
       Summary Email Address:
      </label>
      <input class="form-control" id="summaryEmailAddress" name="summaryEmailAddress" placeholder="admin@yourlibrary.ca" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="emailBody">
       Email Body One
       <span class="asteriskField">
        *
       </span>
      </label>
      <textarea class="ckeditor" cols="40" id="emailBody" name="emailBody" rows="10"></textarea>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="emailBody_2">
       Email Body Two
       <span class="asteriskField">
        *
       </span>
      </label>
      <textarea class="ckeditor" cols="40" id="emailBody_2" name="emailBody_2" rows="10"></textarea>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary " name="submit" type="submit">
        Submit
       </button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>
