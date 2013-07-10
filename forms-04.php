<?php

require('libs.php');

if (isset($_POST["submitted"])) {

    $inputs = array();

    foreach ( $_POST as $key => $value ) {
        $inputs[$key] = $value;
    } // create own processing variable

    echo "<pre>";
    print_r($inputs);
    echo "</pre>";

    $validated = validateInputs($inputs); // validate the inputs

    if ( isset($validated["submitted"]) && !isset($validated["errors"]) ) {
        $errors = false;
    } else {
        $errors = true;
    } // end if validated and no errors

    // merge the validated inputs with the original inputs
    $validated = array_merge($inputs, $validated);

    // if no errors - send an email!
    if ( !$errors ) {
        $mail       = $validated["eMail"];
        $name       = $validated["name"];
        $phoneNumber= (isset($validated["phoneNumber"])?$validated["phoneNumber"]:'n/a');
        $subject    = $validated["subject"];
        $message    = $validated["message"];

        // send the mail!
        sendMail($name, $mail, $subject, $message, $phoneNumber);
    } // end if no errors

} // end form was posted
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us | Super Forms</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="forms-03.css">
</head>
<body>

<!--
Create a contact form with the following specifications:
  Name *required
  eMail *required
  Phone Number
  Subject *required
  Message *required
-->
<div class="wrapper">
    <form id="myContactUs" name="myContactUs" action="#" method="POST">

        <p>
            <label for="name" class="required">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name please..." required/>
        </p>

        <p>
            <label for="eMail" class="required">eMail:</label>
            <input type="email" id="eMail" name="eMail" required placeholder="someone@example.com"/>
        </p>

        <p>
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" name="phoneNumber" id="phoneNumber"/>
        </p>

        <p>
            <label for='subject' class="required">Subject:</label>
            <select name="subject" id="subject" required>
                <option value="" selected>Subject...</option>
                <option value="Bug">Bug Report</option>
                <option value="Enquiry">Design Enquiry</option>
                <option value="General">General Feedback</option>
                <option value="Website">Website Feedback</option>
            </select>
        </p>

        <!-- message -->
        <p>
            <label for="message" class="required">Message:</label>
            <textarea rows="6" id="message" name="message" required></textarea>
        </p>

        <!-- submit the form -->
        <p>
            <label for="send"></label>
            <input type="submit" id="send" name="send" value="Send"/>
        </p>

        <input type="hidden" name="submitted" value="submitted"/>
    </form>

</div>
</body>
</html>
