<?php
/**
 * Created by JetBrains PhpStorm.
 * User: WS13
 * Date: 10/07/13
 * Time: 2:42 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Validate Inputs
 * @param null $inputs
 * @return array|bool
 */
function validateInputs($inputs = null) {
    $errormsg = array(); // store the error messages

    // sanitise the inputs
    foreach( $inputs as $key => $value ) {
        $inputs[$key] = htmlspecialchars($value);
    } // end sanitise the inputs

    // validate - no entries?
    if (is_null($inputs)) {
        $errormsg['errors'] = true;
        $errormsg['e_all']  = "No entries have been made on the form...";
        return $errormsg;
    } // end no form content

    if (isset($inputs["submitted"]) && $inputs["submitted"]==1) {

        if(!$inputs["name"]) {
            $errormsg["errors"] = true;
            $errormsg["e_name"] = 'Name missing';
        } // end name check

        if(!$inputs["eMail"] && !validateEmail($inputs["eMail"])) {
            $errormsg["errors"] = true;
            $errormsg["e_eMail"] = 'Invalid eMail';
        } // end name check

        if(!$inputs["subject"]) {
            $errormsg["errors"] = true;
            $errormsg["e_subject"] = 'No subject chosen';
        } // end name check

        if(!$inputs["message"]) {
            $errormsg["errors"] = true;
            $errormsg["e_message"] = 'Please enter a message';
        } // end name check

    } // end submitted form

    if ($errormsg) {
        return $errormsg;
    } else {
        return $inputs;
    }

} // end validate inputs

/**
 * Validate phone number
 * @param $phone
 * @return bool
 */
function validatePhoneNumber($phone) {
    // Use Regular Expressions to deduct phone number "validity"
    if (!preg_match("/+(?:[0-9] ?){6,16}[0-9]$/i", $phone)) {
        return false;
    }

    return true;
}

/**
 * validate Email
 * @param $email
 * @return boolean
 */
function validateEmail($email) {
    // Do something
}

/**
 * @param $name
 * @param $email
 * @param $subject
 * @param $messageToGo
 * @param $phone
 */
function sendMail($name, $email, $subject, $messageToGo, $phone) {
    // do something
}
