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
?>
<html>
<head>
    <title>Wirecard Checkout Page Demo</title>
    <link rel="stylesheet" type="text/css" href="ui/styles.css">
</head>
<body>
<h1>Wirecard Checkout Page Demo</h1>

<p>
    This is a simple return page for demonstration purposes only.
    It displays the result of the Wirecard Checkout Page based on
    the actions taken by the consumer within the checkout process.
</p>

<p>
    There are four different payment states possible, depending on the result
    of the checkout process:
<ul>
    <li>SUCCESS: The payment has been successfully done by the consumer.</li>
    <li>PENDING: The payment is in progress. At this state we cannot inform
        about success or failure of this payment.
    </li>
    <li>CANCEL: The payment process has been cancelled by the consumer
        and has not been successfully finished.
    </li>
    <li>FAILURE: A problem occured during the payment process and the
        payment has not been successfully finished.
    </li>
</ul>
Depending on the returned payment state you need to inform your consumer
and take appropiate actions.
</p>
<p>
    The result of this checkout is:<br>
<center><big><b><i><?php echo $message ?></i></b></center>
</big></center>
</p>

<p>The Wirecard Checkout Page returned the following response parameters:</p>

<table border="1" bordercolor="lightgray" cellpadding="10" cellspacing="0">
    <?php
    foreach ($_POST as $key => $value) {
        if (strcasecmp($key, "submit_x") == 0 || strcasecmp($key, "submit_y") == 0) {
            // noop
        } else {
            echo "<tr><td align='right'><b>" . $key . "</b></td>";
            echo "<td>" . $value . "</td></tr>\n";
        }
    }
    ?>
</table>
<p><a href="index.php">Start a new Checkout</a></p>
</body>
</html>
