<?php
  //include our functions file
  include('includes/functions.php');

  // change the code below this to customize the body of the email that is being sent to the patron

  //date ranges to use in the json string
  $lastMonday = date('Y-m-d', strtotime('-7 days',strtotime('previous monday')));
  $lastSunday = date('Y-m-d', strtotime('-7 days',strtotime('this sunday')));
  $today              = strtotime('today');
  $yesterday          = date('Y-m-d', strtotime('-1 day', $today));
  $firstDayOfNextMonth = date("Y-m-d", strtotime("first day of next month midnight"));
  $lastDayOfNextMonth = date("Y-m-d", strtotime("last day of next month midnight"));
  $thirtydaysfromtoday = date('Y-m-d',strtotime('+30 days',$today));
  $threeWeeksAfterThisWeekStart = date('Y-m-d',strtotime('35 days',strtotime('monday this week')));
  $threeWeeksAfterThisWeekEnd = date('Y-m-d',strtotime('41 days',strtotime('monday this week')));
  $patronsEmailed = array();
  $patronsNotEmailed = array();

  //json query built from Sierra Create Lists that gets a list of expiring patrons
  //that will expire the next month.
  $query_string = '{
    "queries": [
      {
        "target": {
          "record": {
            "type": "patron"
          },
          "id": 43
        },
        "expr": [
          {
            "op": "between",
            "operands": [
              "' . $threeWeeksAfterThisWeekStart . '",
              "' . $threeWeeksAfterThisWeekEnd . '"
            ]
          }
        ]
      }
    ]
  }';

  echo "Showing records for patrons who are expiring between " . $threeWeeksAfterThisWeekStart . " and " . $threeWeeksAfterThisWeekEnd;
  echo "<br />";
  echo "<br />";

  //uri that is unique to your Sierra environment to do a patron query
  $uri = 'https://';
  $uri .= appServer;
  $uri .= ':443/iii/sierra-api/v';
  $uri .= apiVer;
  $uri .= '/patrons/query';
  $uri .= '?limit=' . numberOfResults; //use this to limit the # of results
  $uri .= '&offset=' . resultOffset;

  //setup the API access token
  setApiAccessToken();

  //get the access token we just created
  $apiToken = getCurrentApiAccessToken();

  //build the headers that we are going to use to post our json to the api
  $headers = array(
      "Authorization: Bearer " . $apiToken,
      "Content-Type:  application/json"
  );

  //use the headers, url, and json string to query the api
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $uri);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  //get the result from our json api query
  $result = curl_exec($ch);
  $patronIdArray = json_decode($result, true);
  $patronIdArray = $patronIdArray["entries"];

  //echo out the results.  Use custom stripped function to get only the patronID
  $count = 1;

  //iterate through the array and get each patron
  foreach ($patronIdArray as $thisId) {
    //echo $thisId['link'];  this is the full link to the patron
    //echo stripped($thisId['link']);   this is just the patronID

    //get the patron detail from the api
    $patron_detail = getPatron(stripped($thisId['link']));

    //parse out the data into variables
    $name =  $patron_detail['names'][0];

    //sometimes the email is not set - use null and set it if it exists
    //i'm doing this because i only want patrons with emails for my purposes
    $email = NULL;
    if(isset($patron_detail['emails'][0]))
    {
      $email = $patron_detail['emails'][0];
    }
    $barcode = $patron_detail['barcodes'][0];
    $expirationDate = $patron_detail['expirationDate'];

    //echo out the info to the screen
    //echo $count . " ";
    //echo "ID: " . $barcode . " Name: " . $name . " Email: " . $email;
    //echo "<br />";
    //$count = $count + 1;

    //You might have a middle initial in the names, this will parse
    //so we only get the first and last names
    //also need to check that the name contains a comma or if staff forgot
    //and deal with it accordingly

    $isThereAComma = strpos($name, ',');
    if($isThereAComma == true)
    {

      // explode out the patron name so the last name and first name are separate
      // if the patron has a middle initial it will be in the first name at this point
      $patron_names = explode(',', $name);

      // set the $last_name variable to be the last name (first item in the exploded array)
      $last_name = $patron_names[0];

      //set the rest of the exploded array to a different variable so we can parse it
      $first_name_init = $patron_names[1];

      //explode this so we can isolate the first name from a middle initial if there is one
      $first_name_and_initial = explode(" ", $first_name_init);

      //set the $first_name variable from the exploded array - This is in all capitals at this point
      $first_name = $first_name_and_initial[1];

      //make it all lowercase
      $first_name_lower = strtolower($first_name);

      //capitalize the first letter
      $first_name_proper = ucfirst($first_name_lower);

      //echo out the info to the screen

      $infoDisplay = "ID: " . $barcode . " Full Name: " . $name . " Expiration Date: " . $expirationDate . " Email: " . $email;
      if($email != NULL)
      {
        echo $infoDisplay;
        array_push($patronsEmailed, $infoDisplay);
        $count = $count + 1;
        echo "<br />";
      }
      if($email == NULL)
      {
        array_push($patronsNotEmailed, $infoDisplay);
      }
    }

    if($isThereAComma == false)
    {

      // staff forgot to put the comma in the name
      $patron_names = explode(' ', $name);

      // set the $last_name variable to be the last name (first item in the exploded array)
      $last_name = $patron_names[0];
      // set the $first_name to the next item in the exploded array
      $first_name = $patron_names[1];
      // make the first name all lower case
      $first_name_lower = strtolower($first_name);
      // capitalize the first letter
      $first_name_proper = ucfirst($first_name_lower);
      $infoDisplay = "ID: " . $barcode . " Full Name: " . $name . " Expiration Date: " . $expirationDate . " Email: " . $email;
      if($email != NULL)
      {
        echo $infoDisplay;
        array_push($patronsEmailed, $infoDisplay);
        $count = $count + 1;
        echo "<br />";
      }
      if($email == NULL)
      {
        array_push($patronsNotEmailed, $infoDisplay);
      }
    }

    //create the email to send to the patron
    $email_headers  = 'MIME-Version: 1.0' . "\r\n";
    $email_headers .= 'Content-type: text; charset=UTF-8' . "\r\n";
    $email_headers .= 'From: ' . mailFrom . "\r\n";
    if(sendCCEmail == 1)
    {
      $email_headers .= 'CC: notices@mpl.on.ca';
    }

    $emailBody = $first_name_proper . ",\r\n";
    //$emailBody .= emailBody;
    $emailBody .= "Your Milton Public Library card is up for its annual renewal on: " . $expirationDate . "\r\n\r\n";
    $emailBody .= "• Please visit Main Library or Beaty Branch, prior to this date, with your library card and a piece of identification that bears your name and address (driver’s license, utility bill, etc.).\r\n";
    $emailBody .= "• Your library card will be renewed for 365 days from the date you renew.\r\n";
    $emailBody .= "• You will notice on your library account at http://www.mpl.on.ca that there is a daily countdown to your renewal date.  Look for the 'i' icon.\r\n";
    $emailBody .= "• This annual renewal provides staff with the opportunity to confirm patron addresses and contact information.\r\n";
    $emailBody .="\r\n";
    $emailBody .= "If you have questions, please contact staff at: circulation@mpl.on.ca\r\n";

    //send email - if you want to test this out and not actually email patrons
    //replace $email with your own email address in ''s   ie.  'chris.jasztrab@mpl.on.ca'

    if(sendEmails == 1)
    {
      mail("chris.jasztrab@gmail.com",mailSubject,$emailBody,$email_headers);
    }

    // send a summary email to the administrator for review

  }

  echo "<br />";
  echo "Patron Emails Complete, Emailing Summary to Admin";
  echo "<br />";

    $summary_email_headers  = 'MIME-Version: 1.0' . "\r\n";
    $summary_email_headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $summary_email_headers .= 'From: ' . mailFrom . "\r\n";
    $summary_email_headers .= 'CC: ' . summaryEmailAddress;

    $summaryEmail = "Here is a summary of the patrons emailed letting them know that their card is expiring";
    $summaryEmail .= "<br />";
    $summaryEmail .= "<br />";
    $summaryEmail .= "Date Range Used: " . $threeWeeksAfterThisWeekStart . " and " . $threeWeeksAfterThisWeekEnd;
    $summaryEmail .= "<br />";
    $summaryEmail .= "<br />";
    foreach ($patronsEmailed as $detail)
    {
      $summaryEmail .= $detail . "<br />";
    }
    $numberPeopleEmailed = count($patronsEmailed);
    $summaryEmail .= "<br />";
  //  $summaryEmail .= "<br />";
  //  $summaryEmail .= "Here is a summary of the patrons not emailed because they don't have an email address";
  //  $summaryEmail .= "<br />";
  //  $summaryEmail .= "<br />";
    foreach ($patronsNotEmailed as $noemaildetail)
    {
      //$summaryEmail .= $noemaildetail . "<br />";
    }
    $summaryEmail .= "<br />";
    $summaryEmail .= "<br />";
    $summaryEmail .="Number of people emailed: " . $numberPeopleEmailed;
    $summaryEmail .= "<br />";

  if(sendSummaryEmail == 1)
  {
    mail(summaryEmailAddress,"Patron Expiration Email Notification Summary",$summaryEmail,$summary_email_headers);
  }


    echo "<br />";
    echo "Job Complete";
    echo "<br />";
?>
