<?php
/**
 * QPay Checkout Page Demo
 * - Terms of use can be found under
 * https://guides.qenta.com/
 * - License can be found under:
 * https://github.com/qenta-cee/qcp-example-php/blob/master/LICENSE.
 */

require_once 'includes/function.inc.php';
require_once 'includes/config.inc.php';

$message = handleCheckoutResult($_POST, $shop['secret']);

// stores the confirmation data sent from QENTA to your server in a simple log file
$file = fopen('confirmation.log', 'a');
fwrite($file, date('Y-m-d H:i:s').' ');
fwrite($file, $message."\n");
fwrite($file, "  QPay Checkout Page returned the following response parameters:\n");
foreach ($_POST as $key => $value) {
    if (0 == strcasecmp($key, 'submit_x') || 0 == strcasecmp($key, 'submit_y')) {
        // noop
    } else {
        fwrite($file, '  '.$key.' = '.$value."\n");
    }
}
fwrite($file, "\n");
fclose($file);
