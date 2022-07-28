<?php

/**
 * QPay Checkout Page Demo
 * - Terms of use can be found under
 * https://guides.qenta.com/
 * - License can be found under:
 * https://github.com/qenta-cee/qcp-example-php/blob/master/LICENSE.
 */
// Returns the protocol, servername, port and path for the current page.
function getBaseUrl()
{
    $url = [];
    $ssl = isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'] ? true : false;
    $host = $_SERVER['SERVER_NAME'];
    $port = intval($_SERVER['SERVER_PORT']);
    array_push(
        $url,
        'http'.($ssl ? 's' : '').'://',
        $host,
        (($ssl && 443 !== $port) || (!$ssl && 80 !== $port)) ? ':'.$port : '',
        '/'
    );

    return join('', $url);
}

//--------------------------------------------------------------------------------//
// Returns the value for the request parameter "requestFingerprintOrder".
function getRequestFingerprintOrder($theParams)
{
    $ret = '';
    foreach ($theParams as $key => $value) {
        $ret .= "{$key},";
    }
    $ret .= 'requestFingerprintOrder,secret';

    return $ret;
}

//--------------------------------------------------------------------------------//
// Returns the value for the request parameter "requestFingerprint".
function getRequestFingerprint($theParams, $theSecret)
{
    $ret = '';
    foreach ($theParams as $key => $value) {
        $ret .= (string) $value;
    }
    $ret .= "{$theSecret}";
    $fingerprint = hash_hmac('sha512', $ret, $theSecret);
    return $fingerprint;
}

//--------------------------------------------------------------------------------//

// Checks if response parameters are valid by computing and comparing the fingerprints.
function areReturnParametersValid($theParams, $theSecret)
{
    // gets the fingerprint-specific response parameters sent by QENTA
    $responseFingerprintOrder = isset($theParams['responseFingerprintOrder']) ? $theParams['responseFingerprintOrder'] : '';
    $responseFingerprint = isset($theParams['responseFingerprint']) ? $theParams['responseFingerprint'] : '';

    // values of the response parameters for computing the fingerprint
    $fingerprintSeed = '';

    // array containing the names of the response parameters used by QENTA to compute the response fingerprint
    $order = explode(',', $responseFingerprintOrder);

    // checks if there are required response parameters in responseFingerprintOrder
    if (in_array('paymentState', $order) && in_array('secret', $order)) {
        // collects all values of response parameters used for computing the fingerprint
        for ($i = 0; $i < count($order); ++$i) {
            $name = $order[$i];
            $value = isset($theParams[$name]) ? $theParams[$name] : '';
            $fingerprintSeed .= $value; // adds value of response parameter to fingerprint
            if (0 == strcmp($name, 'secret')) {
                $fingerprintSeed .= $theSecret; // adds your secret to fingerprint
            }
        }
        $fingerprint = hash_hmac('sha512', $fingerprintSeed, $theSecret);
        // checks if computed fingerprint and responseFingerprint have the same value
        if (0 == strcmp($fingerprint, $responseFingerprint)) {
            return true; // fingerprint check passed successfully
        }
    }

    return false;
}

//--------------------------------------------------------------------------------//

// Checks the result of the payment state and returns an appropiate text message.
function handleCheckoutResult($theParams, $theSecret)
{
    $paymentState = isset($theParams['paymentState']) ? $theParams['paymentState'] : '';

    switch ($paymentState) {
        case 'FAILURE':
            $error_message = isset($theParams['message']) ? $theParams['message'] : '';
            $message = 'An error occured during the checkout process: '.$error_message;
            // NOTE: please log this error message in a persistent manner for later use
            break;

        case 'CANCEL':
            $message = 'The checkout process has been cancelled by the user.';

            break;

        case 'PENDING':
            if (areReturnParametersValid($theParams, $theSecret)) {
                $message = 'The checkout process is pending and not yet finished.';
            // NOTE: please store all related information regarding the transaction
                //       in a persistant manner for later use
            } else {
                $message = 'The verification of the returned data was not successful. '.
                    'Maybe an invalid request to this page or a wrong secret?';
            }

            break;

        case 'SUCCESS':
            if (areReturnParametersValid($theParams, $theSecret)) {
                $message = 'The checkout process has been successfully finished.';
            // NOTE: please store all related information regarding the transaction
                //       in a persistant manner for later use
            } else {
                $message = 'The verification of the returned data was not successful. '.
                    'Maybe an invalid request to this page or a wrong secret?';
            }

            break;

        default:
            $message = "Error: The payment state {$paymentState} is not a valid state.";

            break;
    }

    return $message;
}
