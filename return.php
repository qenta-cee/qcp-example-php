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
?>
<html>
<head>
    <title>QPay Checkout Page Demo</title>
    <link rel="stylesheet" type="text/css" href="ui/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/ucf2gvc.css">
</head>
<body>
<div id="content">
<h1>QPay Checkout Page Demo</h1>

<p class="main">
    This is a simple return page for demonstration purposes only.
    It displays the result of the QPay Checkout Page based on
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
<center><big><b><i><?php echo $message; ?></i></b></center>
</big></center>
</p>

<p>The QPay Checkout Page returned the following response parameters:</p>

<table class="payload" style="display: table" border="1" bordercolor="lightgray" cellpadding="10" cellspacing="0">
    <?php
    foreach ($_POST as $key => $value) {
        if (0 == strcasecmp($key, 'submit_x') || 0 == strcasecmp($key, 'submit_y')) {
            // noop
        } else {
            echo "<tr><td align='right'><b>".$key.'</b></td>';
            echo '<td>'.$value."</td></tr>\n";
        }
    }
    ?>
</table>
<p>
<input type="button" onclick="window.location='/';" value="Start a new Checkout" />
</p>
</div>
<footer></footer>
</body>
</html>
