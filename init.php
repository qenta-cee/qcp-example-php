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

  // calculate fingerprint from form data
  $requestParameters = $_POST;
  $requestParameters['requestFingerprintOrder'] = getRequestFingerprintOrder($_POST);
  $requestParameters['requestFingerprint'] = getRequestFingerprint($_POST, $shop['secret']);

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
    This is an interstitial page for demonstration purposes only.
    It displays the which parameters are sent to the QENTA Payments API
</p>

<form action="<?php echo $api['endpoint']; ?>" method="post">
<p>
<input id="btnInitiateCheckout" type="submit" value="Initiate Checkout" />
</p>
<h2>API Endpoint</h2>
<table class="payload" style="display:table" bordercolor="lightgray" cellpadding="10" cellspacing="0">
<tr><td><tt><?php echo $api['endpoint']; ?></tt></td></tr>
</table>

<h2>Parameters</h2>
<table class="payload" style="display: table" bordercolor="lightgray" cellpadding="10" cellspacing="0">
<?php
    foreach ($requestParameters as $key => $value) {
        if (0 == strcasecmp($key, 'submit_x') || 0 == strcasecmp($key, 'submit_y')) {
            // noop
        } else {
            echo "<tr><td align='right'><b>".$key.'</b></td>';
            echo '<td>'.$value."</td></tr>". PHP_EOL;
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">' . PHP_EOL;
        }
    }
    ?>
</table>
</form>
</div>
<footer></footer>
</body>
</html>
