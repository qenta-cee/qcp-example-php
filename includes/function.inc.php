<?php
//--------------------------------------------------------------------------------//
//                                                                                //
// Wirecard Central Eastern Europe GmbH                                           //
// www.wirecard.at                                                                //
//                                                                                //
// THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY         //
// KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE            //
// IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A                     //
// PARTICULAR PURPOSE.                                                            //
//                                                                                //
//--------------------------------------------------------------------------------//

// Returns the protocol, servername, port and path for the current page.
function getBaseUrl()
{
    $baseUrl = $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    $baseUrl = substr($baseUrl, 0, strrpos($baseUrl, "/")) . "/";
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
        $baseUrl = "https://" . $baseUrl;
    } else {
        $baseUrl = "http://" . $baseUrl;
    }
    return $baseUrl;
}

//--------------------------------------------------------------------------------//
// Returns the value for the request parameter "requestFingerprintOrder".
function getRequestFingerprintOrder($theParams)
{
    $ret = "";
    foreach ($theParams as $key => $value) {
        $ret .= "$key,";
    }
    $ret .= "requestFingerprintOrder,secret";
    return $ret;
}

//--------------------------------------------------------------------------------//
// Returns the value for the request parameter "requestFingerprint".
function getRequestFingerprint($theParams, $theSecret)
{
    $ret = "";
    foreach ($theParams as $key => $value) {
        $ret .= "$value";
    }
    $ret .= "$theSecret";
    return hash_hmac("sha512", $ret, $theSecret);
}

//--------------------------------------------------------------------------------//

// Checks if response parameters are valid by computing and comparing the fingerprints.
function areReturnParametersValid($theParams, $theSecret)
{

    // gets the fingerprint-specific response parameters sent by Wirecard
    $responseFingerprintOrder = isset($theParams["responseFingerprintOrder"]) ? $theParams["responseFingerprintOrder"] : "";
    $responseFingerprint = isset($theParams["responseFingerprint"]) ? $theParams["responseFingerprint"] : "";

    // values of the response parameters for computing the fingerprint
    $fingerprintSeed = "";

    // array containing the names of the response parameters used by Wirecard to compute the response fingerprint
    $order = explode(",", $responseFingerprintOrder);

    // checks if there are required response parameters in responseFingerprintOrder
    if (in_array("paymentState", $order) && in_array("secret", $order)) {
        // collects all values of response parameters used for computing the fingerprint
        for ($i = 0; $i < count($order); $i++) {
            $name = $order[$i];
            $value = isset($theParams[$name]) ? $theParams[$name] : "";
            $fingerprintSeed .= $value; // adds value of response parameter to fingerprint
            if (strcmp($name, "secret") == 0) {
                $fingerprintSeed .= $theSecret; // adds your secret to fingerprint
            }
        }
        $fingerprint = hash_hmac("sha512", $fingerprintSeed, $theSecret);
        // checks if computed fingerprint and responseFingerprint have the same value
        if (strcmp($fingerprint, $responseFingerprint) == 0) {
            return true; // fingerprint check passed successfully
        }
    }
    return false;
}

//--------------------------------------------------------------------------------//

// Checks the result of the payment state and returns an appropiate text message.
function handleCheckoutResult($theParams, $theSecret)
{
    $paymentState = isset($theParams["paymentState"]) ? $theParams["paymentState"] : "";
    switch ($paymentState) {
        case "FAILURE":
            $error_message = isset($theParams["message"]) ? $theParams["message"] : "";
            $message = "An error occured during the checkout process: " . $error_message;
            // NOTE: please log this error message in a persistent manner for later use
            break;
        case "CANCEL":
            $message = "The checkout process has been cancelled by the user.";
            break;
        case "PENDING":
            if (areReturnParametersValid($theParams, $theSecret)) {
                $message = "The checkout process is pending and not yet finished.";
                // NOTE: please store all related information regarding the transaction
                //       in a persistant manner for later use
            } else {
                $message = "The verification of the returned data was not successful. " .
                    "Maybe an invalid request to this page or a wrong secret?";
            }
            break;
        case "SUCCESS":
            if (areReturnParametersValid($theParams, $theSecret)) {
                $message = "The checkout process has been successfully finished.";
                // NOTE: please store all related information regarding the transaction
                //       in a persistant manner for later use
            } else {
                $message = "The verification of the returned data was not successful. " .
                    "Maybe an invalid request to this page or a wrong secret?";
            }
            break;
        default:
            $message = "Error: The payment state $paymentState is not a valid state.";
            break;
    }
    return $message;
}

?>
