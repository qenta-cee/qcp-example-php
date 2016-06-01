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

require_once("includes/config.inc.php");
require_once("includes/function.inc.php");

$message = handleCheckoutResult($_POST, $shop["secret"]);

// stores the confirmation data sent from Wirecard to your server in a simple log file
$file = fopen("confirmation.log", "a");
fwrite($file, date('Y-m-d H:i:s') . " ");
fwrite($file, $message . "\n");
fwrite($file, "  Wirecard Checkout Page returned the following response parameters:\n");
foreach ($_POST as $key => $value) {
    if (strcasecmp($key, "submit_x") == 0 || strcasecmp($key, "submit_y") == 0) {
        // noop
    } else {
        fwrite($file, "  " . $key . " = " . $value . "\n");
    }
}
fwrite($file, "\n");
fclose($file);
?>
